@extends('layouts.app')

@section('content')
<search-post-view inline-template>
<div class="container">
    <div class="search">
        <h3 class="search__title">Search Posts</h3>
        <search-result></search-result>
    </div>
</div>
</search-post-view>
@endsection
