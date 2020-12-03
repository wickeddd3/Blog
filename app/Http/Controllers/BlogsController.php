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
        $result = $this->blogRepository->all($category, request()->query('archive'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $result['posts'],
                'header' => $result['header']
            ]);
        }

        return view('blogs.index')->with('header', $result['header']);
    }

    public function store(BlogStoreRequest $request)
    {
        $this->blogRepository->create($request);

        return redirect()->back();
    }

    public function show(Category $category, Post $post)
    {
        $this->blogRepository->view($post);

        return view('blogs.show')->with('post', $post);
    }

    public function create()
    {
        return view('blogs.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function edit(Category $category, Post $post)
    {
        $this->authorize('update', $post);

        return view('blogs.edit')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function update(Category $category, Post $post, BlogUpdateRequest $request)
    {
        $this->authorize('update', $post);

        $this->blogRepository->update($request, $post);

        return redirect('/posts/'.$post->category->slug.'/'.$post->slug);
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
