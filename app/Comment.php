<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $with = ['owner'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            $comment->post->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->post->decrement('comments_count');
        });

    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
