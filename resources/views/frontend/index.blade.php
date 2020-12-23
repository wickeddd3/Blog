@extends('layouts.app')

@section('content')
<frontend-view inline-template>
<div class="container__fluid home">
    <div class="container__row content">
        <div class="content__navigation m-b-1 container__col-xl-2 container__col-lg-2 container__col-md-3 container__col-sm-12 container__col-12">
            <div id="sidenav">
                @include('frontend.sidenav')
            </div>
        </div>
        <div class="content__main m-b-1 container__col-xl-7 container__col-lg-7 container__col-md-9 container__col-sm-12 container__col-12">
            @if(auth()->check())
            <a href="/@/{{ Auth::user()->username }}/post/create">
            <div class="write">
                <svg class="write__user">
                    <use xlink:href="icons/sprite.svg#icon-book"></use>
                </svg>
                <svg class="write__add">
                    <use xlink:href="icons/sprite.svg#icon-circle-with-plus"></use>
                </svg>
                <span class="write__text">Write a post. . .</span>
            </div>
            </a>
            @endif
            @include('frontend.tabs')
            @include('frontend.posts')
        </div>
        <div class="content__sidebar container__col-xl-3 container__col-lg-3 container__col-md-12 container__col-sm-12 container__col-12">
            <div id="sidesection">
                @include('frontend.sidesection')
            </div>
        </div>
    </div>
</div>
</frontend-view>
@endsection

@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var sidesection = document.getElementById("sidesection");
var sticky_sidesection = sidesection.offsetTop;

var sidenav = document.getElementById("sidenav");
var sticky_sidenav = sidenav.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky_sidesection) {
        sidesection.classList.add("sticky");
    } else {
        sidesection.classList.remove("sticky");
    }

    if (window.pageYOffset > sticky_sidenav) {
        sidenav.classList.add("sticky");
    } else {
        sidenav.classList.remove("sticky");
    }
}
</script>
@endsection
