<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LecturerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'nip' => $this->nip,
            'nidn' => $this->nidn,
            'email' => $this->email,
            'photo_url' => $this->photo_url,
            'academic_position' => $this->academic_position,
            'bio' => $this->bio,
            'is_active' => (bool) $this->is_active,
            'study_program' => new StudyProgramResource($this->whenLoaded('studyProgram')),
            'expertise_areas' => ExpertiseAreaResource::collection($this->whenLoaded('expertiseAreas')),
            'portfolio_items' => LecturerPortfolioItemResource::collection($this->whenLoaded('portfolioItems')),
            'links' => LecturerLinkResource::collection($this->whenLoaded('links')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
