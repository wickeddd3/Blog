<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogUpdateRequest;
use App\Http\Requests\BlogStoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Interfaces\BlogRepositoryInterface;

class BlogsController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show']);

        $this->blogRepository = $blogRepository;
    }

    public function index($category = null)
    {
        $posts = $this->blogRepository->all($category, request()->query('filter'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts
            ]);
        }
    }

    public function store(BlogStoreRequest $request)
    {
        $this->blogRepository->create($request->form);

        return response()->json(['success' => 'Saved']);
    }

    public function show($category, Post $post)
    {
        $this->blogRepository->view($post);

        return view('blogs.show')->with('post', $post);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function edit($category, Post $post)
    {
        $this->authorize('update', $post);

        if(request()->wantsJson()) {
            return response()->json([
                'post' => $post
            ]);
        }

        return view('blogs.edit');
    }

    public function update(Post $post, BlogUpdateRequest $request)
    {
        $this->authorize('update', $post);

        $this->blogRepository->update($request->form, $post);

        return response()->json(['success' => 'Updated']);
    }

    public function search()
    {
        $posts = $this->blogRepository->search(request()->query('search'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts,
            ]);
        }

        return view('blogs.search')->with('posts', $posts);
    }

}
