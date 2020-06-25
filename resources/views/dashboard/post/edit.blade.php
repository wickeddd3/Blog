@extends('dashboard.layouts.app')

@section('content')
<div class="container pb-4">
    <h5>Edit Post</h5>
    <form method="POST" action="{{ route('post.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
        </div>
        <div class="form-group text-center">
            <img src="{{ asset('/storage/'.$post->featured) }}" alt="" class="img-fluid" style="height:450px;object-fit:cover;">
        </div>
        <div class="row">
            <div class="col form-group">
                <label for="featured">Featured Image</label>
                <input type="file" class="form-control" name="featured" id="featured">
            </div>
            <div class="col form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if($category->id === $post->category->id)
                                selected
                            @endif
                            >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                            @if($post->hasTag($tag->id))
                                selected
                            @endif
                            >
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Update Post</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    CKEDITOR.replace( 'content' );

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection
