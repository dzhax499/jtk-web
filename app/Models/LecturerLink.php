<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerLink extends Model
{
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $guarded = [];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
