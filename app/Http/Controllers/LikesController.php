<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function like(Category $category, Post $post)
    {
        $post->like();
    }

    public function unlike(Category $category, Post $post)
    {
        $post->unlike();
    }
}
