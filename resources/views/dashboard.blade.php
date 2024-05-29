@extends('layouts.app')

@section('content')
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">

@include('layouts.navbar')


<div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
  <!-- Total Clients -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-primary"><i class="fas fa-users"></i> Total Clients</h5>
        <p class="card-text">{{$totalClients}}</p>
      </div>
    </div>
  </div>

  <!-- Total Amount -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-danger"><i class="fas fa-dollar-sign"></i> Total Amount</h5>
        <p class="card-text">M{{$totalAmount}}</p>
      </div>
    </div>
  </div>

  <!-- Total Paid -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-success"><i class="fas fa-hand-holding-usd"></i> Total Paid</h5>
        <p class="card-text">M{{$totalPaid}}</p>
      </div>
    </div>
  </div>

  <!-- Total Due -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-warning"><i class="fas fa-money-bill-wave"></i> Total Due</h5>
        <p class="card-text">{{$totalDue}}</p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Total Products -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-info"><i class="fas fa-box"></i> Total Products</h5>
        <p class="card-text">{{$totalProducts}}</p>
      </div>
    </div>
  </div>

  <!-- Total Invoices -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-secondary"><i class="fas fa-file-invoice-dollar"></i> Total Invoices</h5>
        <p class="card-text">{{$totalInvoices}}</p>
      </div>
    </div>
  </div>

  <!-- Total Paid Invoices -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-dark"><i class="fas fa-file-invoice"></i> Total Paid Invoices</h5>
        <p class="card-text">{{$totalPaidInvoices}}</p>
      </div>
    </div>
  </div>

  <!-- Total Quotes -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-muted"><i class="fas fa-quote-left"></i> Total Quotes</h5>
        <p class="card-text">{{$totalQuotes}}</p>
      </div>
    </div>
  </div>
</div>


<div class="row">
<div class="col-lg-12">
  <!-- Income Overview Chart -->
  <div class="card">
    <div class="card-body">
   

      <h5 class="card-title">Income Overview</h5>
      <div class="input-group mb-3">
      <span class="input-group-text" id="date-range-label">Date Range</span>
                                <select id="preset-date-range" class="form-select">
                                    <option value="today">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="last_week">Last Week</option>
                                    <option value="this_month">This Month</option>
                                    <option value="last_month">Last Month</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                                <input type="text" id="custom-date-range" class="form-control d-none" placeholder="Select custom date range">
      </div>
      <canvas id="income-chart"></canvas>
    </div>
  </div>
</div>
</div>

<div class="row">
<div class="col-lg-6">
  <!-- Payment Overview Chart -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Payment Overview</h5>
      <canvas id="payment-chart"></canvas>
    </div>
  </div>
</div>

<div class="col-lg-6">
  <!-- Invoice Overview Chart -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Invoice Overview</h5>
      <canvas id="invoice-chart"></canvas>
    </div>
  </div>
</div>
</div>

   



    
  </div>

  @endsection

  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Date Range Picker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Date Range Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script src="https://kit.fontawesome.com/47f464844e.js" crossorigin="anonymous"></script>

  <!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include flatpickr date picker library -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Include Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Include the JavaScript code -->
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const paymentsData = {!! json_encode($payments) !!};

    const presetDateRanges = {
    today: [new Date(), new Date()],
    this_week: [new Date(new Date().setDate(new Date().getDate() - 6)), new Date()],
    last_week: [
        new Date(new Date().setDate(new Date().getDate() - 13)),
        new Date(new Date().setDate(new Date().getDate() - 7))
    ],
    this_month: [new Date(new Date().getFullYear(), new Date().getMonth(), 1), new Date()],
    last_month: [
        new Date(new Date().setDate(new Date().getDate() - 30)),
        new Date(new Date().setDate(new Date().getDate() - 1))
    ]
};


    // Initialize custom date range picker
    const customDateRangePicker = flatpickr('#custom-date-range', {
        mode: 'range',
        dateFormat: 'Y-m-d',
        onClose: function(selectedDates) {
            if (selectedDates.length === 2) {
                renderIncomeChart(selectedDates[0], selectedDates[1]);
            }
        }
    });

    // Handle preset date range selection
    $('#preset-date-range').on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === 'custom') {
            $('#custom-date-range').removeClass('d-none');
        } else {
            $('#custom-date-range').addClass('d-none');
            const [startDate, endDate] = presetDateRanges[selectedValue];
            renderIncomeChart(startDate, endDate);
        }
    });

    // Initial render of chart with payments data for the current month
    const currentDate = new Date();
    const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    renderIncomeChart(firstDayOfMonth, lastDayOfMonth);

    function renderIncomeChart(startDate, endDate) {
        const datesForMonth = [];
        const chartData = [];

        for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
            const dateString = d.toISOString().split('T')[0];
            datesForMonth.push(dateString);

            // Find the payment for the current date
            const payment = paymentsData.find(entry => {
                const paymentDate = new Date(entry.payment_date);
                return paymentDate.toISOString().split('T')[0] === dateString;
            });

            chartData.push(payment ? payment.amount : 0);
        }

        // Render the chart
        const incomeChartCtx = document.getElementById('income-chart').getContext('2d');
        if (window.incomeChart) {
            window.incomeChart.destroy();
        }
        window.incomeChart = new Chart(incomeChartCtx, {
            type: 'line',
            data: {
                labels: datesForMonth,
                datasets: [{
                    label: 'Amount Paid',
                    data: chartData,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount Paid'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }
});

</script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Payment Overview Chart
            var paymentChartCtx = document.getElementById('payment-chart').getContext('2d');
            var paymentChart = new Chart(paymentChartCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Paid', 'Due'],
                    datasets: [{
                        label: 'Payment Overview',
                        data: [{{ $totalPaid }}, {{ $totalDue }}],
                        backgroundColor: ['rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
                    }]
                }
            });

            // Invoice Overview Chart
            var invoiceChartCtx = document.getElementById('invoice-chart').getContext('2d');
            var invoiceChart = new Chart(invoiceChartCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Paid', 'Unpaid'],
                    datasets: [{
                        label: 'Invoice Overview',
                        data: [{{ $totalPaidInvoices }}, {{ $totalInvoices - $totalPaidInvoices }}],
                        backgroundColor: ['rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
                    }]
                }
            });
        });
    </script>
