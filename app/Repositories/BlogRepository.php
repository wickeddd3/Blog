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

    public function all($category, $filter)
    {
        $cat = $this->category->where('slug', $category)->first();

        $posts = $this->post->latestPosts();

        if($cat) {
            $posts = $posts->where('category_id', $cat->id);
        }

        switch($filter)
        {
            case "latest":
                $posts = $this->post->latestPosts();
                break;
            case "popular":
                $posts = $this->post->popularPosts();
                break;
            case "featured":
                $posts = $this->post->featuredPosts();
                break;
        }

        $posts = $posts->paginate(10);

        return $posts;
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
