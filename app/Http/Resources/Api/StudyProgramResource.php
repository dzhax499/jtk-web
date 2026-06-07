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
            'objectives' => $this->objectives,
            'graduate_profiles' => $this->graduate_profiles,
            'job_positions' => $this->job_positions,
            'about' => $this->about,
            'lecturer_qualification' => $this->lecturer_qualification,
            'facilities' => $this->facilities,
            'career_prospects' => $this->career_prospects,
            'career_prospects_list' => $this->career_prospects_list,
            'accreditation_text' => $this->accreditation_text,
            'accreditation_certificate_url' => $this->accreditation_certificate_url,
            'accreditation_website_url' => $this->accreditation_website_url,
            'is_active' => (bool) $this->is_active,
            'lecturers' => LecturerResource::collection($this->whenLoaded('lecturers')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
