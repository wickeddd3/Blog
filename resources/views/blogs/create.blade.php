@extends('layouts.app')

@section('content')
<div class="container pt-4">
    <h5>Add New Post</h5>
    <form method="POST" action="/posts" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
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
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Add New Post</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    CKEDITOR.replace('content');

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection
