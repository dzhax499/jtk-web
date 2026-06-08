<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $guarded = [];

    protected $casts = [
        'extra_attributes' => 'array',
        'objectives' => 'array',
        'graduate_profiles' => 'array',
        'job_positions' => 'array',
        'facilities' => 'array',
        'career_prospects_list' => 'array',
    ];

    public function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }
}
