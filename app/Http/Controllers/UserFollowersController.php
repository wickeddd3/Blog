<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserFollowersController extends Controller
{
    public function index(User $user)
    {
        $user->follow(auth()->id());
    }

    public function destroy(User $user)
    {
        $user->unfollow(auth()->id());
    }

}
