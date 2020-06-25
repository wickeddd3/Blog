<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Category;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        return view('dashboard.comment.index');
    }

    public function store(Category $category, Post $post, Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $comment = $post->addComment([
            'message' => $request->message,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        if(request()->expectsJson()) {
            return $comment->load('owner.profile');
        }

    }

    public function show(Category $category, Post $post)
    {
        return $post->comments()->paginate(8);
    }

    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $comment->update([
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        if(request()->expectsJson()) {
            return response(['status' => 'comment deleted']);
        }

        return back();
    }
}
