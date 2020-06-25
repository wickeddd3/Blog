<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Tag;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.dashboard')
                ->with('postsCount', Post::where('published_at', '!=', null)->count())
                ->with('usersCount', User::all()->count())
                ->with('categoriesCount', Category::all()->count())
                ->with('tagsCount', Tag::all()->count());
    }
}
