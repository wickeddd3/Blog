@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="addpost">
        <h1 class="addpost__title">Add New Post</h1>
        <form method="POST" action="/posts" enctype="multipart/form-data">
            @csrf
            <div class="addpost__item">
                <span class="addpost__label">Title</span>
                <input type="text" class="addpost__input @error('title') is-invalid @enderror"
                        name="title" value="{{ old('title') }}" id="title" autofocus>
                @error('title')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Content</label>
                <textarea name="content" id="content" cols="5" rows="5"
                            class="addpost__textarea @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Featured Image</label>
                <input type="file" class="addpost__input @error('featured') is-invalid @enderror"
                        name="featured" id="featured">
                @error('featured')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Category</label>
                <select name="category" id="category" class="addpost__select @error('category') is-invalid @enderror">
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Tags</label>
                <select name="tags[]" id="tags"
                        class="addpost__input tags-selector @error('tags') is-invalid @enderror" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn--primary addpost__btn">Publish</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        CKEDITOR.replace('content');

        $(document).ready(function () {
            $('.tags-selector').select2();
        });
    </script>
@endsection
