<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
