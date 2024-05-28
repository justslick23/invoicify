@extends('layouts.app')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">
        @include('layouts.navbar')
        <br><br><br><br>
<div class="container">
    <h1>Invoices</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>
    <table class="table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Invoice Number</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
            <td><strong>{{ $invoice->client->company_name }}</strong> 
                <br>
                {{$invoice->client->email}}
            </td>

            <td>
    <span class="badge bg-primary">{{ $invoice->invoice_number }}</span>
</td>
<td>
    <span class="badge bg-secondary">{{ $invoice->due_date }}</span>
</td>

                <td>
    @php
        $badgeClass = '';
        switch($invoice->status) {
            case 'Unpaid':
                $badgeClass = 'badge bg-danger';
                break;
            case 'Partially Paid':
                $badgeClass = 'badge bg-warning text-dark';
                break;
            case 'Paid':
                $badgeClass = 'badge bg-success';
                break;
            case 'Overdue':
                $badgeClass = 'badge bg-secondary';
                break;
            default:
                $badgeClass = 'badge bg-primary';
        }
    @endphp
    <span class="{{ $badgeClass }}">{{ $invoice->status }}</span>
</td>                <td>
                    <a href="#" class="btn btn-primary btn-sm">View</a>
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
</div>
</div>
@endsection
