<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing Page
Route::get('/', 'FrontendController@index')->name('frontend.index');

// Blogs Routes
Route::get('/posts', 'BlogsController@index');
Route::get('/posts/{category}', 'BlogsController@index');
Route::post('/posts', 'BlogsController@store');
Route::patch('/posts/{post}', 'BlogsController@update');
Route::get('/posts/{category}/{post}', 'BlogsController@show');
Route::get('/posts/{category}/{post}/edit', 'BlogsController@edit');
Route::get('/@/{username}/post/create', 'BlogsController@create');
Route::get('/search', 'BlogsController@search');

// Post Comment Routes
Route::post('/posts/{category}/{post}/comments', 'CommentsController@store');
Route::get('/posts/{category}/{post}/comments', 'CommentsController@show');
Route::patch('/comments/{comment}', 'CommentsController@update');
Route::delete('/comments/{comment}', 'CommentsController@destroy');

// Post Bookmark Routes
Route::post('/posts/{category}/{post}/bookmarks', 'PostBookmarksController@bookmark');
Route::delete('/posts/{category}/{post}/bookmarks', 'PostBookmarksController@unbookmark');

// Post Like Routes
Route::post('/posts/{category}/{post}/likes', 'LikesController@like');
Route::delete('/posts/{category}/{post}/likes', 'LikesController@unlike');

// Profile Routes
Route::get('/@/{username}/profile', 'ProfilesController@index');

// Profile Post Routes
Route::get('/@/{username}/profile/posts', 'ProfilesController@posts');
Route::get('/@/{username}/profile/edit', 'ProfilesController@edit');
Route::put('/@/{username}/profile/update', 'ProfilesController@update');

// Profile Notification Routes
Route::get('/@/{username}/profile/notifications', 'ProfilesController@notifications');
Route::post('/@/{username}/profile/notifications', 'ProfilesController@markAsRead');

// Profile Posts Routes
Route::post('/@/{username}/profile/publish', 'ProfilesController@publish');
Route::post('/@/{username}/profile/trash', 'ProfilesController@trash');
Route::post('/@/{username}/profile/restore', 'ProfilesController@restore');
Route::post('/@/{username}/profile/delete', 'ProfilesController@delete');

// Profile Follow Routes
Route::post('/@/{user}/profile/followers', 'UserFollowersController@index');
Route::delete('/@/{user}/profile/followers', 'UserFollowersController@destroy');

// Auth Routes
Auth::routes(['verify' => true]);

// Admin Dashboard Routes
Route::prefix('dashboard')->middleware('can:dashboard-access')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
        // Posts Routes
        Route::resource('posts', PostsController::Class)->only(['index', 'destroy']);
        Route::post('/posts/feature', 'PostsController@feature')->name('posts.feature');
        Route::post('/posts/unfeature', 'PostsController@unfeature')->name('posts.unfeature');
        // Categories Routes
        Route::resource('categories', CategoriesController::class);
        // Tags Routes
        Route::resource('tags', TagsController::class);
        // Users Routes
        Route::resource('users', UsersController::class)->except('destroy');
    });
});
