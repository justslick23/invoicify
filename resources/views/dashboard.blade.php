@extends('layouts.app')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    
    <div class="body-wrapper">
        @include('layouts.navbar')

        <div class="container-fluid px-4 py-3">
            <!-- Dashboard Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="text-dark fw-bold mb-1">Dashboard Overview</h2>
                            <p class="text-muted mb-0">Welcome back! Here's what's happening with your business today.</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">Last updated: {{ date('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Metrics Row -->
            <div class="row g-4 mb-4">
                <!-- Total Clients -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-primary fw-semibold mb-2">
                                        <i class="fas fa-users me-2"></i>Total Clients
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">{{ number_format($totalClients ?? 0) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-users text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-danger fw-semibold mb-2">
                                        <i class="fas fa-dollar-sign me-2"></i>Total Amount
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">M{{ number_format($totalAmount ?? 0, 2) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-danger bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-dollar-sign text-danger fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Paid -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-success fw-semibold mb-2">
                                        <i class="fas fa-hand-holding-usd me-2"></i>Total Paid
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">M{{ number_format($totalPaid ?? 0, 2) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-hand-holding-usd text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Due -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-warning fw-semibold mb-2">
                                        <i class="fas fa-money-bill-wave me-2"></i>Total Due
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">M{{ number_format($totalDue ?? 0, 2) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-money-bill-wave text-warning fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Metrics Row -->
            <div class="row g-4 mb-4">
                <!-- Total Products -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-info fw-semibold mb-2">
                                        <i class="fas fa-box me-2"></i>Total Products
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">{{ number_format($totalProducts ?? 0) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-info bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-box text-info fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Invoices -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-secondary fw-semibold mb-2">
                                        <i class="fas fa-file-invoice-dollar me-2"></i>Total Invoices
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">{{ number_format($totalInvoices ?? 0) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-secondary bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-file-invoice-dollar text-secondary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Paid Invoices -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-dark fw-semibold mb-2">
                                        <i class="fas fa-file-invoice me-2"></i>Paid Invoices
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">{{ number_format($totalPaidInvoices ?? 0) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-dark bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-file-invoice text-dark fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Quotes -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="card-subtitle text-muted fw-semibold mb-2">
                                        <i class="fas fa-quote-left me-2"></i>Total Quotes
                                    </h6>
                                    <h3 class="card-title fw-bold text-dark mb-0">{{ number_format($totalQuotes ?? 0) }}</h3>
                                </div>
                                <div class="icon-wrapper bg-light rounded-circle p-3">
                                    <i class="fas fa-quote-left text-muted fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <!-- Income Overview Chart -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title fw-bold text-dark mb-0">
                                        <i class="fas fa-chart-line text-primary me-2"></i>Income Overview
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex gap-2">
                                        <select id="preset-date-range" class="form-select form-select-sm">
                                            <option value="today">Today</option>
                                            <option value="this_week">This Week</option>
                                            <option value="last_week">Last Week</option>
                                            <option value="this_month" selected>This Month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="custom">Custom Range</option>
                                        </select>
                                        <input type="text" id="custom-date-range" class="form-control form-control-sm d-none" placeholder="Select date range">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="chart-container" style="position: relative; height: 400px;">
                                <canvas id="income-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Charts Row -->
            <div class="row g-4">
                <!-- Payment Overview Chart -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title fw-bold text-dark mb-0">
                                <i class="fas fa-chart-pie text-success me-2"></i>Payment Overview
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="chart-container" style="position: relative; height: 300px;">
                                <canvas id="payment-chart"></canvas>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                        <small class="text-muted">Paid: M{{ number_format($totalPaid ?? 0, 2) }}</small>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="bg-danger rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                        <small class="text-muted">Due: M{{ number_format($totalDue ?? 0, 2) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Overview Chart -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title fw-bold text-dark mb-0">
                                <i class="fas fa-file-invoice text-info me-2"></i>Invoice Overview
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="chart-container" style="position: relative; height: 300px;">
                                <canvas id="invoice-chart"></canvas>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                        <small class="text-muted">Paid: {{ number_format($totalPaidInvoices ?? 0) }}</small>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="bg-danger rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                        <small class="text-muted">Unpaid: {{ number_format(($totalInvoices ?? 0) - ($totalPaidInvoices ?? 0)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
    .icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .chart-container canvas {
        max-height: 100% !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .text-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endpush

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ensure payments data is available
    const paymentsData = @json($payments ?? []);
    
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
            datesForMonth.push(new Date(dateString).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));

            const payment = paymentsData.find(entry => {
                if (!entry.payment_date) return false;
                const paymentDate = new Date(entry.payment_date);
                return paymentDate.toISOString().split('T')[0] === dateString;
            });

            chartData.push(payment ? parseFloat(payment.amount) || 0 : 0);
        }

        // Render the chart with improved styling
        const incomeChartCtx = document.getElementById('income-chart');
        if (!incomeChartCtx) return;
        
        const ctx = incomeChartCtx.getContext('2d');
        if (window.incomeChart) {
            window.incomeChart.destroy();
        }
        
        window.incomeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: datesForMonth,
                datasets: [{
                    label: 'Amount Paid (M)',
                    data: chartData,
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4f46e5',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date',
                            font: { weight: 'bold' }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount Paid (M)',
                            font: { weight: 'bold' }
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Enhanced Payment Overview Chart
    const paymentChartCtx = document.getElementById('payment-chart');
    if (paymentChartCtx) {
        const paymentChart = new Chart(paymentChartCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Due'],
                datasets: [{
                    label: 'Payment Overview',
                    data: [{{ $totalPaid ?? 0 }}, {{ $totalDue ?? 0 }}],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Enhanced Invoice Overview Chart
    const invoiceChartCtx = document.getElementById('invoice-chart');
    if (invoiceChartCtx) {
        const totalInvoices = {{ $totalInvoices ?? 0 }};
        const totalPaidInvoices = {{ $totalPaidInvoices ?? 0 }};
        const unpaidInvoices = Math.max(0, totalInvoices - totalPaidInvoices);
        
        const invoiceChart = new Chart(invoiceChartCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Unpaid'],
                datasets: [{
                    label: 'Invoice Overview',
                    data: [totalPaidInvoices, unpaidInvoices],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
});
</script>
@endpush