<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicFieldConfig extends Model
{
    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];
}
