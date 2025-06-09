<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Inter:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
        
        @stack('styles')
    </head>
    
<body>
    <div id="app">
        <main class="py-4">
            
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/47f464844e.js" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @yield('scripts')

    @stack('scripts')
</body>
</html>
