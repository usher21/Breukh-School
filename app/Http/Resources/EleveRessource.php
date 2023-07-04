<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EleveRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "birthdate" => $this->birthdate,
            "birthplace" => $this->birthplace,
            "sex" => $this->sex,
            "profil" => $this->profil,
            "state" => $this->state,
            "number" => $this->number,
            "allocated_number" => $this->allocated_number
        ];
    }
}
