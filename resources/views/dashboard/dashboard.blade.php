@extends('dashboard.layouts.app')

@section('content')
<div class="dashboard">
    <h5 class="heading-primary">Dashboard</h5>
    <div class="container__row">
        <div class="container__col-xl-3 container__col-12">
            <div class="widget">
                <div class="widget__content">
                    <div class="widget__body">
                        <div class="widget__total">
                            <div class="widget__title">Posts</div>
                            <div class="widget__number">{{ $postsCount }}</div>
                        </div>
                        <i class="fa fa-book widget__icon"></i>
                    </div>
                    <div class="widget__footer">
                        Since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="container__col-xl-3 container__col-12">
            <div class="widget">
                <div class="widget__content">
                    <div class="widget__body">
                        <div class="widget__total">
                            <div class="widget__title">Users</div>
                            <div class="widget__number">{{ $usersCount }}</div>
                        </div>
                        <i class="fa fa-users widget__icon"></i>
                    </div>
                    <div class="widget__footer">
                        Since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="container__col-xl-3 container__col-12">
            <div class="widget">
                <div class="widget__content">
                    <div class="widget__body">
                        <div class="widget__total">
                            <div class="widget__title">Categories</div>
                            <div class="widget__number">{{ $categoriesCount }}</div>
                        </div>
                        <i class="fa fa-archive widget__icon"></i>
                    </div>
                    <div class="widget__footer">
                        Since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="container__col-xl-3 container__col-12">
            <div class="widget">
                <div class="widget__content">
                    <div class="widget__body">
                        <div class="widget__total">
                            <div class="widget__title">Tags</div>
                            <div class="widget__number">{{ $tagsCount }}</div>
                        </div>
                        <i class="fa fa-tags widget__icon"></i>
                    </div>
                    <div class="widget__footer">
                        Since last month
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-2">
        <div class="container--fluid">
            <h1 class="heading-title">Hello, {{ Auth::user()->full_name }}!</h1>
            <p class="paragraph m-t-1">Share your insights and ideas to everyone around the world.</p>
            <p class="paragraph m-t-1">Create your new post today, click create new post.</p>
            <p class="m-t-2">
                <a class="btn btn--primary heading-secondary" href="{{ route('dashboard.posts.create') }}" role="button">Create new post</a>
            </p>
        </div>
    </div>
</div>
@endsection
