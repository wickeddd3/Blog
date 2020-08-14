<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\User;

trait FilteredPosts
{
    public function scopeLatestPosts($query)
    {
        return $query->published()->orderBy('published_at', 'desc');
    }

    public function scopePopularPosts($query)
    {
        return $query->published()->where('comments_count', '>', 0)->orderBy('comments_count', 'desc');
    }

    public function scopeBookmarkedPosts($query)
    {
        return $query->published()->whereHas('bookmarks', function($query) {
            return $query->where('user_id', auth()->id());
        });
    }

    public function scopeLikedPosts($query)
    {
        return $query->published()->whereHas('likes', function($query) {
            return $query->where('user_id', auth()->id());
        });
    }

    public function scopeUserPosts($query, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $query->published()->where('user_id', $user->id);
    }

    public function scopeFeaturedPosts($query)
    {
        return $query->published()->where('featured_at', '!=', null)->orderBy('featured_at', 'desc');
    }

    public function scopeArchive($query)
    {
        return $query->published()->get()->groupBy(function ($post) {
            return Carbon::parse($post->published_at)->format('M Y');
        });
    }

    public function scopeArchivedPosts($query, $archive)
    {
        return $query->published()
                ->whereYear('published_at', Carbon::parse($archive)->year)
                ->whereMonth('published_at', Carbon::parse($archive)->month);
    }

}
