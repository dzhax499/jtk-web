<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyProgramResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'degree' => $this->degree,
            'description' => $this->description,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'is_active' => (bool) $this->is_active,
            'lecturers' => LecturerResource::collection($this->whenLoaded('lecturers')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
