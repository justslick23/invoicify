{{-- resources/views/payments/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <br><br><br><br>
    <h1>Add Payment</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('payments.store') }}">
        @csrf

        <div class="mb-3">
            <label for="invoice_id" class="form-label">Invoice Number</label>
            <select class="form-select" id="invoice_id" name="invoice_id" required>
                <option value="">Select an invoice</option>
                @foreach ($invoices as $invoice)
                    <option value="{{ $invoice->id }}" data-total="{{ $invoice->total }}">
                        {{ $invoice->invoice_number }} [{{ $invoice->client->company_name }}]
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="due_amount" class="form-label">Due Amount</label>
                <input type="text" class="form-control" id="due_amount" name="due_amount" readonly>
            </div>
            <div class="col-md-6">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
                <option value="M-Pesa">M-Pesa</option>
                <option value="EcoCash">EcoCash</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Payment</button>
    </form>
</div>

<script>
    document.getElementById('invoice_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const totalAmount = selectedOption.getAttribute('data-total');
        document.getElementById('due_amount').value = totalAmount;
    });
</script>
@endsection
