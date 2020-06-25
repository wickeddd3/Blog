<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Category;
use App\Post;
use App\Tag;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index($category = null)
    {
        $cat = Category::where('slug', $category)->first();

        $posts = Post::published()->latestPosts();
        $header = "Latest Posts";

        if($cat) {
            $posts = $posts->where('category_id', $cat->id)->published();
            $header = strtoupper($cat->name)." Posts";
        }

        switch($category)
        {
            case "latest":
                $posts = Post::published()->latestPosts();
                $header = "Latest Posts";
            break;
            case "popular":
                $posts = Post::published()->popularPosts();
                $header = "Popular Posts";
            break;
            case "featured":
                $posts = Post::published()->featuredPosts();
                $header = "Featured Posts";
            break;
        }

        $posts = $posts->paginate(8);

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts,
                'header' => $header
            ]);
        }

        return view('blogs.index')->with('header', $header);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title',
            'content' => 'required',
            'featured' => 'required|image',
            'category' => 'required',
            'tags' => 'required'
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('storage/uploads/posts', $featured_new_name);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/'.$featured_new_name,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $post->tags()->attach($request->tags);

        $post->author->notifyFollowers($post);

        return redirect()->back();
    }

    public function show(Category $category, Post $post)
    {
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

    public function update(Category $category, Post $post, Request $request)
    {
        $this->authorize('update', $post);

        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$post->id,
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required'
        ]);

        if($request->hasFile('featured'))
        {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('storage/uploads/posts', $featured_new_name);
            if($post->featured != 'uploads/posts/default_featured.png'){
                $post->deleteFeatured();
            }
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->slug = Str::slug($request->title, '-');
        $post->updated_at = Carbon::now();

        $post->save();

        $post->tags()->sync($request->tags);

        return redirect('/posts/'.$post->category->slug.'/'.$post->slug);
    }

    public function search()
    {
        $search = request()->query('search');
        $posts = [];

        if($search) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->paginate(8);
            $posts->appends(['search' => $search]);
        }

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts,
            ]);
        }

        return view('blogs.search')->with('posts', $posts);
    }

}
