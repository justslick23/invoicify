<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quote V3</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="{{ public_path('style.css') }}" rel="stylesheet">
    <link href="{{ public_path('black/css/black-dashboard.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles for A4 Size -->
    <style>
        @page {
            size: A4;
            margin: 0;
            padding: 0;
        }

        body {
            padding: 3%;
            background-image: url('{{ public_path('images/pattern-blur-right.png') }}');

        }

/* Clearfix */
.quote-info::after {
    content: "";
    display: table;
    clear: both;
}

.quote-info {
    margin-top: 20px;
}

.quote-info .info-block {
    width: calc(33.33% - 20px); /* Adjust for margin */
    float: left;
    margin-right: 10px; /* Equal spacing between columns */
    box-sizing: border-box; /* Include padding and border in the width */
}

.quote-info .info-block:last-child {
    margin-right: 0;
}


    </style>
</head>

<body>


    <section id="quote">
        <div class="container-fluid my-5 py-5">

        <div class="row pattern d-md-flex justify-content-top  py-5 py-md-3">
        <div class="d-none d-md-flex pattern-overlay pattern-right" style="background-image: url('images/pattern-blur-right.png');">
</div>

    <div class="col-md-4">
        <table style="width: 100%; margin-top: -5rem">
    
            <tr>
            <td style=" padding: 10px; text-align: left;">
                    <img src="{{ public_path('images/logoo.png') }}" alt="" style="max-width: 15%;">
                </td>
            <td style="">
                    <p class="text-primary fw-bold">Quote No</p>
                    <h5>{{ $quote->quote_number }}</h5>
                </td>
            
            </tr>
            <tr>
                <td><h2><strong>Quote</strong></h2></td>
                <td style=" ;">
                    <p class="text-primary fw-bold">Quote Date</p>
                    <h5>{{ $quote->created_at }}</h5>
                </td>
              <!-- Empty cell for logo column -->
            </tr>
            <tr>
                <td></td>
                <td style="">
                    <p class="text-primary fw-bold">Due Date</p>
                    <h5>{{ $quote->due_date }}</h5>
                </td>
                           </tr>
        </table>
    </div>
</div>

<hr style="border-top: 1px solid white;">



                <div class="quote-info">
    <table style = "width: 100%; table-layout:fixed">
        <tr>
            <td style="padding: 10px; width: 50%">
                <p class="text-primary fw-bold">quote To</p>
                <h4>{{ $quote->client->company_name }}</h4>
                <ul class="list-unstyled">
                    <li>{{ $quote->client->contact_first_name }} {{ $quote->client->contact_last_name }}</li>
                    <li>{{ $quote->client->email }}</li>
                    <li>{{ $quote->client->contact_number }}</li>
                    <li>{{ $quote->client->address->city }}</li>

                </ul>
            </td>
            <td style="padding: 10px;  width: 50%">
                <p class="text-primary fw-bold">Quote From</p>
                <h4><strong>Graphics by slktstr.</strong></h4>
                <ul class="list-unstyled">
                    <li>Tokelo Foso</li>
                    <li>graphics@tokelofoso.online</li>
                    <li>Ha Matala Phase 2</li>
                </ul>
            </td>
           
        </tr>
    </table>
</div>

<hr style="border-top: 1px solid white;">


<table class="table table-borderless table-striped my-5">
    <thead>
        <tr class="bg-primary">
            <th scope="col">No.</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($quote->items as $index => $item)
            <tr>
                <td class="text-white">{{ $index + 1 }}</td>
                <td class="text-white">{{ $item->product->name }}</td>
                <td class="text-white">{{ $item->quantity }}</td>
                <td class="text-white">{{ number_format($item->price, 2) }}</td>
                <td class="text-white">{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @php
                $total += $item->product->price * $item->quantity;
            @endphp
        @endforeach
        <tr>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white">Discount</td>
            <td class="text-white"><strong>M{{ number_format($quote->discount, 2) }}</strong></td>
        </tr>
        <tr>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white"></td>
            <td class="text-white">Total</td>
            <td class="text-white"><strong>M{{ number_format($quote->total, 2) }}</strong></td>
        </tr>
    </tbody>
</table>


<!-- Existing HTML code above this section -->
<div class="row mt-4 payment-methods">
    <div class="col-md-12">
        <h5 class="fw-bold">Payment Methods</h5>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <strong>EFT (Electronic Funds Transfer)</strong><br>
                        Account Name: Tokelo Foso<br>
                        Account Number: 62512324782<br>
                        Bank: First National Bank<br>
                        Branch: Pioneer
                    </td>
                    <td>
                        <strong>M-Pesa</strong><br>
                        Paybill Number: 5676 9106<br>
                        Account Name: Tokelo Foso
                    </td>
                    <td>
                        <strong>EcoCash</strong><br>
                        EcoCash Number: 6823 1628<br>
                        Account Name: Tokelo Foso
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>




<!-- Existing HTML code below this section -->


            <!-- Other sections of the quote -->

        </div>
    </section>

    <!-- Bootstrap Bundle JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

</body>

</html>