@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="adduser">
        <h1 class="adduser__title">Add New User</h1>
        <form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="adduser__item">
                <label for="username" class="adduser__label">Username</label>
                <input type="text" class="adduser__input @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" id="username" autofocus>
                @error('username')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="email" class="adduser__label">Email</label>
                <input type="email" class="adduser__input @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" id="email">
                @error('email')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="first_name" class="adduser__label">First Name</label>
                <input type="text" class="adduser__input @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{ old('first_name') }}" id="first_name">
                @error('first_name')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="last_name" class="adduser__label">Last Name</label>
                <input type="text" class="adduser__input @error('last_name') is-invalid @enderror"
                        name="last_name" value="{{ old('last_name') }}" id="last_name">
                @error('last_name')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="password" class="adduser__label">Password</label>
                <input type="text" class="adduser__input @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" id="password">
                @error('password')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="role" class="adduser__label">Role</label>
                <select name="role" id="role" class="adduser__select @error('role') is-invalid @enderror">
                    <option value="administrator" selected>Administrator</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="author">Author</option>
                    <option value="contributor">Contributor</option>
                </select>
                @error('role')
                    <span class="adduser__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="adduser__item">
                <label for="avatar" class="adduser__label">Avatar</label>
                <input type="file" class="adduser__input" name="avatar" id="avatar">
            </div>
            <button type="submit" class="btn btn--primary">Add New User</button>
        </form>
    </div>
</div>
@endsection
