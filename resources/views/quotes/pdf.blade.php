<!DOCTYPE html>
<html lang="en">

<head>
    <title>DISEE - Quote HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/css/style.css') }}">

    <style>
    body {
        background-color: white; /* Set background to white */
        padding: 0 !important;
    }

    .table-borderless td,
    .table-borderless th,
    .table-borderless tr {
        border: none !important; /* Force removal of all borders */
    }

    .table-borderless {
        border-collapse: collapse !important; /* Ensure borders are collapsed */
    }

    .table {
        border: 1px solid white !important; /* Force table borders to be white */
    }

    .table td,
    .table th {
        border: 1px solid white !important; /* Force table cell borders to be white */
    }

    .text-start {
        text-align: left;
    }

    .text-end {
        text-align: right;
    }

    .invoice-1 {
        padding: 0;
    }

    .invoice-content {
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .invoice-header h1 {
        font-size: 24px;
    }

    .invoice-table {
        margin-top: 20px;
        width: 100%;
    }

    .inv-title-1 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .active-color {
        color: #ff5722; /* Add color for totals */
    }

    .terms-conditions,
    .payment-method {
        margin-top: 30px;
    }

    .payment-method-list-1 li {
        margin-bottom: 5px;
    }

    .invoice-bottom {
        width: 100%; /* Ensure the invoice bottom takes the full width */
        padding: 0;  /* Remove any padding if present */
    }

    .payment-method {
        width: 100%; /* Ensure payment method section is 100% */
        margin: 0;   /* Reset margin if necessary */
    }

    /* Style for Terms section */
    .terms-section {
        margin-top: 30px;
    }

    .terms-section h4 {
        font-weight: 600;
    }

    .terms-section p {
        margin-bottom: 10px;
    }
</style>

</head>

<body>

    <!-- Quote start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <header class="invoice-header clearfix" id="invoice_wrapper">
                            <table style="width: 100%; border: 1px solid #fff !important;" class="table table-borderless">
                                <tr>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="logo">
                                            <img src="{{ public_path('/images/Transparent Logo.png') }}" alt="Company Logo" style="width: 150px; height: 150px;">
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: right;">
                                        <div class="info">
                                            <h1 class="inv-header-1" style="font-size:3rem;">Quote</h1>
                                            <h3 class="inv-title-1"><span><strong>{{ $quote->quote_number }}</strong></span></h3>
                                            <p class="mb-0">Quote Date: <span>{{ $quote->created_at->format('d M Y') }}</span></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </header>

                        <div class="invoice-top">
                            <table style="width: 100%;" class="table table-borderless">
                                <tr>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="invoice-number mb-30">
                                            <h4 class="inv-title-1">Quote To</h4>
                                            <h2 class="name mb-10">{{ $quote->client->company_name }}</h2>
                                            <p class="invo-addr-1">
                                                {{ $quote->client->email }}<br>
                                                {{ $quote->client->address->city }}<br>
                                                {{ $quote->client->address->country }}<br>
                                            </p>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="invoice-number mb-30">
                                            <h4 class="inv-title-1">Quote From</h4>
                                            <h2 class="name mb-10">Graphics by Slkstr.</h2>
                                            <p class="invo-addr-1">
                                                Ha Matala Phase 2 <br />
                                                hello@tokelofoso.online <br />
                                                Maseru, Lesotho <br />
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead class="bg-active">
                                        <tr class="tr">
                                            <th class="pl0 text-start">Item Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quote->items as $index => $item)
                                        <tr class="tr">
                                        
                                            <td class="pl0">
                                                {{ $item->product->name }}<br>
                                                <small>{{ $item->description }}</small>
                                            </td>
                                            <td class="text-center">{{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="tr2">
                                 
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">SubTotal</td>
                                            <td class="text-end">M{{ number_format($quote->subtotal, 2) }}</td>
                                        </tr>

                                        <tr class="tr2">
                               
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">Discount</td>
                                            <td class="text-end">M{{ number_format($quote->discount, 2) }}</td>
                                        </tr>


                                        <tr class="tr2">
                                        
                                            <td></td>
                                            <td></td>
                                            <td class="text-center f-w-600 active-color">Grand Total</td>
                                            <td class="f-w-600 text-end active-color">M{{ number_format($quote->total, 2) }}</td>
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

                        <!-- Terms and Conditions Section -->
                        <div class="terms-section">
                        <h3 class="inv-title-1">Terms</h3>
                        <p>{{ $quote->terms }}</p>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote end -->

    <!-- External JS libraries -->
    <script src="{{ public_path('invoice/assets/js/jquery.min.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/html2canvas.js') }}"></script>
    <script src="{{ public_path('invoice/assets/js/app.js') }}"></script>
</body>

</html>
