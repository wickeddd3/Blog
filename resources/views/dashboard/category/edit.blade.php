
@extends('dashboard.layouts.app')

@section('content')
<div class="container__row m-t-2">
    <div class="container__col-xl-6 container__col-12">
        <div class="addcategory">
            <form method="POST" action="{{ route('dashboard.categories.update', ['category' => $category->id]) }}">
                @csrf
                @method('PUT')
                <div class="addcategory__item">
                    <span class="addcategory__label">Name</span>
                    <input type="text" class="addcategory__input @error('name') is-invalid @enderror"
                                name="name" value="{{ $category->name }}" id="name" autofocus>
                    @error('name')
                        <span class="addcategory__error" role="alert">{{ $message }}</span>
                    @enderror
                    <p class="heading-tertiary">
                        The name is how it appears on your site.
                    </p>
                </div>
                <div class="addcategory__item">
                    <span class="addcategory__label">Slug</span>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="addcategory__input" id="slug">
                    <p class="heading-tertiary">
                        The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
                    </p>
                </div>
                <div class="addcategory__item">
                    <span class="addcategory__label">Description</span>
                    <textarea name="description" id="description" cols="5" rows="5" class="addcategory__input">{{ $category->description }}</textarea>
                    <p class="heading-tertiary">
                        The description is not prominent by default; however, some themes may show it.
                    </p>
                </div>
                <button type="submit" class="btn btn--primary addcategory__btn">Update Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
