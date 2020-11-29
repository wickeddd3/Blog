<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blog</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

        <script>
            window.App = {!! json_encode([
                //    'csrfToken' => csrf_token(),
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

    <body class="bg-white">
        <div id="app">
            @include('layouts.navbar')
            @yield('content')
            @include('layouts.footer')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
