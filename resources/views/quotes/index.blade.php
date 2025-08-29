@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <br><br><br><br>
    <h1>All Quotes</h1>

    <div class="mb-3">
        <a href="{{ route('quotes.create') }}" class="btn btn-primary">Create New Quote</a>
    </div>

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

    <table class="table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Quote Number</th>
                <th>Quote Date</th>
                <th>Due Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotes as $quote)
            <tr>
                <td>
                    <strong>{{ $quote->client->company_name }}</strong><br>
                    {{ $quote->client->email }}
                </td>
                <td><span class="badge bg-primary">{{ $quote->quote_number }}</span></td>
                <td><span class="badge bg-secondary">{{ $quote->created_at->format('Y-m-d') }}</span></td>
                <td><span class="badge bg-info">{{ $quote->due_date }}</span></td>
                <td>{{ $quote->total }}</td>
                <td>
                    <a href="{{ route('quotes.pdf', $quote->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-warning btn-sm" title="Edit">
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
