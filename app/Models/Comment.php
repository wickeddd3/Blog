<?php

namespace App\Models;

class Comment extends BaseModel
{
    public $timestamps = false;

    protected $with = ['owner'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
