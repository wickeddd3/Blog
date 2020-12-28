<?php

namespace App\Repositories;

use Carbon\Carbon;
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

}
