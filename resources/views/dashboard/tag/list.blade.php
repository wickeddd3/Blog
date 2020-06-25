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
        <caption>{{ $tags->count() }} {{ Str::plural('item', $tags->count()) }}</caption>
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
            @forelse($tags as $tag)
            <tr>
                <td>
                    <a href="{{ route('tag.edit', ['id' => $tag->id]) }}">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>
                    {{ $tag->name }}
                </td>
                <td>{{ $tag->description }}</td>
                <td>{{ $tag->slug }}</td>
                <th scope="row">{{ $tag->posts->count() }}</th>
                <td scope="row">
                    <a href="{{ route('tag.delete', ['id' => $tag->id]) }}">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No tags found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $tags->links() }}
    <small id="list" class="form-text text-muted">
        Deleting a category does not delete the posts in that category.
        Instead, posts that were only assigned to the deleted category are set to the default category Uncategorized.
        The default category cannot be deleted.
        Categories can be selectively converted to tags using the category to tag converter.
    </small>
</div>
