<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Invoicify - Quote and Invoice Management App">
    <meta name="author" content="Invoicify">
    <meta name="keywords" content="invoicify, quotes, invoices, billing, admin, dashboard, responsive">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <title>@yield('title', 'Invoicify - Dashboard')</title>

    <!-- Main CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Page-specific styles -->
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.navbar')

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/47f464844e.js" crossorigin="anonymous"></script>

    <!-- Charts & Visualization -->
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <!-- Dashboard example scripts -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <!-- Page-specific scripts -->
    @yield('scripts')
    @stack('scripts')

    <script>
        // Example: Initialize a chart if the canvas exists
        document.addEventListener("DOMContentLoaded", function() {
            const chartEl = document.getElementById('myChart');
            if (chartEl) {
                const ctx = chartEl.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                        datasets: [{
                            label: 'Invoices',
                            data: [10, 20, 15, 25, 30],
                            backgroundColor: 'rgba(210, 20, 20, 0.7)'
                        }]
                    },
                    options: { responsive: true }
                });
            }
        });
    </script>
</body>
</html>
