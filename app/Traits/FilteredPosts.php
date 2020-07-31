<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;

trait FilteredPosts
{
    public function scopeLatestPosts($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopularPosts($query)
    {
        return $query->where('comments_count', '>', 0)->orderBy('comments_count', 'desc');
    }

    public function scopeBookmarkedPosts($query)
    {
        return $query->whereHas('bookmarks', function($query) {
            return $query->where('user_id', auth()->id());
        });
    }

    public function scopeLikedPosts($query)
    {
        return $query->whereHas('likes', function($query) {
            return $query->where('user_id', auth()->id());
        });
    }

    public function scopeUserPosts($query, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $query->where('user_id', $user->id);
    }

    public function scopeFeaturedPosts($query)
    {
        return $query->where('featured_at', '!=', null)->orderBy('featured_at', 'desc');
    }

    public function scopeArchivedPosts($query)
    {
        return Post::all()->groupBy(function ($post) {
            return Carbon::parse($post->published_at)->format('M Y');
        });
    }

}
