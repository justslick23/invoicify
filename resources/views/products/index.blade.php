@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <br><br><br><br>
    <h1>All Products</h1>

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

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
