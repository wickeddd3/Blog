@extends('layouts.app')

@section('content')
<post-view initial-comments-count="{{ $post->comments_count }}"
           initial-likes-count="{{ $post->likes_count }}"
           initial-views-count="{{ $post->views_count }}"
           created-at="{{ $post->created_at }}"
           inline-template>

    <div class="container">
        <div class="container__row">
            <div class="container__col-xl-10">

                <div class="post">
                    <div class="post__author">
                        <img src="{{ asset('/storage/'.$post->author->profile->avatar) }}"
                            alt="{{ asset('/storage/'.$post->author->profile->avatar) }}"
                            class="post__avatar">
                        <div class="post__author-details">
                            <div class="post__author-name">
                                <a class="heading-secondary" href="/profile/{{ $post->author->username }}">
                                    {{ $post->author->full_name }}
                                </a>
                                <span class="media__author--date" v-text="published"></span>
                            </div>
                            @if(auth()->check() && isset(auth()->user()->email_verified_at))
                                <bookmark-button :post="{{ json_encode($post) }}"></bookmark-button>
                            @endif
                        </div>
                    </div>
                    <div class="post__featured">
                        <img src="{{ asset('/storage/'.$post->featured) }}"
                            alt="{{ asset('/storage/'.$post->featured) }}"
                            class="post__img">
                    </div>
                    <div class="post__title">
                        <h2 class="heading-title--large">{{ $post->title }}</h2>
                        @if($post->updated_at)
                            <span>(Edited)</span>
                        @endif
                        @if(auth()->id() === $post->user_id && isset(auth()->user()->email_verified_at))
                            <a class="text-dark" href="/posts/{{ $post->category->slug }}/{{ $post->slug }}/edit">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>
                        @endif
                    </div>
                    <div class="post__header">
                        <div class="post__details">
                            <div class="post__details-item">
                                <i class="far fa-comments fa-fw"></i>
                                <span class="badge badge-primary" v-text="commentsCount"></span>
                                Comments
                            </div>
                            <div class="post__details-item">
                                <i class="far fa-eye fa-fw"></i>
                                <span class="badge badge-primary" v-text="viewsCount"></span>
                                Views
                            </div>
                            <div class="post__details-item">
                                <i class="far fa-thumbs-up fa-fw"></i>
                                <span class="badge badge-primary" v-text="likesCount"></span>
                                Likes
                            </div>
                            @if(auth()->check() && isset(auth()->user()->email_verified_at))
                                <like-button @liked="likesCount++"
                                            @unliked="likesCount--"
                                            :active="{{ json_encode($post->isLiked) }}">
                                </like-button>
                            @endif

                        </div>
                        <div class="post__tags">
                            <i class="fa fa-tags fa-fw"></i>
                            @foreach($post->tags as $tag)
                                <span class="post__tags-item">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="post__body">
                        <div class="post__content">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="post__footer">
                        <h2 class="post__footer-title m-b-2">Comments</h2>
                        <comments @added="commentsCount++" @removed="commentsCount--"></comments>
                    </div>
                </div>
                {{-- <div class="pb-4">
                    <div>
                        <h2>{{ $post->title }}</h2>
                        @if($post->updated_at)
                            <span>(Edited)</span>
                        @endif
                        @if(auth()->id() === $post->user_id && isset(auth()->user()->email_verified_at))
                            <a class="text-dark" href="/posts/{{ $post->category->slug }}/{{ $post->slug }}/edit">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>
                        @endif
                        <div class="media pb-2 pt-2">
                            <img src="{{ asset('/storage/'.$post->author->profile->avatar) }}" class="mr-3 rounded-circle img-fluid" alt="..." style="width:50px;height:50px;object-fit:cover;">
                            <div class="media-body">
                                <h6 class="mt-0">
                                    <a class="author" href="/profile/{{ $post->author->username }}">
                                        {{ $post->author->full_name }}
                                    </a>
                                </h6>
                                <p>
                                    <span v-text="published"></span>
                                    <span class="float-right">
                                        @if(auth()->check() && isset(auth()->user()->email_verified_at))
                                            <bookmark-button :post="{{ json_encode($post) }}"></bookmark-button>
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('/storage/'.$post->featured) }}" alt="" class="img-fluid" style="width:auto;height:auto;object-fit:cover;">
                    </div>
                    <div class="pt-3">
                        <span class="mr-1">
                            <i class="far fa-comments fa-fw"></i> comments
                            <span class="badge badge-primary" v-text="commentsCount"></span>
                        </span> ·
                        <span class="mr-1 ml-1">
                            <i class="far fa-eye fa-fw"></i> views
                            <span class="badge badge-primary" v-text="viewsCount"></span>
                        </span> ·
                        <span class="mr-1 ml-1">
                            <i class="far fa-thumbs-up fa-fw"></i> likes
                            <span class="badge badge-primary" v-text="likesCount"></span>
                        </span>
                        @if(auth()->check() && isset(auth()->user()->email_verified_at))
                            ·
                            <like-button @liked="likesCount++"
                                        @unliked="likesCount--"
                                        :active="{{ json_encode($post->isLiked) }}">
                            </like-button>
                        @endif
                    </div>
                    <div class="pt-2">
                        <i class="fa fa-tags fa-fw"></i>
                        @foreach($post->tags as $tag)
                            <span class="badge badge-info text-white">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div> --}}

                {{-- <div class="pb-2">
                    <p name="content">
                        {!! $post->content !!}
                    </p>
                </div>

                <div class="pb-4">
                    <h5>Comments</h5>
                    <comments @added="commentsCount++" @removed="commentsCount--"></comments>
                </div> --}}

            </div>
        </div>
    </div>

</post-view>
@endsection
