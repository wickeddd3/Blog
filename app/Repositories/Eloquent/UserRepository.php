<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::latest()->simplePaginate(10);
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

        $user = User::create([
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
        return User::findOrFail($id);
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
