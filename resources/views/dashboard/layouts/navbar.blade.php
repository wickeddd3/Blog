<div class="navbar">
    <button class="navbar-item" onclick="openSidebar();">
        <span class="hamburger-menu"><i class="fa fa-bars"></i> &nbsp;</span>
        <span class="logo">
            <a href="/">
                B L O G
            </a>
        </span>
    </button>
    <div class="navbar-item dropdown">
        <button class="dropbtn">
            <img src="{{ asset('/storage/'.Auth::user()->profile->avatar) }}" class="avatar">
            {{ Auth::user()->full_name }}
        </button>
        <div class="dropdown-content">
            <a href="/profile/{{ Auth::user()->username }}">My Account</a>
            <a href="{{ route('profile') }}">Edit Account</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">Sign Out</a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
