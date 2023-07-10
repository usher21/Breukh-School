<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "student_infos" => new EleveRessource($this->eleve),
            "classe" => $this->classe->label,
            "annee_scolaire" => $this->anneeScolaire->label,
        ];
    }
}
