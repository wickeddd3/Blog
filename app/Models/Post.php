<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\Likable;
use App\Traits\FilteredPosts;

class Post extends BaseModel
{
    use SoftDeletes, Likable, FilteredPosts;

    public $timestamps = false;

    protected $appends = ['isBookmarked', 'likesCount', 'isLiked', 'path'];

    protected $with = ['author', 'category', 'tags', 'comments', 'likes'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/{$this->category->slug}/{$this->slug}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(function ($category) {
            $category->name = 'uncategorized';
            $category->slug = 'uncategorized';
            $category->description = 'uncategorized';
        });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '!=', null);
    }

    public function scopeDrafted($query)
    {
        return $query->where('published_at', null);
    }

    public function deleteFeatured()
    {
        $imagePath = public_path().'/storage/'.$this->featured;
        unlink($imagePath);
    }

    public function deleteTags()
    {
        $this->tags()->detach($this->tags);
    }

    public function addComment($comment)
    {
        $comment = $this->comments()->create($comment);

        return $comment;
    }

    public function bookmark($userId = null)
    {
        $this->bookmarks()->create([
            'user_id' => $userId ?: Auth::id()
        ]);
    }

    public function unbookmark($userId = null)
    {
        $this->bookmarks()
             ->where('user_id', $userId ?: Auth::id())
             ->delete();
    }

    public function bookmarks()
    {
        return $this->hasMany(PostBookmark::class);
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->bookmarks()
                    ->where('user_id', Auth::id())
                    ->exists();
    }


}
