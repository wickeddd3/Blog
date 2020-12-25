@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="edituser">
        <h1 class="edituser__title">Edit User</h1>
        <form method="POST" action="{{ route('dashboard.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="edituser__item">
                <label for="username" class="edituser__label">Username</label>
                <input type="text" class="edituser__input @error('username') is-invalid @enderror"
                            name="username" value="{{ $user->username }}" id="username" autofocus>
                @error('username')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="email" class="edituser__label">Email</label>
                <input type="email" class="edituser__input @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email }}" id="email">
                @error('email')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="first_name" class="edituser__label">First Name</label>
                <input type="text" class="edituser__input @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{ $user->first_name }}" id="first_name">
                @error('first_name')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="last_name" class="edituser__label">Last Name</label>
                <input type="text" class="edituser__input @error('last_name') is-invalid @enderror"
                        name="last_name" value="{{ $user->last_name }}" id="last_name">
                @error('last_name')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="password" class="edituser__label">Password</label>
                <input type="text" class="edituser__input @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" id="password">
                @error('password')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="role" class="edituser__label">Role</label>
                <select name="role" id="role" class="edituser__select">
                    <option value="administrator" @if($user->role === "administrator") selected @endif> Administrator </option>
                    <option value="subscriber" @if($user->role === "subscriber") selected @endif> Subscriber </option>
                    <option value="editor" @if($user->role === "editor") selected @endif> Editor </option>
                    <option value="author" @if($user->role === "writer") selected @endif> Writer </option>
                    <option value="contributor" @if($user->role === "moderator") selected @endif> Moderator </option>
                </select>
                @error('role')
                    <span class="edituser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="edituser__item">
                <label for="avatar" class="edituser__label">Current Avatar</label>
                <img src="{{ asset('/storage/'.$user->profile->avatar) }}" alt="" style="width: 25%">
            </div>
            <div class="edituser__item">
                <label for="avatar" class="edituser__label">Avatar</label>
                <input type="file" class="edituser__input" name="avatar" id="avatar">
            </div>
            <button type="submit" class="btn btn--primary">Update User</button>
        </form>
    </div>
</div>
@endsection
