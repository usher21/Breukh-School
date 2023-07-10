<?php

namespace App\Http\Controllers;

use App\Models\Mark;
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

    public function prepareDataForInsert(array &$studentMarks, int $idClasseDiscipline) : void
    {
        for ($i = 0; $i < count($studentMarks); $i++) {
            $studentMarks[$i]["discipline_classe_id"] = $idClasseDiscipline;
        }
    }

    public function formatData(array &$sendData, $studentMarks) : void
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

        return Mark::byClasse($classeId)->bySubject($disciplineId)->withResources();
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
