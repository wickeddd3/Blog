@extends('layouts.app')

@section('content')
<post-view initial-comments-count="{{ $post->comments_count }}"
           initial-likes-count="{{ $post->likes_count }}"
           initial-views-count="{{ $post->views_count }}"
           created-at="{{ $post->created_at }}"
           inline-template>

    <div class="container">
        <div class="container__row center">
            <div class="container__col-xl-10 container__col-12">
                <div class="post">
                    <div class="post__author">
                        <img src="{{ asset('/storage/'.$post->author->profile->avatar) }}"
                            alt="{{ asset('/storage/'.$post->author->profile->avatar) }}"
                            class="post__avatar">
                        <div class="post__author-details">
                            <div class="post__author-name">
                                <a class="heading-secondary" href="/@/{{ $post->author->username }}/profile">
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
                        <span class="heading-title--large">{{ $post->title }}</span>
                        @if($post->updated_at)
                            <span class="heading-tertiary m-l-1">(Edited)</span>
                        @endif
                        @if(auth()->id() === $post->user_id && isset(auth()->user()->email_verified_at))
                            <span>
                                <a class="post__title-option"
                                    href="/{{ $post->category->slug }}/{{ $post->slug }}/edit">
                                    <i class="fa fa-edit post__title-icon"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                    <div class="post__header">
                        <div class="post__tags">
                            <i class="fa fa-tags fa-fw m-r-1"></i>
                            @foreach($post->tags as $tag)
                                <span class="post__tags-item">{{ $tag->name }}</span>
                            @endforeach
                        </div>
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
                    </div>
                    <div class="post__body">
                        <div class="post__content">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="post__footer">
                        <h2 class="post__footer-title m-b-2">
                            <i class="far fa-comments fa-fw"></i> Comments
                        </h2>
                        <comments @added="commentsCount++" @removed="commentsCount--"></comments>
                    </div>
                </div>
            </div>
        </div>
    </div>
</post-view>
@endsection
