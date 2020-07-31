<?php

namespace App\Models;

use App\Notifications\UserCreatedPost;

class UserFollower extends BaseModel
{
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
