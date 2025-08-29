@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <br><br><br><br>
    <h1>Invoices</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Client</th>
                <th>Invoice Number</th>
                <th>Due Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>
                    <strong>{{ $invoice->client->company_name }}</strong><br>
                    {{ $invoice->client->email }}
                </td>
                <td><span class="badge bg-primary">{{ $invoice->invoice_number }}</span></td>
                <td><span class="badge bg-secondary">{{ $invoice->due_date }}</span></td>
                <td><span class="badge bg-success">{{ number_format($invoice->total, 2) }}</span></td>
                <td>
                    @php
                        $badgeClass = match($invoice->status) {
                            'Unpaid' => 'badge bg-danger',
                            'Partially Paid' => 'badge bg-warning text-dark',
                            'Paid' => 'badge bg-success',
                            'Overdue' => 'badge bg-secondary',
                            default => 'badge bg-primary',
                        };
                    @endphp
                    <span class="{{ $badgeClass }}">{{ $invoice->status }}</span>
                </td>
                <td>
                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <form action="#" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
