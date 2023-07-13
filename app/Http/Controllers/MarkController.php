<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Semester;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Models\DisciplineClasse;
use App\Exceptions\MarkException;
use App\Http\Resources\MarkRessource;

class MarkController extends Controller
{
    public function addMark(Request $request, string $classeId, string $disciplineId, string $evaluationId)
    {
        try {
            $markValidator = new MarkValidator($classeId, $disciplineId, $evaluationId);
            $studentMarks = $markValidator->validateMark($request->data);

            $this->prepareDataForInsert($studentMarks, $markValidator->idClasseDiscipline);

            $sendData = [];

            if (Mark::insert($studentMarks)) {
                $this->formatData($sendData, $studentMarks);
            }

            return MarkRessource::collection($sendData);
        } catch (MarkException $exception) {
            return $exception->getMessage();
        }
    }

    public function prepareDataForInsert(array &$studentMarks, int $idClasseDiscipline): void
    {
        for ($i = 0; $i < count($studentMarks); $i++) {
            $studentMarks[$i]["discipline_classe_id"] = $idClasseDiscipline;
        }
    }

    public function formatData(array &$sendData, $studentMarks): void
    {
        foreach ($studentMarks as $studentMark) {
            $sendData[] = new MarkRessource(Mark::where([
                'discipline_classe_id' => $studentMark['discipline_classe_id'],
                'inscription_id' => $studentMark['inscription_id']
            ])->first());
        }
    }

    public function getStudentNotesBySubjectId($classeId, $disciplineId)
    {
        $classeDiscipline = DisciplineClasse::where(['classe_id' => $classeId, 'discipline_id' => $disciplineId])->get('id')->pluck('id');

        if (empty($classeDiscipline)) {
            return ["message" => "Cette discipline n'existe pas dans cette classe"];
        }

        $inscriptions = Inscription::byClasse($classeId)->get();
        $marks = Mark::whereIn('inscription_id', $inscriptions->pluck('id'))->get()->groupBy('inscription_id');
       
        // $marksArray = $marks->map(function ($mark) {
        //     $student = [];
        //     foreach ($mark as $studentMark) {
        //         echo json_encode($studentMark);
        //     }
        //     // Eleve::find(Inscription::where('eleve_id'));
        // });
        return $marks;
        $students = [];

        return $marks;

        foreach ($marks as $mark) {
            // $student = Eleve::find(Inscription::where('eleve_id', $mark->inscription_id)->first());
            echo json_encode($mark);
            $object = [];

            // $object['nom'] = $student->firstname . ' ' . $student->lastname;

            // echo json_encode($object);
        }

        return;

        // return Mark::whereIn('inscription_id', $inscriptions->pluck('eleve_id'))->get();

        // return Mark::byClasse($classeId)->bySubject($disciplineId)->withRelatedData()->get();

        $marks = Mark::byClasse($classeId)->bySubject($disciplineId)->get()->sortBy('inscription_id');
        $forSearch = DisciplineClasse::find($marks[0]['discipline_classe_id']);

        return [
            "classe" => Classe::find($forSearch->classe_id)->label,
            "semester" => "Semester " . Semester::find($forSearch->semester_id)->semester_number,
            "discipline" => Discipline::find($forSearch->discipline_id)->label,
            "eleves" => $this->getStudentNotes($marks)
        ];
    }

    public function getStudentNotes($marks)
    {
        $students = [];
        $inscriptionId = null;

        foreach ($marks as $mark) {
            $studentMarks = [];
            $student = Eleve::find(Inscription::find($mark->inscription_id)->eleve_id);
            $evaluation = Evaluation::find(DisciplineClasse::find($mark->discipline_classe_id)->evaluation_id);

            if ($mark->inscription_id != $inscriptionId) {
                $inscriptionId = $mark->inscription_id;
                $studentMarks["nom"] = $student->firstname . ' ' . $student->lastname;
                $studentMarks[$evaluation->label] = $mark->value;
                $students[] = $studentMarks;
            } else {
                $students[count($students) - 1][$evaluation->label] = $mark->value;
            }
        }

        return $students;
    }

    public function getStudentNotesByClasseId($classeId)
    {
        return Mark::byClasse($classeId)->withResources();
    }

    public function getNotesByStudentId($classeId, $eleveId)
    {
        return Mark::byClasse($classeId)->byStudent($eleveId)->withResources();
    }
}
