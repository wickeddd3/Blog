<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.profile.index')->with('profile', Auth::user());
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

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

        return redirect()->back();
    }

    public function filter($username, $filter)
    {
        $posts = Post::latest();
        $header = "Posts";

        switch($filter)
        {
            case "posts":
                $posts = Post::userPosts($username);
                $header = strtoupper($username)." Posts";
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

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts,
                'header' => $header
            ]);
        }

        return view('profile.post.posts')->with('header', $header);
    }

    public function profile($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return view('profile.index')->with('profile', $user);
    }

    public function edit($username)
    {
        return view('profile.edit')->with('profile', Auth::user());
    }

    public function notifications($username)
    {
        $notifications = auth()->user()->notifications;

        if(request()->wantsJson()) {
            return response()->json([
                'notifications' => $notifications,
            ]);
        }

        return view('profile.notification.index');
    }

    public function markAsRead($username, Request $request)
    {
        return auth()->user()->unreadNotifications->where('id', $request->notificationId)->markAsRead();
    }

}
