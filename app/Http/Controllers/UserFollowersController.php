<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserFollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(User $user)
    {
        $user->follow(auth()->id());
    }

    public function destroy(User $user)
    {
        $user->unfollow(auth()->id());
    }

}
