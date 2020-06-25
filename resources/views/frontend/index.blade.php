@extends('layouts.app')

@section('content')
<frontend-view inline-template>
<div>

<!-- CATEGORIES -->
<categories :categories="{{ json_encode($categories) }}"></categories>

<!-- END CATEGORIES -->

<!-- MAIN CONTENT -->
<div class="container-fluid px-5">

    <!-- FEATURED -->
    <div class="row mb-4">

        <div class="col-md-5 pt-2">
            @if($featuredOne)
            <div class="card border-light pb-2">
                <img src="{{ asset('/storage/'.$featuredOne->featured) }}" class="card-img-top img-fluid" style="height:150px;object-fit:cover;" alt="...">
                <div class="card-body">
                    <h4>
                        <a class="text-dark" href="{{ $featuredOne->path() }}">
                            {{ $featuredOne->title }}
                        </a>
                    </h4>
                    <p class="font-weight-light text-secondary">
                        {!! Str::limit($featuredOne->content, 135, '...') !!}
                    </p>
                    <p style="margin:0;padding:0;">
                        <a class="text-dark" href="/profile/{{ $featuredOne->author->username }}">
                            {{ $featuredOne->author->full_name }}
                        </a>
                    </p>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($featuredOne->created_at)->format('M d') }}</span>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            @if($editorsChoice)
            @foreach($editorsChoice as $post)
            <div class="media pb-2 pt-2">
                <img src="{{ asset('/storage/'.$post->featured) }}" class="mr-3" style="width:120px;height:100px;object-fit:cover;" alt="...">
                <div class="media-body">
                    <h6 class="mt-0">
                        <a class="text-dark" href="{{ $post->path() }}">
                            {{ $post->title }}
                        </a>
                    </h6>
                    <p style="margin:0;padding:0;">
                        <a class="text-dark" href="/profile/{{ $post->author->username }}">
                            {{ $post->author->full_name }}
                        </a>
                    </p>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($post->created_at)->format('M d') }}</span>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <div class="col-md-3 pt-2">
            @if($featuredTwo)
            <div class="card border-light mb-3">
                <img src="{{ asset('/storage/'.$featuredTwo->featured) }}" class="card-img-top img-fluid" style="height:150px;object-fit:cover;" alt="...">
                <div class="card-body">
                    <h5>
                        <a class="text-dark" href="{{ $featuredTwo->path() }}">
                            {{ $featuredTwo->title }}
                        </a>
                    </h5>
                    <p class="font-weight-light text-secondary">
                        {!! Str::limit($featuredTwo->content, 50, '...') !!}
                    </p>
                    <p style="margin:0;padding:0;">
                        <a class="text-dark" href="/profile/{{ $featuredTwo->author->username }}">
                            {{ $featuredTwo->author->full_name }}
                        </a>
                    </p>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($featuredTwo->created_at)->format('M d') }}</span>
                </div>
            </div>
            @endif
            <a class="text-dark" href="/posts/featured">EDITOR'S PICKS <i class="fa fa-chevron-right fa-fw"></i> </a>
        </div>

    </div>
    <hr>
    <!-- END FEATURED -->

    <!-- SECTION -->
    <div class="row pt-4">

        <!-- MAIN SECTION -->
        <div class="offset-md-1 col-md-7">
            <h5 class="pb-2">
                <a class="text-dark" href="/posts/latest">LATEST</a>
            </h5>
            <main>
                <posts></posts>
            </main>
        </div>
        <!-- END MAIN SECTION -->

        <!-- SIDEBAR SECTION -->
        <div class="col-md-3">
            <aside id="popular">

                <h5 class="pb-2">
                    <a class="text-dark" href="/posts/popular">POPULAR</a>
                </h5>
                @forelse($popular as $post)
                <div class="media pb-2 pt-2">
                    <img src="{{ asset('/storage/'.$post->featured) }}" style="width:75px;height:65px;object-fit:cover;" class="align-self-start mr-3" alt="...">
                    <div class="media-body">
                        <h6 class="mt-0" style="margin:0;padding:0;">
                            <a class="text-dark" href="{{ $post->path() }}">
                                {{ $post->title }}
                            </a>
                        </h6>
                        <p style="margin:0;padding:0;">
                            <a class="text-dark" href="/profile/{{ $post->author->username }}">
                                {{ $post->author->full_name }}
                            </a>
                        </p>
                        <span class="text-muted">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('M d') }}
                        </span>
                    </div>
                </div>
                @empty
                <span class="text-center">No posts found</span>
                @endforelse

                <h5 class="border-bottom pb-2 pt-3">
                    <span>ARCHIVES</span>
                </h5>
                <div class="pb-4">
                    <ol class="list-unstyled mb-0">
                        @forelse($archives as $key => $value)
                            <li><a class="text-dark" href="/">{{ $key }}</a></li>
                        @empty
                            <li>No archives found</li>
                        @endif
                    </ol>
                </div>

            </aside>
        </div>
        <!-- END SIDEBAR SECTION -->

    </div>
    <!-- END SECTION -->

</div>
<!-- END MAIN CONTENT -->

</div>
</frontend-view>
@endsection

@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("popular");
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
