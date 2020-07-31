<?php

namespace App\Models;

class Tag extends BaseModel
{
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
