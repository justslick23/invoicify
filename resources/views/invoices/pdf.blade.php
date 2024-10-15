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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('invoice/assets/css/style.css') }}">

    <style>
        body {
            background-color: white; /* Set background to white */
            padding: 0 !important;
        }

        .table-borderless td,
        .table-borderless th {
            border: none;
        }

        .table-borderless {
    border-collapse: collapse; /* Ensures borders are collapsed */
}

        .table {
            border: none !important;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .invoice-1 {
            padding: 20px;
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
                            <table style="width: 100%; border: none !important;">
                                <tr>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="logo">
                                            <img src="{{ public_path('/images/Transparent Logo.png') }}" alt="Company Logo" style="width: 150px; height: 150px;">
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: right;">
                                        <div class="info">
                                            <h1 class="inv-header-1" style = "font-size:3rem;">Invoice</h1>
                                            <p class="mb-1"><span><strong>{{ $invoice->invoice_number }}</strong></span></p>
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
                                        <div class="invoice-number mb-30">
                                            <h4 class="inv-title-1">Invoice To</h4>
                                            <h2 class="name mb-10">{{ $invoice->client->company_name }}</h2>
                                            <p class="invo-addr-1">
                                                {{ $invoice->client->email }}<br>
                                                {{ $invoice->client->address->city }}<br>
                                                {{ $invoice->client->address->country }}<br>
                                            </p>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: left;">
                                        <div class="invoice-number mb-30">
                                            <h4 class="inv-title-1">Invoice From</h4>
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
                                <table class="table mb-0 table-striped invoice-table">
                                    <thead class="bg-active">
                                        <tr class="tr">
                                            <th>No.</th>
                                            <th class="pl0 text-start">Item Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->items as $index => $item)
                                        <tr class="tr">
                                            <td>
                                                <div class="item-desc-1">
                                                    <span>{{ $index + 1 }}</span>
                                                </div>
                                            </td>
                                            <td class="pl0">{{ $item->product->name }}</td>
                                            <td class="text-center">{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">SubTotal</td>
                                            <td class="text-end">M{{ number_format($invoice->subtotal, 2) }}</td>
                                        </tr>
                                      
                                        <tr class="tr2">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center f-w-600 active-color">Grand Total</td>
                                            <td class="f-w-600 text-end active-color">M{{ number_format($invoice->total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="invoice-bottom">
    <h3 class="inv-title-1">Payment Method</h3>
    <div class="table-responsive"> <!-- Optional: for responsive tables -->
        <table style="width: 100%;" class="table table-borderless"> <!-- Use Bootstrap table classes -->
            <tbody>
                <tr>
                    <td style="width: 50%;"><strong>EFT (Electronic Funds Transfer)</strong></td>
                    <td>
                        <strong>Account Name:</strong> Tokelo Foso<br>
                        <strong>Account Number:</strong> 62512324782<br>
                        <strong>Bank:</strong> First National Bank<br>
                        <strong>Branch:</strong> Pioneer
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;"><strong>M-Pesa</strong></td>
                    <td>
                        <strong>Phone Number:</strong> 5676 9106<br>
                        <strong>Account Name:</strong> Tokelo Foso
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;"><strong>Ecocash</strong></td>
                    <td>
                        <strong>Phone Number:</strong> 6823 1628<br>
                        <strong>Account Name:</strong> Tokelo Foso
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



                        <div class="invoice-contact clearfix">
                            <div class="row g-0">
                                <div class="col-lg-9 col-md-11 col-sm-12">
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
