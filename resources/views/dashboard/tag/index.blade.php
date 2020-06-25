@extends('dashboard.layouts.app')

@section('content')
<h5 class="container-fluid">Tags</h5>
<div class="row container-fluid">
    <div class="col-md-4">
        @include('dashboard.tag.create')
    </div>
    <div class="col-md-8">
        @include('dashboard.tag.list')
    </div>
</div>
@endsection
