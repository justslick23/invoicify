@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <br><br><br><br>
    <h1 class="h3 mb-4">Create Invoice</h1>

    <form method="POST" action="{{ route('invoices.store') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select class="form-select" id="client_id" name="client_id" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="invoice_number" class="form-label">Invoice Number</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $invoiceNumber }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="invoice_date" class="form-label">Invoice Date</label>
                <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Unpaid">Unpaid</option>
                    <option value="Partially Paid">Partially Paid</option>
                    <option value="Paid">Paid</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>
        </div>

        <h3>Invoice Items</h3>
        <table class="table" id="invoice_items_table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="invoice_items">
                <!-- Invoice items will be added dynamically here -->
            </tbody>
        </table>
        <button type="button" class="btn btn-primary mb-3" onclick="addInvoiceItem()">Add Invoice Item</button>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="subtotal" class="form-label">Subtotal</label>
                <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
            </div>
            <div class="col-md-6">
                <label for="discount" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="terms" class="form-label">Terms and Conditions</label>
            <textarea class="form-control" id="terms" name="terms" rows="3" placeholder="Enter terms and conditions here"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>

    <template id="invoice_item_template">
        <tr>
            <td>
                <select class="form-control" name="products[]" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" class="form-control" name="descriptions[]" placeholder="Description">
            </td>
            <td>
                <input type="number" class="form-control" name="quantities[]" value="1" min="1" required>
            </td>
            <td>
                <input type="number" class="form-control" name="prices[]" step="0.01" required>
            </td>
            <td>
                <input type="text" class="form-control" name="totals[]" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeInvoiceItem(this)">Remove</button>
            </td>
        </tr>
    </template>

</div>

<script>
    function addInvoiceItem() {
        const invoiceItems = document.getElementById('invoice_items');
        const invoiceItemTemplate = document.getElementById('invoice_item_template');
        const newRow = invoiceItemTemplate.content.cloneNode(true);

        newRow.querySelector('[name="quantities[]"]').addEventListener('input', updateLineTotal);
        newRow.querySelector('[name="prices[]"]').addEventListener('input', updateLineTotal);
        invoiceItems.appendChild(newRow);
    }

    function removeInvoiceItem(button) {
        button.closest('tr').remove();
        updateSubtotal();
    }

    function updateLineTotal() {
        const row = this.closest('tr');
        const quantity = parseFloat(row.querySelector('[name="quantities[]"]').value) || 0;
        const price = parseFloat(row.querySelector('[name="prices[]"]').value) || 0;
        row.querySelector('[name="totals[]"]').value = (quantity * price).toFixed(2);
        updateSubtotal();
    }

    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('[name="totals[]"]').forEach(input => {
            subtotal += parseFloat(input.value) || 0;
        });
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        updateTotal();
    }

    function updateTotal() {
        const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        document.getElementById('total').value = (subtotal - discount).toFixed(2);
    }

    document.getElementById('discount').addEventListener('input', updateTotal);
</script>
@endsection
