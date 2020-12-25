<div class="profile__header" id="profile__header">
    <div class="profile__header-header">
        <img class="profile__header-img"
             src="{{ asset('/storage/'.$profile->avatar) }}"
             alt="{{ asset('/storage/'.$profile->avatar) }}">
    </div>
    <div class="profile__header-body">
        <h2 class="profile__name">{{ $profile->full_name }}</h2>
        @if(Auth::id() === $profile->id)
        <span class="profile__option">
            <a class="profile__link" href="/@/{{ $profile->username }}/profile/edit">
                <i class="fa fa-user-edit profile__icon"></i> Edit Profile
            </a>
            <a class="profile__link" href="{{ route('logout') }}" title="" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                <i class="fa fa-sign-out-alt profile__icon"></i> Sign Out
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </span>
        @endif
        @if(Auth::id() !== $profile->id)
            <follow-button :blogger="{{ json_encode($profile) }}"></follow-button>
        @endif
    </div>
    <div class="profile__header-footer">
        <p class="paragraph">{{ $profile->bio }}</p>
        <div class="profile__details">
            <div class="profile__details-item">
                Followers {{ $profile->followers->count() }}
            </div>
            <div class="profile__details-item">
                Following {{ $profile->following->count() }}
            </div>
            <div class="profile__details-item">
                Posts {{ $profile->posts->count() }}
            </div>
        </div>
    </div>
</div>
