@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="container__row m-t-2">
        <div class="container__col-xl-7">
            @include('dashboard.category.list')
        </div>
        <div class="container__col-xl-5">
            @include('dashboard.category.create')
        </div>
    </div>
</div>
@endsection
