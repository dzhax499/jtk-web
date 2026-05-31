<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerTeachingHistory extends Model
{
    protected $table = 'lecturer_teaching_histories';

    protected $guarded = [];

    protected $casts = [
        'raw_data' => 'array',
        'is_active' => 'boolean',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}