<?php

namespace App\Models;

class Category extends BaseModel
{
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
