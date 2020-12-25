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
            if($user->avatar != 'uploads/avatars/default_avatar.png'){
                $user->deleteAvatar();
            }
            $avatar = 'uploads/avatars/'.$avatar_new_name;
            $user->avatar = $avatar;
            $user->push();
        }

        if($request->has('bio'))
        {
            $user->bio = $request->bio;
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

    public function filter($username, $filter)
    {
        $posts = $this->post->userPosts($username);

        switch($filter)
        {
            case "posts":
                $posts = $this->post->userPosts($username);
            break;
            case "likes":
                $posts = $this->post->likedPosts();
            break;
            case "bookmarks":
                $posts = $this->post->bookmarkedPosts();
            break;
        }

        $posts = $posts->paginate(8);

        return $posts;
    }

    public function notifications()
    {
        return Auth::user()->notifications;
    }

    public function markAsRead($username, $request)
    {
        Auth::user()->unreadNotifications->where('id', $request->notificationId)->markAsRead();
    }

}
