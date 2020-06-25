<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\UserCreatedPost;

class UserFollower extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function notify($post)
    {
        $this->user->notify(new UserCreatedPost($this->author, $post));
    }

}
