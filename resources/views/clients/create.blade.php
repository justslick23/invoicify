@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <br><br><br><br>
    <h1 class="h3 mb-4">Create New Client</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('clients.store') }}">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
            <div class="col-md-6">
                <label for="contact_first_name" class="form-label">Contact First Name</label>
                <input type="text" class="form-control" id="contact_first_name" name="contact_first_name" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="contact_last_name" class="form-label">Contact Last Name</label>
                <input type="text" class="form-control" id="contact_last_name" name="contact_last_name" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number">
            </div>
            <div class="col-md-6">
                <label for="district" class="form-label">District</label>
                <input type="text" class="form-control" id="district" name="district">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="col-md-6">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country" name="country">
                    <!-- Options will be dynamically added -->
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Client</button>
    </form>

</div>

<script>
    async function fetchCountries() {
        try {
            const response = await fetch("https://restcountries.com/v3.1/all");
            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            if (!Array.isArray(data)) throw new Error('Invalid response data');

            const select = document.getElementById('country');
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common;
                option.text = country.name.common;
                select.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching countries:', error);
        }
    }

    fetchCountries();
</script>
@endsection
