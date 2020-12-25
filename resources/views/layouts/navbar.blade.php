<navbar-view inline-template>
<div class="navbar">
    <div class="nav">
        <div class="nav-left">
            <div class="nav__item">
                <a class="nav__link" href="/">
                    <span class="nav__name--title"><b>B</b> L O G</span>
                </a>
            </div>
        </div>
        <div class="nav-right">
            @guest
                <div class="nav__item">
                    <a class="nav__link" href="{{ route('login') }}">
                        <span class="nav__name">Sign in</span>
                    </a>
                </div>
                <div class="nav__item">
                    <a class="nav__link" href="{{ route('register') }}">
                        <span class="nav__name">Sign up</span>
                    </a>
                </div>
            @else
                <div class="nav__item">
                    <a class="nav__link--rounded" href="/search">
                        <svg class="nav__icon">
                            <use xlink:href="{{ asset('icons/sprite.svg#icon-magnifying-glass') }}"></use>
                        </svg>
                    </a>
                </div>
                <div class="nav__item">
                    <a class="nav__link--rounded" href="/@/{{ Auth::user()->username }}/post/create">
                        <svg class="nav__icon">
                            <use xlink:href="{{ asset('icons/sprite.svg#icon-add-to-list') }}"></use>
                        </svg>
                    </a>
                </div>
                @if(Auth::user()->email_verified_at)
                    <div class="nav__item nav__item--menu">
                        <a class="nav__link--rounded">
                            <svg class="nav__icon">
                                <use xlink:href="{{ asset('icons/sprite.svg#icon-bell') }}"></use>
                            </svg>
                        </a>
                        <notification :auth_user="{{ json_encode(Auth::user()->username) }}"></notification>
                    </div>
                @endif
                <div class="nav__item">
                    <a class="nav__link--rounded" href="/@/{{ Auth::user()->username }}/profile">
                        <svg class="nav__icon">
                            <use xlink:href="{{ asset('icons/sprite.svg#icon-user') }}"></use>
                        </svg>
                    </a>
                </div>
                @if(Auth::user()->isAdmin)
                    <div class="nav__item">
                        <a class="nav__link--rounded" href="{{ route('dashboard.index') }}">
                            <svg class="nav__icon">
                                <use xlink:href="{{ asset('icons/sprite.svg#icon-gauge') }}"></use>
                            </svg>
                        </a>
                    </div>
                @endif
            @endguest
        </div>
    </div>
</div>
</navbar-view>
