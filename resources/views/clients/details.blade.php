<!-- resources/views/clients/show.blade.php -->
@extends('layouts.app')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">

@include('layouts.navbar')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Client Details</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Client Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6">
                        <div class="mb-3">
                        <h6>  <strong>Company Name:</strong> </h6>
                            
                            <p>{{ $client->company_name }}</p>
                        </div>
                       
                        <div class="mb-3">
                          <h6>  <strong>Contact First Name:</strong> </h6>
                            {{ $client->contact_first_name }}
                        </div>
                        <div class="mb-3">
                           <h6><strong>Contact Last Name:</strong> </h6> 
                            {{ $client->contact_last_name }}
                        </div>
                        <div class="mb-3">
                          <h6> <strong>Email:</strong> </h6> 
                            {{ $client->email }}
                        </div>
                        <div class="mb-3">
                          <h6><strong>Contact Number:</strong> </h6>  
                            {{ $client->contact_number }}
                        </div>
                        </div>
                        <div class="col-lg-6">
                        @if($client->address)

                            <div class="mb-3">
                               <h6><strong>Country</strong></h6> 
                                {{ $client->address->country }}

                            </div>
                            <div class="mb-3">
                               <h6><strong>City</strong></h6> 
                                {{ $client->address->city }}
                            </div>

                            <div class="mb-3">
                               <h6><strong>District</strong></h6> 
                                {{ $client->address->district }}
                            </div>
                            @else
                            <div class="mb-3">
                                <strong>No Address</strong>
                            </div>
                            @endif
                        </div>
                       
                        </div>
                     
                    
                        <!-- Add more client details here if needed -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div>
</div>
@endsection
