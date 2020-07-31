<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
