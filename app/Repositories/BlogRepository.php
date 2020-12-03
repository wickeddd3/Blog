<?php

namespace App\Repositories;


use App\Interfaces\BlogRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogRepository implements BlogRepositoryInterface
{
    protected $post;
    protected $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function all($category, $archive)
    {
        $cat = $this->category->where('slug', $category)->first();

        $posts = $this->post->latestPosts();
        $header = "Latest Posts";

        if($cat) {
            $posts = $posts->where('category_id', $cat->id);
            $header = ucfirst($cat->name)." Posts";
        }

        switch($category)
        {
            case "latest":
                $posts = $this->post->latestPosts();
                $header = "Latest Posts";
                break;
            case "popular":
                $posts = $this->post->popularPosts();
                $header = "Popular Posts";
                break;
            case "featured":
                $posts = $this->post->featuredPosts();
                $header = "Featured Posts";
                break;
            case "archived":
                $posts = $this->post->archivedPosts($archive);
                $header = "$archive Posts";
                break;
        }

        $posts = $posts->paginate(10);

        $result =  ["posts" => $posts, "header" => $header];

        return $result;
    }

    public function view($post)
    {
        $post->increment('views_count');
    }

    public function create($request)
    {
        $featured = $request['featured'];
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('storage/uploads/posts', $featured_new_name);

        $post = $this->post->create([
            'title' => $request['title'],
            'content' => $request['content'],
            'featured' => 'uploads/posts/'.$featured_new_name,
            'category_id' => $request['category'],
            'slug' => Str::slug($request['title'], '-'),
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'published_at' => Carbon::now()
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
            $posts = $this->post->published()->where('title', 'LIKE', "%{$query}%")->paginate(8);
            $posts->appends(['search' => $query]);
        }

        return $posts;
    }

}
