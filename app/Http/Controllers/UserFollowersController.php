<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserFollowersController extends Controller
{
    public function index(User $username)
    {
        $username->follow(auth()->id());
    }

    public function destroy(User $username)
    {
        $username->unfollow(auth()->id());
    }

}
