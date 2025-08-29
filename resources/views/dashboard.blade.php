@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <!-- Dashboard Header with Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="h3 mb-1 fw-bold">Dashboard</h1>
                    <p class="text-muted mb-0">Welcome back! Here's your business overview</p>
                </div>
                <div class="text-end">
                    <small class="text-muted d-block">Last updated</small>
                    <small class="fw-medium">{{ now()->format('M d, Y - H:i') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="row g-3 mb-4">
        @php
            $primaryMetrics = [
                ['label' => 'Total Revenue', 'value' => 'M'.number_format($totalAmount ?? 0, 2), 'icon' => 'fas fa-chart-line', 'color' => 'primary', 'trend' => '+12.5%'],
                ['label' => 'Payments Received', 'value' => 'M'.number_format($totalPaid ?? 0, 2), 'icon' => 'fas fa-wallet', 'color' => 'success', 'trend' => '+8.2%'],
                ['label' => 'Outstanding Amount', 'value' => 'M'.number_format($totalDue ?? 0, 2), 'icon' => 'fas fa-clock', 'color' => 'warning', 'trend' => '-5.1%'],
                ['label' => 'Active Clients', 'value' => number_format($totalClients ?? 0), 'icon' => 'fas fa-users', 'color' => 'info', 'trend' => '+3.7%'],
            ];
        @endphp

        @foreach($primaryMetrics as $metric)
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-shape icon-sm bg-{{ $metric['color'] }} bg-opacity-10 rounded-circle me-2">
                                    <i class="{{ $metric['icon'] }} text-{{ $metric['color'] }} fs-6"></i>
                                </div>
                                <span class="text-muted small">{{ $metric['label'] }}</span>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $metric['value'] }}</h3>
                            <span class="badge bg-{{ $metric['color'] }} bg-opacity-10 text-{{ $metric['color'] }} small">
                                {{ $metric['trend'] }} vs last month
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Secondary Metrics -->
    <div class="row g-3 mb-4">
        @php
            $secondaryMetrics = [
                ['label' => 'Total Products', 'value' => number_format($totalProducts ?? 0), 'icon' => 'fas fa-box', 'color' => 'secondary'],
                ['label' => 'Total Invoices', 'value' => number_format($totalInvoices ?? 0), 'icon' => 'fas fa-file-invoice-dollar', 'color' => 'dark'],
                ['label' => 'Paid Invoices', 'value' => number_format($totalPaidInvoices ?? 0), 'icon' => 'fas fa-check-circle', 'color' => 'success'],
                ['label' => 'Total Quotes', 'value' => number_format($totalQuotes ?? 0), 'icon' => 'fas fa-quote-left', 'color' => 'info'],
            ];
        @endphp

        @foreach($secondaryMetrics as $metric)
        <div class="col-6 col-xl-3">
            <div class="card bg-light border-0 h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape icon-sm bg-white rounded-circle me-3 shadow-sm">
                            <i class="{{ $metric['icon'] }} text-{{ $metric['color'] }} fs-6"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">{{ $metric['label'] }}</p>
                            <h4 class="mb-0 fw-semibold">{{ $metric['value'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts Section -->
    <div class="row g-4">

        <!-- Income Overview Chart -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-semibold">
                                <i class="fas fa-chart-area text-primary me-2"></i>
                                Revenue Analytics
                            </h5>
                            <p class="text-muted small mb-0">Track your income performance over time</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <select id="preset-date-range" class="form-select form-select-sm border-0 bg-light">
                                <option value="today">Today</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month" selected>This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <input type="text" id="custom-date-range" class="form-control form-control-sm border-0 bg-light d-none" placeholder="Select date range">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <canvas id="income-chart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Payment Status Overview -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2">
                    <h5 class="mb-1 fw-semibold">
                        <i class="fas fa-credit-card text-success me-2"></i>
                        Payment Status
                    </h5>
                    <p class="text-muted small mb-0">Overview of payment collections</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <div class="border-end">
                                <h4 class="text-success mb-1">M{{ number_format($totalPaid ?? 0, 2) }}</h4>
                                <small class="text-muted">Amount Received</small>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <h4 class="text-warning mb-1">M{{ number_format($totalDue ?? 0, 2) }}</h4>
                            <small class="text-muted">Amount Due</small>
                        </div>
                    </div>
                    <canvas id="payment-chart" style="height: 200px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Invoice Status Overview -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2">
                    <h5 class="mb-1 fw-semibold">
                        <i class="fas fa-file-invoice text-info me-2"></i>
                        Invoice Status
                    </h5>
                    <p class="text-muted small mb-0">Track your invoice completion</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <div class="border-end">
                                <h4 class="text-success mb-1">{{ number_format($totalPaidInvoices ?? 0) }}</h4>
                                <small class="text-muted">Paid Invoices</small>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <h4 class="text-danger mb-1">{{ number_format(($totalInvoices ?? 0) - ($totalPaidInvoices ?? 0)) }}</h4>
                            <small class="text-muted">Unpaid Invoices</small>
                        </div>
                    </div>
                    <canvas id="invoice-chart" style="height: 200px;"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions Bar -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 bg-primary bg-opacity-5">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 fw-semibold text-primary">Quick Actions</h6>
                            <small class="text-muted">Streamline your workflow</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i>New Invoice
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-user-plus me-1"></i>Add Client
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-chart-bar me-1"></i>View Reports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
.icon-shape {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.icon-sm {
    width: 2rem;
    height: 2rem;
}
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}
.bg-opacity-5 {
    --bs-bg-opacity: 0.05;
}
.bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Initialize flatpickr
    flatpickr("#custom-date-range", {
        mode: "range",
        dateFormat: "Y-m-d",
    });

    // Show/hide custom date input
    document.getElementById('preset-date-range').addEventListener('change', function() {
        const customRange = document.getElementById('custom-date-range');
        if (this.value === 'custom') customRange.classList.remove('d-none');
        else customRange.classList.add('d-none');
    });

    Chart.defaults.font.family = 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
    Chart.defaults.color = '#6c757d';
// ===== Income Chart =====
const incomeCtx = document.getElementById('income-chart').getContext('2d');
const gradient = incomeCtx.createLinearGradient(0, 0, 0, 350);
gradient.addColorStop(0, 'rgba(13, 110, 253, 0.15)');
gradient.addColorStop(1, 'rgba(13, 110, 253, 0.02)');

new Chart(incomeCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($incomeChartLabels ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!},
        datasets: [{
            label: 'Revenue',
            data: {!! json_encode($incomeChartValues ?? [12000,19000,15000,25000,22000,30000]) !!},
            borderColor: '#0d6efd',
            backgroundColor: gradient,
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#fff',
            pointBorderColor: '#0d6efd',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        interaction: { intersect: false, mode: 'index' },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#8e9baa' } },
            y: {
                grid: { color: '#f1f5f9' },
                ticks: {
                    color: '#8e9baa',
                    callback: function(value) { return 'M' + new Intl.NumberFormat().format(value / 1000) + 'K'; }
                }
            }
        }
    }
});


    // ===== Payment Doughnut Chart =====
    new Chart(document.getElementById('payment-chart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Received', 'Outstanding'],
            datasets: [{
                data: [{{ $totalPaid ?? 75 }}, {{ $totalDue ?? 25 }}],
                backgroundColor: ['#198754','#ffc107'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', padding: 20 } },
                tooltip: { backgroundColor: '#000', titleColor:'#fff', bodyColor:'#fff', cornerRadius:8 }
            }
        }
    });

    // ===== Invoice Doughnut Chart =====
    new Chart(document.getElementById('invoice-chart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Paid Invoices', 'Unpaid Invoices'],
            datasets: [{
                data: [{{ $totalPaidInvoices ?? 65 }}, {{ ($totalInvoices ?? 100)-($totalPaidInvoices ?? 65) }}],
                backgroundColor: ['#198754','#dc3545'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', padding: 20 } },
                tooltip: { backgroundColor: '#000', titleColor:'#fff', bodyColor:'#fff', cornerRadius:8 }
            }
        }
    });

});
</script>
@endpush
