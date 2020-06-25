<div>
    <div class="row justify-content-between mb-2">
        <div class="col-auto">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="fa fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">

        </div>
    </div>
    <table class="table table-sm table-bordered table-hover table-light">
        <caption>{{ $categories->count() }} {{ Str::plural('item', $categories->count()) }}</caption>
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Slug</th>
                <th scope="col" class="text-center">
                    <i class="fa fa-book fa-fw"></i>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>
                    @if($category->id != 1)
                    <a href="{{ route('category.edit', ['id' => $category->id]) }}">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>
                    @endif
                    {{ $category->name }}
                </td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->slug }}</td>
                <th scope="row">{{ $category->posts->count() }}</th>
                <td scope="row">
                    @if($category->id != 1)
                        <a href="{{ route('category.delete', ['id' => $category->id]) }}">
                            <i class="fa fa-trash fa-fw"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
      </table>
      {{ $categories->links() }}
      <small id="list" class="form-text text-muted">
        Deleting a category does not delete the posts in that category.
        Instead, posts that were only assigned to the deleted category are set to the default category Uncategorized.
        The default category cannot be deleted.
        Categories can be selectively converted to tags using the category to tag converter.
      </small>
</div>
