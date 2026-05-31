<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $guarded = [];

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
}
