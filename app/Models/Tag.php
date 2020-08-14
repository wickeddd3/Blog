<?php

namespace App\Models;

class Tag extends BaseModel
{
    public $timestamps = false;

    public $appends = ['posts_count'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getPostsCountAttribute()
    {
        return $this->belongsToMany(Post::class)->count();
    }
}
