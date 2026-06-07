<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'raw_data' => 'array',
        'extra_attributes' => 'array',
    ];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function expertiseAreas()
    {
        return $this->belongsToMany(ExpertiseArea::class);
    }

    public function portfolioItems()
    {
        return $this->hasMany(LecturerPortfolioItem::class);
    }

    public function links()
    {
        return $this->hasMany(LecturerLink::class);
    }

    public function educations()
    {
        return $this->hasMany(LecturerEducation::class)->orderBy('sort_order')->orderByDesc('graduation_year');
    }

    public function teachingHistories()
    {
        return $this->hasMany(LecturerTeachingHistory::class)->orderByDesc('academic_year')->orderBy('course_name');
    }

    public function publications()
    {
        return $this->hasMany(LecturerPublication::class)->orderByDesc('year')->orderByDesc('citation_count');
    }
}
