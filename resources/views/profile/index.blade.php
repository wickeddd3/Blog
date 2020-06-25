@extends('layouts.app')

@section('content')
<profile-view inline-template>
<div class="container pt-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0 mb-1" style="display: inline-block;">{{ $profile->full_name }}</h5>

                    @if(Auth::id() === $profile->id)
                    <a class="text-dark ml-3 mr-2" href="/profile/{{ $profile->username }}/@/edit">
                        <i class="fa fa-user-edit fa-fw"></i>
                    </a>
                    <a class="text-dark mr-2" href="{{ route('logout') }}" title="" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fa fa-sign-out-alt fa-fw"></i>
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endif

                    @if(Auth::id() !== $profile->id)
                    <follow-button :active="{{ json_encode($profile->isFollowedTo) }}"></follow-button>
                    @endif

                    <p>
                        <span class="pr-2">
                            <a class="text-dark" href="/profile/{{ $profile->username }}/posts">
                                {{ $profile->posts->count() }} {{ Str::plural('Post', $profile->posts->count()) }}
                            </a>
                        </span>
                        @if(Auth::id() === $profile->id)
                        <span class="pr-2">
                            <a class="text-dark" href="/profile/{{ $profile->username }}/bookmarks">
                                {{ $profile->bookmarks->count() }} {{ Str::plural('Bookmarked Post', $profile->bookmarks->count()) }}
                            </a>
                        </span>
                        <span class="pr-2">
                            <a class="text-dark" href="/profile/{{ $profile->username }}/likes">
                                {{ $profile->likes->count() }} {{ Str::plural('Liked Post', $profile->likes->count()) }}
                            </a>
                        </span>
                        @endif
                    </p>
                    <p>
                        <span class="pr-2">{{ $profile->followers->count() }} {{ Str::plural('Follower', $profile->followers->count()) }}</span>
                        <span class="pr-2">{{ $profile->following->count() }} {{ Str::plural('Following', $profile->following->count()) }}</span>
                    </p>
                    <p class="pt-4">
                        {{ $profile->profile->bio }}
                    </p>
                </div>
                <img src="{{ asset('/storage/'.$profile->profile->avatar) }}" class="ml-3 rounded-circle img-fluid" style="width:120px;height:110px;object-fit:cover;" alt="">
            </div>
        </div>
    </div>
</div>
</profile-view>
@endsection
