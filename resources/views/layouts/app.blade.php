<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('title')">
        <title>@yield('title')</title>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script>
            window.App = {!! json_encode([
                'user' => Auth::id(),
                'verified' => Auth::check() ? Auth::user()->email_verified_at : false,
                'signedIn' => Auth::check()
            ]) !!};
        </script>
        <style>
        .sticky {
            position: -webkit-sticky; /* Safari */
            position: sticky;
            top: 8px;
        }
        </style>
    </head>
    <body>
        <div id="app">
            @include('layouts.navbar')
            @yield('content')
            @include('layouts.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
