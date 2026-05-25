<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // Pastikan nama tabelnya sesuai di Supabase
    protected $guarded = []; // Agar tidak kena error Mass Assignment
}