<!-- resources/views/clients.blade.php -->

@extends('layouts.app')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">

@include('layouts.navbar')


@section('content')
<br><br><br><br>
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>All Clients</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('clients.create') }}" class="btn btn-primary">Add Client</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="text" id="search" class="form-control mb-3" placeholder="Search...">
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
    <tr onclick="window.location='{{ route('clients.show', $client->id) }}';" style="cursor: pointer;">
        <td>{{ $client->id }}</td>
        <td><strong>{{ $client->company_name }}</strong>
            <br>
            {{ $client->contact_first_name }} {{ $client->contact_last_name }}
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            <form action="#" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
