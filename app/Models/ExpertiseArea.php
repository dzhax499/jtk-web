<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertiseArea extends Model
{
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $guarded = [];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }
}
