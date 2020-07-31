<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function authUser()
    {
        return Auth::user();
    }

    public function update($request)
    {
        $user = $this->authUser();

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
        $posts = Post::latest();
        $header = "Posts";

        switch($filter)
        {
            case "posts":
                $posts = Post::userPosts($user);
                $header = strtoupper($user)." Posts";
            break;
            case "likes":
                $posts = Post::likedPosts();
                $header = "Liked Posts";
            break;
            case "bookmarks":
                $posts = Post::bookmarkedPosts();
                $header = "Bookmarked Posts";
            break;
        }

        $posts = $posts->paginate(8);

        return ["posts" => $posts, "header" => $header];
    }

    public function notifications()
    {
        return $this->authUser()->notifications;
    }

    public function markAsRead($user, $request)
    {
        $this->authUser()->unreadNotifications->where('id', $request->notificationId)->markAsRead();
    }

}
