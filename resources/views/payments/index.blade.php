@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <br><br><br><br>
    <h1>All Payments</h1>

    <div class="mb-3">
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Create New Payment</a>
    </div>

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

    <table class="table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Invoice Number</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>
                    <strong>{{ $payment->invoice->client->company_name }}</strong><br>
                    {{ $payment->invoice->client->email }}
                </td>
                <td><span class="badge bg-primary">{{ $payment->invoice->invoice_number }}</span></td>
                <td><span class="badge bg-secondary">{{ $payment->amount }}</span></td>
                <td><span class="badge bg-info">{{ $payment->payment_method }}</span></td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fa fa-pencil-square"></i>
                    </a>
                    <form action="#" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    <a href="#" class="btn btn-info btn-sm" title="Convert to Invoice">
                        <i class="fas fa-file-invoice"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
