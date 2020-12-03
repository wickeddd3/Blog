<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function update($request)
    {
        $user = User::findOrFail(Auth::id());

        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('storage/uploads/avatars', $avatar_new_name);
            if($user->profile->avatar != 'uploads/avatars/default_avatar.png'){
                $user->deleteAvatar();
            }
            $avatar = 'uploads/avatars/'.$avatar_new_name;
            $user->profile->avatar = $avatar;
            $user->push();
        }

        if($request->has('bio'))
        {
            $user->profile->bio = $request->bio;
            $user->push();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $request->role;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->updated_at = Carbon::now();

        $user->save();
    }

    public function filter($user, $filter)
    {
        $posts = $this->post->latest();
        $header = "Posts";

        switch($filter)
        {
            case "posts":
                $posts = $this->post->userPosts($user);
                $header = strtoupper($user)." Posts";
            break;
            case "likes":
                $posts = $this->post->likedPosts();
                $header = "Liked Posts";
            break;
            case "bookmarks":
                $posts = $this->post->bookmarkedPosts();
                $header = "Bookmarked Posts";
            break;
        }

        $posts = $posts->paginate(8);

        return ["posts" => $posts, "header" => $header];
    }

    public function notifications()
    {
        return Auth::user()->notifications;
    }

    public function markAsRead($user, $request)
    {
        Auth::user()->unreadNotifications->where('id', $request->notificationId)->markAsRead();
    }

}
