<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index')
                ->with('categories', Category::all())
                ->with('tags', Tag::all())
                ->with('bloggers', User::take(8)->get());
    }

}
