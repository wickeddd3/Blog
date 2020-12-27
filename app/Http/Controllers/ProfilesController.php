<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Interfaces\ProfileRepositoryInterface;

class ProfilesController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->middleware(['auth', 'verified']);

        $this->profileRepository = $profileRepository;
    }

    public function index(User $username)
    {
        return view('profile.index')->with('profile', $username);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->profileRepository->update($request);

        return redirect()->back();
    }

    public function posts(User $username)
    {
        $posts = $this->profileRepository->filter($username, request()->query('filter'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts
            ]);
        }
    }

    public function edit(User $username)
    {
        return view('profile.edit')->with('profile', $username);
    }

    public function notifications($username)
    {
        $notifications = $this->profileRepository->notifications();

        if(request()->wantsJson()) {
            return response()->json([
                'notifications' => $notifications,
            ]);
        }

        return view('profile.notification.index');
    }

    public function markAsRead($username, Request $request)
    {
        return $this->profileRepository->markAsRead($username, $request);
    }

}
