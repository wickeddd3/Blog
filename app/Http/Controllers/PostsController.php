<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware(['auth', 'verified']);

        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all(request()->query('search'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts
            ]);
        }

        return view('dashboard.post.index');
    }

    public function feature(Request $request)
    {
        $this->postRepository->feature($request->id);

        return response()->json(['success' => 'featured']);
    }

    public function unfeature(Request $request)
    {
        $this->postRepository->unfeature($request->id);

        return response()->json(['success' => 'unfeatured']);
    }

}
