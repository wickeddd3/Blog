<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white shadow-sm">
    <h5 class="my-0 mr-md-auto pb-1 font-weight-normal">
        <a class="text-dark" href="/">
            B L O G
        </a>
    </h5>
    <span>
        @guest
            <a class="font-weight-light text-dark mr-4" href="{{ route('login') }}">Sign in</a>
            <a class="font-weight-light text-dark" href="{{ route('register') }}">Sign up</a>
        @else
            <a class="mr-3 text-dark" href="/search">
                <i class="fa fa-search fa-lg"></i>
            </a>
            <a class="mr-3 text-dark" href="/profile/{{ Auth::user()->username }}/post/create">
                <i class="far fa-plus-square fa-lg"></i>
            </a>
            <a class="mr-3 text-dark" href="/profile/{{ Auth::user()->username }}/all/notifications">
                <i class="far fa-bell fa-lg"></i>
            </a>
            <a class="mr-3 text-dark" href="/profile/{{ Auth::user()->username }}">
                <i class="far fa-user-circle fa-lg"></i>
            </a>
            @if(Auth::user()->isAdmin)
            <a class="text-dark" href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer-alt fa-lg"></i>
            </a>
            @endif
        @endguest
    </span>
</div>
