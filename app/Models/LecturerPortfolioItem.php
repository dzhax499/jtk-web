<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerPortfolioItem extends Model
{
    protected $guarded = [];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
