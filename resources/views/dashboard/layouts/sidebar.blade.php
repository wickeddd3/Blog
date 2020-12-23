<div class="sidebar">
    <div class="sidebar__top">
        <div class="sidebar__title">
            <a class="sidebar__link" href="/">
                <span class="sidebar__name--title"><b>B</b> L O G</span>
            </a>
        </div>
        <div class="sidebar__list">
            <div class="sidebar__item">
                <a href="/admin/panel/dashboard" class="sidebar__link">
                    <i class="fa fa-tachometer-alt sidebar__icon"></i>
                    <span class="sidebar__name">Dashboard</span>
                </a>
            </div>
            <div class="sidebar__item">
                <a href="/admin/panel/posts" class="sidebar__link">
                    <i class="fa fa-book sidebar__icon"></i>
                    <span class="sidebar__name">Posts</span>
                </a>
            </div>
            <div class="sidebar__item">
                <a href="/admin/panel/categories" class="sidebar__link">
                    <i class="fa fa-archive sidebar__icon"></i>
                    <span class="sidebar__name">Categories</span>
                </a>
            </div>
            <div class="sidebar__item">
                <a href="/admin/panel/tags" class="sidebar__link">
                    <i class="fa fa-tags sidebar__icon"></i>
                    <span class="sidebar__name">Tags</span>
                </a>
            </div>
            <div class="sidebar__item">
                <a href="/admin/panel/users" class="sidebar__link">
                    <i class="fa fa-users sidebar__icon"></i>
                    <span class="sidebar__name">Users</span>
                </a>
            </div>
            <div class="sidebar__item">
                <a href="{{ route('logout') }}" class="sidebar__link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar1').submit();">
                    <i class="fa fa-sign-out-alt sidebar__icon"></i>
                    <span class="sidebar__name">Logout</span>
                </a>
                <form id="logout-form-sidebar1" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar__bottom">
        <div class="sidebar__authuser">
            <img src="{{ asset('/storage/'.Auth::user()->profile->avatar) }}"
                 alt="{{ asset('/storage/'.Auth::user()->profile->avatar) }}"
                 class="sidebar__authuser-img">
            <span class="sidebar__authuser-name">
                {{ Auth::user()->full_name }}
            </span>
        </div>
    </div>
</div>
