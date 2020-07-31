<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\BlogRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogRepository implements BlogRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all($category)
    {
        $cat = Category::where('slug', $category)->first();

        $posts = Post::published()->latestPosts();
        $header = "Latest Posts";

        if($cat) {
            $posts = $posts->where('category_id', $cat->id)->published();
            $header = "strtoupper($cat->name) Posts";
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

        $result =  ["posts" => $posts, "header" => $header];

        return $result;
    }

    public function create($request)
    {
        $featured = $request['featured'];
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('storage/uploads/posts', $featured_new_name);

        $post = Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'featured' => 'uploads/posts/'.$featured_new_name,
            'category_id' => $request['category'],
            'slug' => Str::slug($request['title'], '-'),
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $post->tags()->attach($request['tags']);

        $post->author->notifyFollowers($post);
    }

    public function update($request, $post)
    {
        if($request->hasFile('featured'))
        {
            $featured = $request['featured'];
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('storage/uploads/posts', $featured_new_name);
            if($post->featured != 'uploads/posts/default_featured.png'){
                $post->deleteFeatured();
            }
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }

        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->category_id = $request['category'];
        $post->slug = Str::slug($request['title'], '-');
        $post->updated_at = Carbon::now();

        $post->save();

        $post->tags()->sync($request['tags']);
    }

    public function search($query)
    {
        $posts = [];

        if($query) {
            $posts = Post::where('title', 'LIKE', "%{$query}%")->paginate(8);
            $posts->appends(['search' => $query]);
        }

        return $posts;
    }

}
