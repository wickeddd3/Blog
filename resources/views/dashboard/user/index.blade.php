@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5 style="display: inline-block;">Users</h5> <a href="{{ route('user.add') }}" class="btn btn-primary btn-sm">Add New</a>
    <p class="pt-2">
        <a href=""><b>All</b> ({{ $users->count() }})</a> | <a href="">Administrator (0)</a>
    </p>
</div>

<div class="container">
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
        <caption>{{ $users->count() }} {{ Str::plural('item', $users->count()) }}</caption>
        <thead class="thead-light">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center">
                    <i class="fa fa-book fa-fw"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    @if($user->role != 'administrator')
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                    @endif
                    {{ $user->username }}
                </td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <th scope="row">{{ $user->posts->count() }}</th>
            </tr>
            @empty
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
            @endforelse
        </tbody>
      </table>
      {{ $users->links() }}
</div>
@endsection
