@extends('layouts.app')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">
        @include('layouts.navbar')
        <div class="container">
            <br><br><br><br>
            <h1>Create Quote</h1>
            <form method="POST" action="{{ route('quotes.store') }}">
                @csrf
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

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="client_id">Client</label>
                        <select class="form-control" id="client_id" name="client_id" required>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="quote_number">Quote Number</label>
                        <input type="text" class="form-control" id="quote_number" name="quote_number"
                            value="{{ $quoteNumber }}" readonly required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h3>Quote Items</h3>
                        <table class="table" id="quote_items_table">
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
                            <tbody id="quote_items">
                                <!-- Quote items will be added dynamically here -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="addQuoteItem()">Add Quote Item</button>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="subtotal">Subtotal</label>
                        <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="total">Total</label>
                        <input type="text" class="form-control" id="total" name="total" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="terms">Terms</label>
                        <textarea class="form-control" id="terms" name="terms" rows="4"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Quote</button>
            </form>
        </div>
    </div>
</div>

<script>
function updateTotals() {
    let subtotal = 0;
    const rows = document.querySelectorAll('#quote_items_table tbody tr');
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('[name="quantities[]"]').value) || 0;
        const price = parseFloat(row.querySelector('[name="prices[]"]').value) || 0;
        const totalInput = row.querySelector('[name="totals[]"]');
        const total = quantity * price;
        totalInput.value = total.toFixed(2);
        subtotal += total;
    });

    document.getElementById('subtotal').value = subtotal.toFixed(2);

    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const total = subtotal - discount;
    document.getElementById('total').value = total.toFixed(2);
}

document.addEventListener('input', function(event) {
    const target = event.target;
    if (target && (target.name === 'quantities[]' || target.name === 'prices[]' || target.id === 'discount')) {
        updateTotals();
    }
});

function removeQuoteItem(button) {
    const rowToRemove = button.closest('tr');
    rowToRemove.remove();
    updateTotals();
}

function addQuoteItem() {
    const quoteItemsTable = document.getElementById('quote_items_table').getElementsByTagName('tbody')[0];
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <select class="form-control" name="products[]" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="descriptions[]" placeholder="Item description">
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
            <button type="button" class="btn btn-danger" onclick="removeQuoteItem(this)">Remove</button>
        </td>
    `;
    quoteItemsTable.appendChild(newRow);
    updateTotals();
}
</script>

@endsection
