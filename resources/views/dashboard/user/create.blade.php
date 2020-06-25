@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5>Add New User</h5>
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <label for="username" class="col-sm-4 col-form-label">Username</label>
                  <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" id="username">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="first_name" class="form-control" id="first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="last_name" class="form-control" id="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="text" name="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                      <select name="role" id="role" class="form-control">
                        <option value="administrator" selected>Administrator</option>
                        <option value="subscriber">Subscriber</option>
                        <option value="editor">Editor</option>
                        <option value="author">Author</option>
                        <option value="contributor">Contributor</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-sm-4 col-form-label">Avatar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="avatar" id="avatar">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Add New User</button>
            </form>
        </div>
        <div class="col-md-5">

        </div>
    </div>
</div>
@endsection
