@extends('layouts.app')

@section('title')
{{ $profile->first_name.' '.$profile->last_name }}
@endsection

@section('content')
<div class="container">
    <div class="editprofile">
        <h1 class="editprofile__title">Profile</h1>
        <form method="POST" action="/@/{{$profile->username}}/profile/update" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="editprofile__item">
                <label id="username" class="editprofile__label">Username</label>
                <input type="text" name="username" value="{{ $profile->username }}" class="editprofile__input" id="username">
            </div>
            <div class="editprofile__item">
                <label for="email" class="editprofile__label">Email</label>
                <input type="email" name="email" value="{{ $profile->email }}" class="editprofile__input" id="email">
            </div>
            <div class="editprofile__item">
                <label for="first_name" class="editprofile__label">First Name</label>
                <input type="text" name="first_name" value="{{ $profile->first_name }}" class="editprofile__input" id="first_name">
            </div>
            <div class="editprofile__item">
                <label for="last_name" class="editprofile__label">Last Name</label>
                <input type="text" name="last_name" value="{{ $profile->last_name }}" class="editprofile__input" id="last_name">
            </div>
            <div class="editprofile__item">
                <label for="role" class="editprofile__label">Role</label>
                <select name="role" id="role" class="editprofile__select">
                    <option value="administrator" @if($profile->role === "administrator") selected @endif> Administrator </option>
                    <option value="subscriber" @if($profile->role === "subscriber") selected @endif> Subscriber </option>
                    <option value="editor" @if($profile->role === "editor") selected @endif> Editor </option>
                    <option value="author" @if($profile->role === "writer") selected @endif> Writer </option>
                    <option value="contributor" @if($profile->role === "moderator") selected @endif> Moderator </option>
                </select>
            </div>
            <div class="editprofile__item">
                <label for="avatar" class="editprofile__label">Current Avatar</label>
                <img src="{{ asset('/storage/'.$profile->avatar) }}" alt="" class="editprofile__img">
            </div>
            <div class="editprofile__item">
                <label for="avatar" class="editprofile__label">New Avatar</label>
                <input type="file" class="editprofile__input" name="avatar" id="avatar">
            </div>
            <div class="editprofile__item">
                <label for="bio" class="editprofile__label">Bio</label>
                <textarea name="bio" id="bio" cols="5" rows="5" class="editprofile__textarea">{{ $profile->bio }}</textarea>
            </div>
            <button type="submit" class="btn btn--primary editprofile__btn">Update Profile</button>
        </form>
    </div>
</div>
@endsection
