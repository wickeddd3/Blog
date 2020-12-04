
@extends('dashboard.layouts.app')

@section('content')
<div class="container__row m-t-2">
    <div class="container__col-xl-6 container__col-12">
        <div class="addtag">
            <form method="POST" action="{{ route('dashboard.tags.update', ['tag' => $tag->id]) }}">
                @csrf
                @method('PUT')
                <div class="addtag__item">
                    <span class="addtag__label">Name</span>
                    <input type="text" class="addtag__input @error('name') is-invalid @enderror"
                                name="name" value="{{ $tag->name }}" id="name" autofocus>
                    @error('name')
                        <span class="addtag__error" role="alert">{{ $message }}</span>
                    @enderror
                    <p class="heading-tertiary">
                        The name is how it appears on your site.
                    </p>
                </div>
                <div class="addtag__item">
                    <span class="addtag__label">Slug</span>
                    <input type="text" name="slug" value="{{ $tag->slug }}" class="addtag__input" id="slug">
                    <p class="heading-tertiary">
                        The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
                    </p>
                </div>
                <div class="addtag__item">
                    <span class="addtag__label">Description</span>
                    <textarea name="description" id="description" cols="5" rows="5" class="addtag__input">{{ $tag->description }}</textarea>
                    <p class="heading-tertiary">
                        The description is not prominent by default; however, some themes may show it.
                    </p>
                </div>
                <button type="submit" class="btn btn--primary addtag__btn">Update Tag</button>
            </form>
        </div>
    </div>
</div>
@endsection
