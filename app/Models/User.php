<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'role', 'username', 'email', 'password',
    ];

    protected $with = ['profile', 'bookmarks', 'likes', 'followers', 'following'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'username';
    }

    protected $appends = [
        'full_name',
        'isFollowedTo',
        'isAdmin',
        'posts_count'
    ];


    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(PostBookmark::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function deleteAvatar()
    {
        $imagePath = public_path().'/storage/'.$this->profile->avatar;
        unlink($imagePath);
    }

    public function notifyFollowers($post)
    {
        $this->followers->where('user_id', '!=', $post->author->id)->each->notify($post);
    }

    public function follow($userId)
    {
        $this->followers()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    public function unfollow($userId)
    {
        $this->followers()->where('user_id', $userId ?: auth()->id())->delete();
    }

    public function followers()
    {
        return $this->hasMany(UserFollower::class, 'author_id');
    }

    public function following()
    {
        return $this->hasMany(UserFollower::class, 'user_id');
    }

    public function getIsFollowedToAttribute()
    {
        return $this->followers()->where('user_id', auth()->id())->exists();
    }

    public function getIsAdminAttribute()
    {
        return $this->role === 'administrator';
    }

    public function getPostsCountAttribute()
    {
        return $this->hasMany(Post::class)->count();
    }

}
