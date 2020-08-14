
@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid pb-4">

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Edit Category</h6>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $category->name }}" id="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <small id="name" class="form-text text-muted">
                                The name is how it appears on your site.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" id="slug">
                            <small id="slug" class="form-text text-muted">
                                The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $category->description }}</textarea>
                            <small id="description" class="form-text text-muted">
                                The description is not prominent by default; however, some themes may show it.
                            </small>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Update Category</button>
                    </form>
                </div>
                <div class="col-md-5">

                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
@endsection
