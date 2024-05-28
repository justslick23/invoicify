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
        <p class="card-text">100</p>
      </div>
    </div>
  </div>

  <!-- Total Amount -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-danger"><i class="fas fa-dollar-sign"></i> Total Amount</h5>
        <p class="card-text">$10,000</p>
      </div>
    </div>
  </div>

  <!-- Total Paid -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-success"><i class="fas fa-hand-holding-usd"></i> Total Paid</h5>
        <p class="card-text">$8,000</p>
      </div>
    </div>
  </div>

  <!-- Total Due -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-warning"><i class="fas fa-money-bill-wave"></i> Total Due</h5>
        <p class="card-text">$2,000</p>
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
        <p class="card-text">500</p>
      </div>
    </div>
  </div>

  <!-- Total Invoices -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-secondary"><i class="fas fa-file-invoice-dollar"></i> Total Invoices</h5>
        <p class="card-text">200</p>
      </div>
    </div>
  </div>

  <!-- Total Paid Invoices -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-dark"><i class="fas fa-file-invoice"></i> Total Paid Invoices</h5>
        <p class="card-text">150</p>
      </div>
    </div>
  </div>

  <!-- Total Quotes -->
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-muted"><i class="fas fa-quote-left"></i> Total Quotes</h5>
        <p class="card-text">50</p>
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
        <input type="text" id="date-range" class="form-control" placeholder="Select date range">
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
  </div>
</div>
  @endsection

  @push('js')
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Initialize date picker
    flatpickr('#date-range', {
      mode: 'range',
      dateFormat: 'Y-m-d',
    });

    // Income Overview Chart
    var incomeChartCtx = document.getElementById('income-chart').getContext('2d');
    var incomeChart = new Chart(incomeChartCtx, {
      type: 'line',
      data: {
        labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5'],
        datasets: [{
          label: 'Income',
          data: [100, 200, 150, 300, 250],
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Payment Overview Chart
    var paymentChartCtx = document.getElementById('payment-chart').getContext('2d');
    var paymentChart = new Chart(paymentChartCtx, {
      type: 'doughnut',
      data: {
        labels: ['Paid', 'Due'],
        datasets: [{
          label: 'Payment Overview',
          data: [2000, 800],
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
          data: [150, 50],
          backgroundColor: ['rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
        }]
      }
    });
  });
</script>
