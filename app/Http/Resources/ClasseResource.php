<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClasseResource extends JsonResource
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
            "label" => $this->label,
            "level" => new LevelResource($this->whenLoaded('level')),
            "eleves" => EleveRessource::collection($this->whenLoaded('students')),
            "disciplines" => DisciplineRessource::collection($this->whenLoaded('subjects')),
        ];
    }
}
