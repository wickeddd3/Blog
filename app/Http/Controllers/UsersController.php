<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepositoryInterface;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return view('dashboard.user.index')->with('users', $users);
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $this->userRepository->create($request);

        return redirect()->route('users');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('dashboard.user.edit')->with('user', $user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->userRepository->update($request, $id);

        return redirect()->route('users');
    }

}
