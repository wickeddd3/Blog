@extends('layouts.app')

@section('content')
<search-post-view inline-template>
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-9 col-sm-12">
            <h3>Search Posts</h3>
            <search-result></search-result>
        </div>
    </div>
</div>
</search-post-view>
@endsection
