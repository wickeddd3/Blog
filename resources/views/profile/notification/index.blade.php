@extends('layouts.app')

@section('content')
<notifications-view inline-template>
<div class="container pt-4">
    <div class="row">
        <div class="col-md-9">
            <h3 class="pb-2 border-bottom">Notifications</h3>
            <notification></notification>
        </div>
    </div>
</div>
</notifications-view>
@endsection
