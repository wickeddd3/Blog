
@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5>Edit Tag</h5>
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="{{ route('tag.update', ['id' => $tag->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $tag->name }}" class="form-control" id="name">
                <small id="name" class="form-text text-muted">
                    The name is how it appears on your site.
                </small>
                </div>
                <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ $tag->slug }}" class="form-control" id="slug">
                <small id="slug" class="form-text text-muted">
                    The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
                </small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $tag->description }}</textarea>
                    <small id="description" class="form-text text-muted">
                        The description is not prominent by default; however, some themes may show it.
                    </small>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Update Tag</button>
            </form>
        </div>
        <div class="col-md-5">

        </div>
    </div>
</div>
@endsection
