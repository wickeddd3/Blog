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
                    <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="username">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" id="first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="last_name">
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
