<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333333;
            background-color: #ffffff;
        }

        /* Page layout */
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
        }

        /* Header section */
        .invoice-header {
            background-color:rgb(210, 20, 20);
            color: #ffffff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .logo-section {
            display: table-cell;
            vertical-align: middle;
            width: 150px;
        }

        .logo-section img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .invoice-info {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .invoice-title {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-number {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-date {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Party information */
        .parties-section {
            margin-bottom: 30px;
        }

        .parties-row {
            display: table;
            width: 100%;
        }

        .party-card {
            display: table-cell;
            width: 48%;
            vertical-align: top;
            background-color: #f8fafc;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .party-card:first-child {
            margin-right: 4%;
        }

        .party-title {
            font-size: 12px;
            font-weight: bold;
            color: rgb(210, 20, 20);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .party-name {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .party-details {
            color: #64748b;
            line-height: 1.5;
        }

        /* Table styles */
        .items-section {
            margin-bottom: 30px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .invoice-table thead {
            background-color: rgb(210, 20, 20);
        }

        .invoice-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: bold;
            color: #ffffff;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgb(210, 20, 20);
        }

        .invoice-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .invoice-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .subtotal-row {
            background-color: #f1f5f9 !important;
            font-weight: bold;
        }

        .total-row {
            background-color: rgb(210, 20, 20) !important;
            color: #ffffff !important;
            font-weight: bold;
            font-size: 16px;
        }

        .total-row td {
            border-bottom: none !important;
        }

        .payment-title {
    font-size: 16px;
    font-weight: bold;
    color: #1e293b;
    margin-bottom: 10px;
}
.payment-table {
    width: 100%;
    border-collapse: collapse;
    border: none; /* Remove border from the table */
}

.payment-table td,
.payment-table th {
    border: none; /* Remove borders from table cells */
}


.payment-method {
    vertical-align: top;
    width: 33%;
    padding: 10px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background-color: #f8fafc;
}

.payment-method-name {
    font-weight: bold;
    color: rgb(210, 20, 20);
    font-size: 13px;
    margin-bottom: 5px;
}

.payment-method-details {
    color: #64748b;
    line-height: 1.5;
    font-size: 12px;
}


        /* Contact section */
        .contact-section {
            background-color:rgb(210, 20, 20);
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }

        .contact-info {
            display: inline-block;
            margin: 0 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Utility classes */
        .mb-10 { margin-bottom: 10px; }
        .mb-15 { margin-bottom: 15px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-30 { margin-bottom: 30px; }

        .font-bold { font-weight: bold; }
        .font-medium { font-weight: 500; }

        /* Print-specific styles */
        @page {
            margin: 1cm;
            size: A4;
        }

        @media print {
            body {
                font-size: 12px;
            }
            
            .invoice-container {
                padding: 0;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="logo-section">
                    <img src="{{ ('/images/Transparent Logo.png') }}" alt="Company Logo" />
                </div>
                <div class="invoice-info">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-number">{{ $invoice->invoice_number }}</div>
                    <div class="invoice-date">Invoice Date: {{ $invoice->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Parties Section -->
        <div class="parties-section">
            <div class="parties-row">
                <div class="party-card">
                    <div class="party-title">Invoice To</div>
                    <div class="party-name">{{ $invoice->client->company_name }}</div>
                    <div class="party-details">
                        {{ $invoice->client->email }}<br>
                        {{ $invoice->client->address->city }}<br>
                        {{ $invoice->client->address->country }}
                    </div>
                </div>
                <div class="party-card">
                    <div class="party-title">Invoice From</div>
                    <div class="party-name">Graphics by Slkstr.</div>
                    <div class="party-details">
                        Ha Matala Phase 2<br>
                        hello@tokelofoso.online<br>
                        Maseru, Lesotho
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="items-section">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No.</th>
                        <th style="width: 42%;">Item Description</th>
                        <th style="width: 15%;" class="text-center">Price</th>
                        <th style="width: 15%;" class="text-center">Quantity</th>
                        <th style="width: 20%;" class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td class="text-left">M{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">M{{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
            
                    <!-- Subtotal row -->
                    <tr class="subtotal-row">
                        <td colspan="4" class="text-right">Subtotal</td>
                        <td class="text-right">M{{ number_format($invoice->subtotal, 2) }}</td>
                        <td></td>
                    </tr>
            
                    <!-- Grand total row -->
                    <tr class="total-row">
                        <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                        <td class="text-right"><strong>M{{ number_format($invoice->total, 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
        </div>

        <!-- Payment Methods -->
        <div class="payment-section">
            <div class="payment-title">Payment Methods</div>
            <table class="payment-table">
                <tr>
                    <td class="payment-method">
                        <div class="payment-method-name">EFT (Electronic Funds Transfer)</div>
                        <div class="payment-method-details">
                            Account Name: Tokelo Foso<br>
                            Account Number: 62512324782<br>
                            Bank: First National Bank<br>
                            Branch: Pioneer
                        </div>
                    </td>
                    <td class="payment-method">
                        <div class="payment-method-name">M-Pesa</div>
                        <div class="payment-method-details">
                            Phone Number: 5676 9106<br>
                            Account Name: Tokelo Foso
                        </div>
                    </td>
                    <td class="payment-method">
                        <div class="payment-method-name">Ecocash</div>
                        <div class="payment-method-details">
                            Phone Number: 6823 1628<br>
                            Account Name: Tokelo Foso
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        

        <!-- Contact Information -->
        <div class="contact-section">
            <span class="contact-info">📞 +266 5676 9106</span>
            <span class="contact-info">✉️ hello@tokelofoso.online</span>
        </div>
    </div>
</body>
</html>