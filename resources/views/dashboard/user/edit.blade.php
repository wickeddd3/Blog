@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5>Edit User</h5>
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ $user->username }}" id="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $user->email }}" id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ $user->first_name }}" id="first_name">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ $user->last_name }}" id="last_name">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                        <select name="role" id="role" class="form-control">
                            <option value="administrator" @if($user->role === "administrator") selected @endif> Administrator </option>
                            <option value="subscriber" @if($user->role === "subscriber") selected @endif> Subscriber </option>
                            <option value="editor" @if($user->role === "editor") selected @endif> Editor </option>
                            <option value="author" @if($user->role === "author") selected @endif> Author </option>
                            <option value="contributor" @if($user->role === "contributor") selected @endif> Contributor </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-sm-4 col-form-label">Current Avatar</label>
                    <div class="col-sm-8">
                        <img src="{{ asset('/storage/'.$user->profile->avatar) }}" alt="" style="width: 25%">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-sm-4 col-form-label">New Avatar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="avatar" id="avatar">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Update User</button>
            </form>
        </div>
        <div class="col-md-5">

        </div>
    </div>
</div>
@endsection
