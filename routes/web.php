<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Blogs
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/posts', 'BlogsController@index');
Route::post('/posts', 'BlogsController@store');
Route::patch('/posts/{post}', 'BlogsController@update');
Route::get('/posts/{category}', 'BlogsController@index');
Route::get('/{category}/{post}', 'BlogsController@show');
Route::get('/{category}/{post}/edit', 'BlogsController@edit');
Route::get('/@/{username}/post/create', 'BlogsController@create');
Route::get('/search', 'BlogsController@search');

// Post Comment Routes
Route::post('/{category}/{post}/comments', 'CommentsController@store');
Route::get('/{category}/{post}/comments', 'CommentsController@show');
Route::patch('/comments/{comment}', 'CommentsController@update');
Route::delete('/comments/{comment}', 'CommentsController@destroy');

// Post Action Routes
Route::post('/{category}/{post}/bookmarks', 'PostBookmarksController@bookmark');
Route::delete('/{category}/{post}/bookmarks', 'PostBookmarksController@unbookmark');
Route::post('/{category}/{post}/likes', 'LikesController@like');
Route::delete('/{category}/{post}/likes', 'LikesController@unlike');

// Profile
Route::get('/@/{username}/profile/posts', 'ProfilesController@posts');
Route::get('/@/{username}/profile', 'ProfilesController@index');
Route::get('/@/{username}/profile/edit', 'ProfilesController@edit');
Route::put('/@/{username}/profile/update', 'ProfilesController@update');
Route::get('/@/{username}/profile/notifications', 'ProfilesController@notifications');
Route::post('/@/{username}/profile/notifications', 'ProfilesController@markAsRead');

// Profile Action Routes
Route::post('/@/{user}/profile/followers', 'UserFollowersController@index');
Route::delete('/@/{user}/profile/followers', 'UserFollowersController@destroy');


Route::get('/posts/{id}/trash', 'PostsController@trash')->name('posts.trash');
Route::get('/posts/{id}/restore', 'PostsController@restore')->name('posts.restore');
Route::get('/posts/{id}/publish', 'PostsController@publish')->name('posts.publish');


// Auth Routes
Auth::routes();
Route::get('account/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('account/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('account/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Admin Dashboard Routes
Route::prefix('admin/panel')->middleware('can:dashboard-access')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('index');
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
