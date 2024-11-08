<!DOCTYPE html>
<html lang="en">

<head>
    <title>DISEE - Invoice HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/css/style.css') }}">

    <style>
        body {
            background-color: white;
            padding: 0 !important;
            font-family: 'Poppins', sans-serif;
        }

        .table-borderless td, .table-borderless th {
            border: none;
        }

        .text-start { text-align: left; }
        .text-end { text-align: right; }

        .invoice-1 { padding: 20px; }
        .inv-title-1 { font-size: 18px; margin-bottom: 10px; font-weight: 600; }
        .active-color { color: #ff5722; }
        .terms-conditions, .payment-method { margin-top: 30px; }
    </style>
</head>

<body>

    <!-- Invoice start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <header class="invoice-header clearfix" id="invoice_wrapper">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="logo">
                                            <img src="{{ public_path('/images/Transparent Logo.png') }}" alt="Company Logo" style="width: 150px; height: 150px;">
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: right;">
                                        <div class="info">
                                            <h1 class="inv-header-1" style="font-size:3rem;">Invoice</h1>
                                            <p class="mb-1"><strong>{{ $invoice->invoice_number }}</strong></p>
                                            <p class="mb-0">Invoice Date: <span>{{ $invoice->created_at->format('d M Y') }}</span></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </header>

                        <div class="invoice-top">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; text-align: left;">
                                        <h4 class="inv-title-1">Invoice To</h4>
                                        <h2 class="name mb-10">{{ $invoice->client->company_name }}</h2>
                                        <p>{{ $invoice->client->email }}<br>
                                           {{ $invoice->client->address->city }}<br>
                                           {{ $invoice->client->address->country }}</p>
                                    </td>
                                    <td style="width: 50%; text-align: left;">
                                        <h4 class="inv-title-1">Invoice From</h4>
                                        <h2 class="name mb-10">Graphics by Slkstr.</h2>
                                        <p>Ha Matala Phase 2<br>
                                           hello@tokelofoso.online<br>
                                           Maseru, Lesotho</p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table mb-0 table-striped invoice-table">
                                    <thead class="bg-active">
                                        <tr>
                                            <th>No.</th>
                                            <th class="pl0 text-start">Item Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="pl0">{{ $item->product->name }}</td>
                                            <td class="text-center">{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-center">SubTotal</td>
                                            <td class="text-end">M{{ number_format($invoice->subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="f-w-600 text-center active-color">Grand Total</td>
                                            <td class="f-w-600 text-end active-color">M{{ number_format($invoice->total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="invoice-bottom">
                            <h3 class="inv-title-1">Payment Method</h3>
                            <table style="width: 100%;" class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><strong>EFT (Electronic Funds Transfer)</strong></td>
                                        <td>Account Name: Tokelo Foso<br>Account Number: 62512324782<br>Bank: First National Bank<br>Branch: Pioneer</td>
                                    </tr>
                                    <tr>
                                        <td><strong>M-Pesa</strong></td>
                                        <td>Phone Number: 5676 9106<br>Account Name: Tokelo Foso</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ecocash</strong></td>
                                        <td>Phone Number: 6823 1628<br>Account Name: Tokelo Foso</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="invoice-contact clearfix">
                            <div class="contact-info">
                                <a href="tel:+26656769106"><i class="fa fa-phone"></i> +266 5676 9106</a>
                                <a href="mailto:hello@tokelofoso.online"><i class="fa fa-envelope"></i> hello@tokelofoso.online</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice end -->

    <!-- External JS libraries -->
    <script src="{{ public_path('invoice/assets/js/jquery.min.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/html2canvas.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/app.js') }}"></script>
</body>

</html>
