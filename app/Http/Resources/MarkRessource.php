<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "mark_value" => $this->value,
            "ponderation" => new DisciplineClasseRessource($this->disciplineClasse),
            "inscription" => new InscriptionRessource($this->inscription)
        ];
    }
}
