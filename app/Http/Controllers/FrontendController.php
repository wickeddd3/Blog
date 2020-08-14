<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index')
                ->with('categories', Category::all())
                ->with('featuredOne', Post::featuredPosts()->first())
                ->with('featuredTwo', Post::featuredPosts()->skip(1)->take(1)->first())
                ->with('editorsChoice', Post::featuredPosts()->skip(2)->take(3)->get())
                ->with('popular', Post::popularPosts()->take(8)->get())
                ->with('archives', Post::archive());
    }

}
