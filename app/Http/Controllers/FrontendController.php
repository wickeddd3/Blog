<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\PostFilters;
use Carbon\Carbon;
use App\Tag;
use App\Category;
use App\Post;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index')
                ->with('categories', Category::all())
                ->with('featuredOne', Post::published()->featuredPosts()->first())
                ->with('featuredTwo', Post::published()->featuredPosts()->skip(1)->take(1)->first())
                ->with('editorsChoice', Post::published()->featuredPosts()->skip(2)->take(3)->get())
                ->with('popular', Post::published()->popularPosts()->take(8)->get())
                ->with('archives', Post::archivedPosts());
    }

}
