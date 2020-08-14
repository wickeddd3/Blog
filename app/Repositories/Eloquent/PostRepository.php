<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function all($search)
    {
        $posts = $this->model->published()->orderBy('published_at', 'asc');
        $posts_count = $posts->count();
        $posts = $posts->paginate(10);

        if($search) {
            $posts = $this->model->published()->where('title', 'LIKE', "%{$search}%");
            $posts_count = $posts->count();
            $posts = $posts->paginate(10);
            $posts->appends(['search' => $search]);
        }

        $result =  ["posts" => $posts, "posts_count" => $posts_count];

        return $result;
    }

    public function create($request)
    {
        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('storage/uploads/posts', $featured_new_name);

        $post = $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/'.$featured_new_name,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'published_at' => Carbon::now()
        ]);

        $post->tags()->attach($request->tags);

        $post->author->notifyFollowers($post);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($request, $id)
    {
        $post = $this->model->find($id);

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
        $post = $this->model->drafted()->where('id', $id)->first();

        $post->update(['published_at' => Carbon::now()]);
    }

    public function feature($id)
    {
        $post = $this->model->published()->where('id', $id)->first();

        $post->update(['featured_at' => Carbon::now()]);
    }

    public function unfeature($id)
    {
        $post = $this->model->published()->where('id', $id)->first();

        $post->update(['featured_at' => null]);
    }

    public function trash($id)
    {
        $post = $this->model->withTrashed()->where('id', $id)->first();

        $post->delete();
    }

    public function restore($id)
    {
        $post = $this->model->onlyTrashed()->where('id', $id)->first();

        $post->restore();
    }

    public function delete($id)
    {
        $post = $this->model->onlyTrashed()->where('id', $id)->first();

        if($post->trashed()) {
            $post->forceDelete();
            $post->deleteFeatured();
            $post->deleteTags();
        }
    }

}
