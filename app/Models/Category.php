<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $table = 'categories'; // Pastikan nama tabelnya sesuai di Supabase
    protected $guarded = []; // Agar tidak kena error Mass Assignment

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}