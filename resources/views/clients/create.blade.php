<!-- resources/views/clients/show.blade.php -->
@extends('layouts.app')

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">

@include('layouts.navbar')


@section('content')
<div class="container">
    <br><br><br><br>
        <h1>Create New Client</h1>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <form method="POST" action="{{ route('clients.store') }}">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            @csrf

            <div class="row mb-3 ">
                <div class="col-md-6">
                <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="contact_first_name">Contact First Name</label>
                <input type="text" class="form-control" id="contact_first_name" name="contact_first_name" required>
            </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                <div class="form-group">
                <label for="contact_last_name">Contact Last Name</label>
                <input type="text" class="form-control" id="contact_last_name" name="contact_last_name" required>
            </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
                </div>
            </div>
          
         
         
        <div class="row mb-3">
            <div class="col-md-6">
    <label for="contact_number">Contact Number</label>
    
     
   
        <input type="text" class="form-control  " id="contact_number" name="contact_number" >


            </div>
            <div class="col-md-6">
            <label for="district">District</label>
                        <input type="text" class="form-control" id="district" name="district">
            </div>
        </div>
    



<div class="row mb-3">
    <div class="col-md-6">
    <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city">
    </div>

    <div class="col-md-6">
    <label for="country">Country</label>
    <input class="form-control" id="country" name="country">
        <!-- Options will be dynamically added here -->
</input>
</div>
<script>
    async function fetchCountries() {
        try {
            const url = "https://restcountries.com/v3.1/all";
            const response = await fetch(url);

            if (!response.ok) {
                throw mb-3 new Error('Network response was not ok');
            }

            const data = await response.json();

            if (!Array.isArray(data)) {
                throw mb-3 new Error('Invalid response data format');
            }

            const select = document.getElementById('country');
            
            // Sort the country data alphabetically by common name
            data.sort((a, b) => {
                const nameA = a.name.common.toUpperCase();
                const nameB = b.name.common.toUpperCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });

            data.forEach(country => {
                const countryName = country.name.common;
                const option = document.createElement('option');
                option.value = countryName;
                option.text = countryName;
                select.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching or processing data:', error);
        }
    }

    fetchCountries();
</script>
</div>


<div class="row mb-3">
   
    <div class="col-md-12">
    <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code">
    </div>
</div>

<br> <br>




            <!-- Add more form fields as needed -->
            <button type="submit" class="btn btn-primary">Create Client</button>
        </form>
    </div>

</div>
</div>
@endsection

