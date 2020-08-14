<?php

namespace App\Models;

class Category extends BaseModel
{
    public $timestamps = false;

    public $appends = ['posts_count'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getPostsCountAttribute()
    {
        return $this->hasMany(Post::class)->count();
    }

}
