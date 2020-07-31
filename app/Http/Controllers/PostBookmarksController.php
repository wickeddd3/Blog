<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostBookmarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bookmark(Category $category, Post $post)
    {
        $post->bookmark();
    }

    public function unbookmark(Category $category, Post $post)
    {
        $post->unbookmark();
    }
}
