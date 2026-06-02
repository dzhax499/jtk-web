<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerEducation extends Model
{
    protected $table = 'lecturer_educations';

    protected $guarded = [];

    protected $casts = [
        'raw_data' => 'array',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}