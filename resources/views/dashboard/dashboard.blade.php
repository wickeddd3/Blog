@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5>Dashboard</h5>
    <div class="pt-2">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Posts</span>
                    <span class="info-box-number">{{ $postsCount }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number">{{ $usersCount }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Categories</span>
                    <span class="info-box-number">{{ $categoriesCount }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-tags"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tags</span>
                    <span class="info-box-number">{{ $tagsCount }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


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
