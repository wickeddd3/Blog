@extends('layouts.app')

@section('content')
<profile-view inline-template>
<!-- Main content -->
<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline" id="profile">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="profile-avatar">
                                <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('/storage/'.$profile->profile->avatar) }}"
                                        alt="User profile picture">
                            </div>
                            <h3 class="profile-username">{{ $profile->full_name }}</h3>
                            @if(Auth::id() === $profile->id)
                            <span class="option">
                                <a class="text-dark ml-3 mr-2" href="/profile/{{ $profile->username }}/@/edit">
                                    <i class="fa fa-user-edit fa-fw"></i> Edit Profile
                                </a>
                                <a class="text-dark mr-2" href="{{ route('logout') }}" title="" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                                    <i class="fa fa-sign-out-alt fa-fw"></i> Sign Out
                                </a>
                                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </span>
                            @endif
                        </div>
                        <p class="text-muted text-center">{{ $profile->profile->bio }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">{{ $profile->followers->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">{{ $profile->following->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Posts</b> <a class="float-right">{{ $profile->posts->count() }}</a>
                            </li>
                        </ul>

                        @if(Auth::id() !== $profile->id)
                            <follow-button :active="{{ json_encode($profile->isFollowedTo) }}"></follow-button>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#posts" data-toggle="tab">Posts</a></li>
                            @if(Auth::id() === $profile->id)
                            <li class="nav-item"><a class="nav-link" href="#bookmarks" data-toggle="tab">Bookmarks</a></li>
                            <li class="nav-item"><a class="nav-link" href="#likes" data-toggle="tab">Likes</a></li>
                            @endif
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="posts">
                                <posts></posts>
                            </div>
                            <!-- /.tab-pane -->
                            @if(Auth::id() === $profile->id)
                            <div class="tab-pane" id="bookmarks">
                                <bookmarked-posts></bookmarked-posts>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="likes">
                                <liked-posts></liked-posts>
                            </div>
                            <!-- /.tab-pane -->
                            @endif
                        </div>
                        <!-- /.tab-content -->

                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

</section>
<!-- /.content -->

</profile-view>
@endsection


@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("profile");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    } else {
    header.classList.remove("sticky");
    }
}
</script>
@endsection
