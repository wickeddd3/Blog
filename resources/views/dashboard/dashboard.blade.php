@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5>Dashboard</h5>
    <div class="pt-2">
        <div class="row">
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fa fa-book fa-fw"></i> Posts
                    </div>
                    <div class="card-body text-center">
                        <h5>{{ $postsCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fa fa-users fa-fw"></i> Users
                    </div>
                    <div class="card-body text-center">
                        <h5>{{ $usersCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fa fa-archive fa-fw"></i> Categories
                    </div>
                    <div class="card-body text-center">
                        <h5>{{ $categoriesCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fa fa-tags fa-fw"></i> Tags
                    </div>
                    <div class="card-body text-center">
                        <h5>{{ $tagsCount }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-2">
            <div class="jumbotron">
                <h1 class="display-4">Hello, {{ Auth::user()->full_name }}!</h1>
                <p class="lead">Share your insights and ideas to everyone around the world.</p>
                <hr class="my-4">
                <p>Create your new post today, click create new post.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('post.add') }}" role="button">Create new post</a>
            </div>
        </div>
    </div>
</div>
@endsection
