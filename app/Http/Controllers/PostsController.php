<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Tag;
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

    public function publish($id)
    {
        $this->postRepository->publish($id);

        return redirect()->back();
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

    public function trash($id)
    {
        $this->postRepository->trash($id);

        return redirect()->back();
    }

    public function restore($id)
    {
        $this->postRepository->restore($id);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);

        return redirect()->back();
    }

}
