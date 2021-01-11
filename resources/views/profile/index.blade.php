@extends('layouts.app')

@section('title')
{{ $profile->first_name.' '.$profile->last_name }}
@endsection

@section('content')
<profile-view inline-template>
<div class="profile">
    <div class="container__row">
        <div class="profile__left container__col-xl-3 container__col-lg-4 container__col-md-12 container__col-sm-12 container__col-12">
            <div id="sidebar">
                @include('profile.header')
                @if(Auth::id() === $profile->id)
                    @include('profile.sidesection')
                @endif
            </div>
        </div>
        <div class="profile__right container__col-xl-9 container__col-lg-8 container__col-md-12 container__col-sm-12 container__col-12">
            <div class="profile__body">
                <div v-show="active_page == 'profilePosts'">@include('profile.profileposts')</div>
                <div v-show="active_page == 'myPosts'">@include('profile.myposts')</div>
            </div>
        </div>
    </div>
</div>
</profile-view>
@endsection


@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var profile_header = document.getElementById("sidebar");
var sticky_profile_header = profile_header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky_profile_header) {
        profile_header.classList.add("sticky");
    } else {
        profile_header.classList.remove("sticky");
    }
}
</script>
@endsection
