<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Blog') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    </head>
    <body>

    <div id="app">

        <!-- NAVBAR -->
        @include('dashboard.layouts.navbar')

        <!-- SIDEBAR -->
        @include('dashboard.layouts.sidebar');

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="overlay animate-opacity" onclick="closeSidebar();" title="close side menu" id="myOverlay"></div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function openSidebar() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
        }

        // Close the sidebar with the close button
        function closeSidebar() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
        }
    </script>

    </body>
</html>
