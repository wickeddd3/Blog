<div class="addtag">
    <form method="POST" action="{{ route('tag.store') }}">
        @csrf
        <div class="addtag__item">
            <span class="addtag__label">Name</span>
            <input type="text" class="addtag__input @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" id="name" autofocus>
            @error('name')
                <span class="addtag__error" role="alert">{{ $message }}</span>
            @enderror
            <p class="heading-tertiary">
                The name is how it appears on your site.
            </p>
        </div>
        <div class="addtag__item">
            <span class="addtag__label">Slug</span>
            <input type="text" name="slug" class="addtag__input" id="slug">
            <p class="heading-tertiary">
                The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
            </p>
        </div>
        <div class="addtag__item">
            <span class="addtag__label">Description</span>
            <textarea name="description" id="description" cols="5" rows="5" class="addtag__input"></textarea>
            <p class="heading-tertiary">
                The description is not prominent by default; however, some themes may show it.
            </p>
        </div>
        <button type="submit" class="btn btn--primary addtag__btn">Add New Tag</button>
    </form>
</div>
