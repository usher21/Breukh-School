<?php

namespace App\Http\Controllers;

use App\Exceptions\MarkException;
use App\Models\Mark;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\DisciplineClasse;

class MarkValidator extends Controller
{
    public int $idClasseDiscipline;

    public function __construct(
        private string $classeId,
        private string $disciplineId,
        private string $evaluationId
    ) {
    }

    public function validateMark($data)
    {
        $classeDiscipline = DisciplineClasse::where([
            "classe_id" => $this->classeId,
            "discipline_id" => $this->disciplineId,
            "evaluation_id" => $this->evaluationId
        ])->first();

        $this->idClasseDiscipline = $classeDiscipline->id;

        if (!$classeDiscipline) {
            throw new MarkException("Aucun lien n'existe pour cette classe, discipline et ce type d'évaluation");
        }

        $studentMarks = array_filter($data, fn ($studentMark) =>
            Inscription::where('id', $studentMark['inscription_id'])->first()
        );

        if (!$this->markValid($studentMarks, $classeDiscipline->id)) {
            throw new MarkException("La note saisie ne doit pas être supérieure à la note maximale");
        }

        $studentInClasse = $this->studentInClasse($studentMarks, $this->classeId);
        if (array_key_exists("success", $studentInClasse) && !$studentInClasse["success"]) {
            throw new MarkException($studentInClasse['message']);
        }

        if ($this->markExists($studentMarks, $classeDiscipline->id)) {
            throw new MarkException("Cette élève à déjà une note pour cette matière dans ce type d'évaluation");
        }

        return $studentMarks;
    }

    public function markExists(array $studentMarks, int $idClasseDiscipline): bool
    {
        foreach ($studentMarks as $studentMark) {
            $mark = Mark::where([
                'discipline_classe_id' => $idClasseDiscipline,
                'inscription_id' => $studentMark['inscription_id']
            ])->first();

            if ($mark) {
                return true;
            }
        }

        return false;
    }

    public function studentInClasse(array $studentMarks, int $classeId)
    {
        foreach ($studentMarks as $studentMark) {
            $student = Inscription::find($studentMark['inscription_id']);
            if ($student->classe_id != $classeId) {
                $studentFound = Eleve::find($student->eleve_id);
                return [
                    "success" => false,
                    "message" => "L'élève " . $studentFound->firstname . " " . $studentFound->lastname . " n'existe pas dans cette classe"
                ];
            }
        }

        return ["succes" => true];
    }

    public function markValid(array $studentMarks, int $idClasseDiscipline): bool
    {
        foreach ($studentMarks as $studentMark) {
            $classeDiscipline = DisciplineClasse::find($idClasseDiscipline);
            if ($studentMark['value'] > $classeDiscipline->max_mark) {
                return false;
            }
        }

        return true;
    }
}
