@extends('layouts.app')

@section('content')
<post-view initial-comments-count="{{ $post->comments_count }}"
           initial-likes-count="{{ $post->likes_count }}"
           created-at="{{ $post->created_at }}"
           inline-template>
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-8 col-sm-12">
            <div class="pb-4">
                <div>
                    <h2 style="display: inline;">{{ $post->title }}</h2>
                    @if($post->updated_at)<span>(Edited)</span>@endif
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
                                    <span class="pr-2">
                                        <span class="badge badge-primary" v-text="commentsCount"></span>
                                        <i class="fa fa-comments fa-fw"></i>
                                    </span>

                                    <span class="pr-2">
                                        <span class="badge badge-primary" v-text="likesCount"></span>
                                        <i class="fa fa-thumbs-up fa-fw"></i>
                                    </span>

                                    @if(auth()->id() === $post->user_id)
                                    <span class="pl-2 pr-1">
                                        <a class="text-dark" href="/posts/{{ $post->category->slug }}/{{ $post->slug }}/edit">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </a>
                                    </span>
                                    @endif

                                    @if(auth()->check())
                                    <like-button @liked="likesCount++"
                                                 @unliked="likesCount--"
                                                 :active="{{ json_encode($post->isLiked) }}">
                                    </like-button>

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
                <div class="pt-2">
                    <i class="fa fa-tags fa-fw"></i>
                    @foreach($post->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="pb-2">
                <p name="content">
                    {!! $post->content !!}
                </p>
            </div>

            <div class="pb-4">
                <h5>
                    Comments
                </h5>

                <comments @added="commentsCount++" @removed="commentsCount--"></comments>
            </div>

        </div>
    </div>
</div>
</post-view>
@endsection
