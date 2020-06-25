@extends('layouts.app')

@section('content')
<user-posts-view inline-template>
<div class="container pt-4">
    <div class="row">
        <div class="col-md-9">
            <h3 class="pb-2 border-bottom">{{ $header }}</h3>
            <posts></posts>
        </div>
    </div>
</div>
</user-posts-view>
@endsection
