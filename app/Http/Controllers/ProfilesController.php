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

    public function index()
    {
        $authUser = $this->profileRepository->authUser();

        return view('dashboard.profile.index')->with('profile', $authUser);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->profileRepository->update($request);

        return redirect()->back();
    }

    public function posts($user)
    {
        $posts = $this->profileRepository->filter($user, request()->query('filter'));

        if(request()->wantsJson()) {
            return response()->json([
                'posts' => $posts
            ]);
        }
    }

    public function profile(User $user)
    {
        return view('profile.index')->with('profile', $user);
    }

    public function edit(User $user)
    {
        return view('profile.edit')->with('profile', $user);
    }

    public function notifications($user)
    {
        $notifications = $this->profileRepository->notifications();

        if(request()->wantsJson()) {
            return response()->json([
                'notifications' => $notifications,
            ]);
        }

        return view('profile.notification.index');
    }

    public function markAsRead($user, Request $request)
    {
        return $this->profileRepository->markAsRead($user, $request);
    }

}
