@extends('layouts.app')

@section('content')
<div class="container pt-4">
    <h1>Profile</h1>
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="/profile/{{$profile->username}}/@/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="username" class="col-sm-4 col-form-label">Username</label>
                  <div class="col-sm-8">
                    <input type="text" name="username" value="{{ $profile->username }}" class="form-control form-control-sm" id="username">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" value="{{ $profile->email }}" class="form-control form-control-sm" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control form-control-sm" id="first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control form-control-sm" id="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                      <select name="role" id="role" class="form-control form-control-sm">
                        <option value="administrator" @if($profile->role === "administrator") selected @endif> Administrator </option>
                        <option value="subscriber" @if($profile->role === "subscriber") selected @endif> Subscriber </option>
                        <option value="editor" @if($profile->role === "editor") selected @endif> Editor </option>
                        <option value="author" @if($profile->role === "author") selected @endif> Author </option>
                        <option value="contributor" @if($profile->role === "contributor") selected @endif> Contributor </option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-sm-4 col-form-label">Current Avatar</label>
                    <div class="col-sm-8">
                        <img src="{{ asset('/storage/'.$profile->profile->avatar) }}" alt="" style="width: 25%">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-sm-4 col-form-label">New Avatar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control form-control-sm" name="avatar" id="avatar">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bio" class="col-sm-4 col-form-label">Bio</label>
                    <div class="col-sm-8">
                        <textarea name="bio" id="bio" cols="5" rows="5" class="form-control form-control-sm">{{ $profile->profile->bio }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Update Profile</button>
            </form>
        </div>
        <div class="col-md-5">

        </div>
    </div>
</div>
@endsection
