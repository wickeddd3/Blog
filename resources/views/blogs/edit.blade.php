@extends('layouts.app')

@section('content')
<div class="container">
    <div class="addpost">
        <h1 class="addpost__title">Edit Post</h1>
        <form method="POST"
              action="/posts/{{ $post->category->slug }}/{{ $post->slug }}/update"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="addpost__item">
                <span class="addpost__label">Title</span>
                <input type="text" name="title" value="{{ $post->title }}"
                        class="addpost__input @error('title') is-invalid @enderror" id="title">
                @error('title')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <span class="addpost__label">Content</span>
                <textarea name="content" id="content" cols="5" rows="5"
                            class="addpost__textarea @error('content') is-invalid @enderror">{{ $post->content }}</textarea>
                @error('content')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <img src="{{ asset('/storage/'.$post->featured) }}"
                     alt="{{ asset('/storage/'.$post->featured) }}"
                     style="height:450px;object-fit:cover;">
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Featured Image</label>
                <input type="file" class="addpost__input" name="featured" id="featured">
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Category</label>
                <select name="category" id="category" class="addpost__input @error('category') is-invalid @enderror">
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
                @error('category')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Tags</label>
                <select name="tags[]" id="tags"
                        class="addpost__input tags-selector @error('tags') is-invalid @enderror" multiple>
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
                @error('tags')
                    <span class="addpost__error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn--primary addpost__btn">Update Post</button>
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
