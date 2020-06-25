<nav class="sidebar sidebar-collapse animate-left" id="mySidebar"><br>
    <div class="sidebar-notification">
        <a href="#" class="sidebar-item"><i class="fa fa-envelope"></i></a>
        <a href="#" class="sidebar-item"><i class="fa fa-bell"></i></a>
        <a href="#" class="sidebar-item"><i class="fa fa-cog"></i></a>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="sidebar-item"><i class="fa fa-tachometer-alt fa-fw"></i>&nbsp; Dashboard</a>
        <a href="/dashboard/posts/all" class="sidebar-item"><i class="fa fa-book fa-fw"></i>&nbsp; Posts</a>
        <a href="{{ route('comments') }}" class="sidebar-item"><i class="fa fa-comments fa-fw"></i>&nbsp; Comments</a>
        <a href="{{ route('categories') }}" class="sidebar-item"><i class="fa fa-archive fa-fw"></i>&nbsp; Categories</a>
        <a href="{{ route('tags') }}" class="sidebar-item"><i class="fa fa-tags fa-fw"></i>&nbsp; Tags</a>
        <a href="{{ route('users') }}" class="sidebar-item"><i class="fa fa-users fa-fw"></i>&nbsp; Users</a>
        <a href="/profile/{{ Auth::user()->username }}" class="sidebar-item"><i class="fa fa-user-circle fa-fw"></i>&nbsp; Profile</a>
        <a href="{{ route('logout') }}" class="sidebar-item" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar1').submit();">
            <i class="fa fa-sign-out-alt fa-fw"></i>&nbsp; Log Out
        </a>
            <form id="logout-form-sidebar1" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </div>
</nav>
