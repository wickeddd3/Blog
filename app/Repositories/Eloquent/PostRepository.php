<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function all($filter)
    {
        $posts = Post::published();

        switch($filter)
        {
            case "drafted":
                $posts = Post::drafted();
            break;
            case "trashed":
                $posts = Post::onlyTrashed();
            break;
        }

        $posts = $posts->simplePaginate(10);

        return $posts;
    }

    public function create($request)
    {
        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('storage/uploads/posts', $featured_new_name);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/'.$featured_new_name,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $post->tags()->attach($request->tags);

        $post->author->notifyFollowers($post);
    }

    public function find($id)
    {
        return Post::findOrFail($id);
    }

    public function update($request, $id)
    {
        $post = Post::findOrFail($id);

        if($request->hasFile('featured'))
        {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('storage/uploads/posts', $featured_new_name);
            if($post->featured != 'uploads/posts/default_featured.png'){
                $post->deleteFeatured();
            }
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->slug = Str::slug($request->title, '-');
        $post->updated_at = Carbon::now();

        $post->save();

        $post->tags()->sync($request->tags);
    }

    public function publish($id)
    {
        $post = Post::drafted()->where('id', $id)->first();

        $post->update(['published_at' => Carbon::now()]);
    }

    public function feature($id)
    {
        $post = Post::published()->where('id', $id)->first();

        $post->update(['featured_at' => Carbon::now()]);
    }

    public function trash($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->delete();
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        $post->restore();
    }

    public function delete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        if($post->trashed()) {
            $post->forceDelete();
            $post->deleteFeatured();
            $post->deleteTags();
        }
    }

}
