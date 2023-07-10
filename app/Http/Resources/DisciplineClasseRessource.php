<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisciplineClasseRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "noteMax" => $this->max_mark,
            "evaluation" => new EvaluationRessource($this->evaluation),
            "discipline" => new DisciplineRessource($this->discipline),
            "classe" => new ClasseResource($this->classe),
            "semester" => "Semestre " . $this->semester->semester_number
        ];
    }
}
