@extends('dashboard.layouts.app')

@section('content')
<h5 class="container-fluid">Categories</h5>
<div class="row container-fluid">
    <div class="col-md-4">
        @include('dashboard.category.create')
    </div>
    <div class="col-md-8">
        @include('dashboard.category.list')
    </div>
</div>
@endsection
