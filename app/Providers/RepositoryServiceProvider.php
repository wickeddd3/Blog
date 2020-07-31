<?php

namespace App\Providers;



use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\BlogRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\TagRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProfileRepository;
use App\Repositories\Eloquent\UserRepository;

use App\Repositories\CommentRepositoryInterface;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
