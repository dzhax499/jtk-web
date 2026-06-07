<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $casts = [
        'extra_attributes' => 'array',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = static::max('id') + 1;
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function featuredMedia()
    {
        return $this->belongsTo(Media::class, 'featured_media_id');
    }
}
