<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Blogs
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/posts', 'BlogsController@index');
Route::post('/posts', 'BlogsController@store');
Route::get('/posts/{category}', 'BlogsController@index');
Route::get('/posts/{category}/{post}', 'BlogsController@show');
Route::get('/posts/{category}/{post}/edit', 'BlogsController@edit');
Route::put('/posts/{category}/{post}/update', 'BlogsController@update');
Route::get('/profile/{username}/post/create', 'BlogsController@create');
Route::get('/search', 'BlogsController@search');

// Post Comment Routes
Route::post('/posts/{category}/{post}/comments', 'CommentsController@store');
Route::get('/posts/{category}/{post}/comments', 'CommentsController@show');
Route::patch('/comments/{comment}', 'CommentsController@update');
Route::delete('/comments/{comment}', 'CommentsController@destroy');

// Post Action Routes
Route::post('/posts/{category}/{post}/bookmarks', 'PostBookmarksController@bookmark');
Route::delete('/posts/{category}/{post}/bookmarks', 'PostBookmarksController@unbookmark');
Route::post('/posts/{category}/{post}/likes', 'LikesController@like');
Route::delete('/posts/{category}/{post}/likes', 'LikesController@unlike');

// Profile
Route::get('/profile/{user}/{filter}', 'ProfilesController@filter');
Route::get('/profile/{user}', 'ProfilesController@profile');
Route::get('/profile/{user}/@/edit', 'ProfilesController@edit');
Route::put('/profile/{user}/@/update', 'ProfilesController@update');
Route::post('/profile/{user}/followers', 'UserFollowersController@index');
Route::delete('/profile/{user}/followers', 'UserFollowersController@destroy');
Route::get('/profile/{user}/all/notifications', 'ProfilesController@notifications');
Route::post('/profile/{user}/all/notifications/read', 'ProfilesController@markAsRead');

// Auth Routes
Auth::routes(['verify' => true]);

// Admin Dashboard Routes
Route::prefix('dashboard')->middleware('can:dashboard-access')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // Posts Routes
    Route::get('/posts', 'PostsController@index');
    Route::get('/post/add', 'PostsController@create')->name('post.add');
    Route::post('/post', 'PostsController@store')->name('post.store');
    Route::get('/post/{id}/edit', 'PostsController@edit')->name('post.edit');
    Route::put('/post/{id}/update', 'PostsController@update')->name('post.update');
    Route::get('/post/{id}/trash', 'PostsController@trash')->name('post.trash');
    Route::get('/post/{id}/restore', 'PostsController@restore')->name('post.restore');
    Route::get('/post/{id}/delete', 'PostsController@destroy')->name('post.delete');
    Route::get('/post/{id}/publish', 'PostsController@publish')->name('post.publish');
    Route::get('/post/{id}/feature', 'PostsController@feature')->name('post.feature');
    Route::get('/post/{id}/unfeature', 'PostsController@unfeature')->name('post.unfeature');
    // Categories Routes
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::post('/category', 'CategoriesController@store')->name('category.store');
    Route::get('/category/{id}/edit', 'CategoriesController@edit')->name('category.edit');
    Route::put('/category/{id}/update', 'CategoriesController@update')->name('category.update');
    Route::get('/category/{id}/delete', 'CategoriesController@destroy')->name('category.delete');
    // Tags Routes
    Route::get('/tags', 'TagsController@index')->name('tags');
    Route::post('/tag', 'TagsController@store')->name('tag.store');
    Route::get('/tag/{id}/edit', 'TagsController@edit')->name('tag.edit');
    Route::put('/tag/{id}/update', 'TagsController@update')->name('tag.update');
    Route::get('/tag/{id}/delete', 'TagsController@destroy')->name('tag.delete');
    // Users Routes
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/user/add', 'UsersController@create')->name('user.add');
    Route::post('/user', 'UsersController@store')->name('user.store');
    Route::get('/user/{id}/edit', 'UsersController@edit')->name('user.edit');
    Route::put('/user/{id}/update', 'UsersController@update')->name('user.update');
    // Profiles Routes
    Route::get('/profile', 'ProfilesController@index')->name('profile');
    Route::post('/profile', 'ProfilesController@update')->name('profile.store');
});
