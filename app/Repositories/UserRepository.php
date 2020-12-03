<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all($search)
    {
        $users = $this->model->latest();
        $users_count = $users->count();
        $users = $users->paginate(10);

        if($search) {
            $users = $this->model->where('first_name', 'LIKE', "%{$search}%")->orWhere('last_name', 'LIKE', "%{$search}%");
            $users_count = $users->count();
            $users = $users->paginate(10);
            $users->appends(['search' => $search]);
        }

        return ['users' => $users, 'users_count' => $users_count];
    }

    public function create($request)
    {
        $avatar = 'uploads/avatars/default_avatar.png';

        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('storage/uploads/avatars', $avatar_new_name);
            $avatar = 'uploads/avatars/'.$avatar_new_name;
        }

        $user = $this->model->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => Carbon::now()
        ]);

        $user->profile()->create([
            'user_id' => $user->id,
            'avatar' => $avatar,
            'created_at' => Carbon::now()
        ]);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($request, $id)
    {
        $user = $this->find($id);

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

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = $request->role;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->updated_at = Carbon::now();

        $user->save();
    }

}
