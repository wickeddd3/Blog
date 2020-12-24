<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;

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
        $posts = $posts->paginate(10);

        if($search) {
            $posts = $this->model->published()->where('title', 'LIKE', "%{$search}%");
            $posts = $posts->paginate(10);
            $posts->appends(['search' => $search]);
        }

        return $posts;
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
