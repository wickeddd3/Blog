<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null)
    {
        $posts = Post::published();

        switch($filter)
        {
            case "drafted":
                $posts = Post::drafted();
            break;
            case "trashed":
                $posts = Post::onlyTrashed();
            break;
        }

        $posts = $posts->simplePaginate(10);

        return view('dashboard.post.index')->with('posts', $posts)->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.post.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.post.edit')->with('post', Post::findOrFail($id))->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$id,
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required'
        ]);

        $post = Post::find($id);

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

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        if($post->trashed()) {
            $post->forceDelete();
            $post->deleteFeatured();
            $post->deleteTags();
        }

        return redirect()->back();
    }

    public function trash($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->delete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        $post->restore();

        return redirect()->back();
    }

    public function publish($id)
    {
        $post = Post::drafted()->where('id', $id)->first();

        $post->update(['published_at' => Carbon::now()]);

        return redirect()->back();
    }

    public function feature($id)
    {
        $post = Post::published()->where('id', $id)->first();

        $post->update(['featured_at' => Carbon::now()]);

        return redirect()->back();
    }

}
