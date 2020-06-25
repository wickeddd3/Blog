<div>
    <form method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" id="name">
          <small id="name" class="form-text text-muted">
              The name is how it appears on your site.
          </small>
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <input type="text" name="slug" class="form-control" id="slug">
          <small id="slug" class="form-text text-muted">
            The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
          </small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
            <small id="description" class="form-text text-muted">
                The description is not prominent by default; however, some themes may show it.
            </small>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Add New Category</button>
    </form>
</div>
