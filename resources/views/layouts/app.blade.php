<!Doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet">

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
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Roboto Slab', serif;
        font-weight: 600;
    }

    p, span, a {
        font-family: 'Open Sans', sans-serif;
    }

    i {
        cursor: pointer;
    }

    a:link {
        text-decoration: none;
    }

    html {
        font-size: 14px;
    }

    @media (min-width: 768px) {
        html {
            font-size: 16px;
        }
    }

    .sticky {
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
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
