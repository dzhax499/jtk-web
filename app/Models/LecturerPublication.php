<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerPublication extends Model
{
    protected $table = 'lecturer_publications';

    protected $guarded = [];

    protected $casts = [
        'extra_attributes' => 'array',
        'raw_data' => 'array',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}