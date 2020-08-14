<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\PostRepositoryInterface;

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
        $result = $this->postRepository->all(request()->query('search'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $result['posts'],
                'posts_count' => $result['posts_count']
            ]);
        }

        return view('dashboard.post.index');
    }

    public function create()
    {
        return view('dashboard.post.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function store(PostStoreRequest $request)
    {
        $this->postRepository->create($request);

        return redirect()->back();
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        return view('dashboard.post.edit')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $this->postRepository->update($request, $id);

        return redirect()->back();
    }

    public function publish($id)
    {
        $this->postRepository->publish($id);

        return redirect()->back();
    }

    public function feature($id)
    {
        $this->postRepository->feature($id);

        return redirect()->back();
    }

    public function unfeature($id)
    {
        $this->postRepository->unfeature($id);

        return redirect()->back();
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
