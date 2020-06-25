@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5 style="display: inline-block;">Posts</h5> <a href="{{ route('post.add') }}" class="btn btn-primary btn-sm">Add New</a>
    <p class="pt-2">
        <a href="/dashboard/posts/all"><b>All</b> ({{ App\Post::published()->count() }})</a>
        @if(App\Post::drafted()->count() > 0)
        | <a href="/dashboard/posts/drafted">Draft ({{ App\Post::drafted()->count() }})</a>
        @endif
        @if(App\Post::onlyTrashed()->count() > 0)
        | <a href="/dashboard/posts/trashed">Trash ({{ App\Post::onlyTrashed()->count() }})</a>
        @endif
    </p>
</div>

<div class="container-fluid">
    <div class="row justify-content-between mb-2">
        <div class="col-auto">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="fa fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group input-group-sm">
                <select class="custom-select">
                    <option selected>All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="fa fa-filter fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-sm table-bordered table-hover table-light">
        <caption>{{ $posts->count() }} {{ Str::plural('item', $posts->count()) }}</caption>
        <thead class="thead-light">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Categories</th>
                <th scope="col">Tags</th>
                <th scope="col" class="text-center">
                    <i class="fa fa-comments fa-fw"></i>
                </th>
                <th scope="col">Date</th>
                <th scope="col">
                    @if(request()->path() === 'dashboard/posts/drafted')
                        Publish
                    @elseif(request()->path() === 'dashboard/posts/trashed')
                        Restore | Delete
                    @else
                        Feature | Trash
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        @if(request()->path() !== 'dashboard/posts/trashed')
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        @endif
                        {{ Str::limit($post->title, 30, '...') }}
                    </td>
                    <td>{{ $post->author->first_name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                            {{ $tag->name }},
                        @endforeach
                    </td>
                    <th scope="row">{{ $post->comments->count() }}</th>
                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td>
                    <td>
                        @if(request()->path() === 'dashboard/posts/drafted')
                            <a href="{{ route('post.publish', ['id' => $post->id]) }}">
                                <i class="fa fa-window-maximize fa-fw"></i>
                            </a>
                        @elseif(request()->path() === 'dashboard/posts/trashed')
                            <a href="{{ route('post.restore', ['id' => $post->id]) }}">
                                <i class="fas fa-sync fa-fw"></i>
                            </a> |
                            <a href="{{ route('post.delete', ['id' => $post->id]) }}">
                                <i class="fas fa-trash fa-fw"></i>
                            </a>
                        @else
                            <a href="{{ route('post.feature', ['id' => $post->id]) }}">
                                @if($post->featured_at)
                                <i class="fas fa-star fa-fw"></i>
                                @else
                                <i class="far fa-star fa-fw"></i>
                                @endif
                            </a>
                            |
                            <a href="{{ route('post.trash', ['id' => $post->id]) }}">
                                <i class="fas fa-trash fa-fw"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
      </table>
      {{ $posts->links() }}
</div>
@endsection
