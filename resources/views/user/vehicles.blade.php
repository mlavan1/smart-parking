@extends('user.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Your Bookings</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All User Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Vehicles</h5>

                        <table class="table datatable" style="font-size: 0.9em;">
                            <thead>

                                <tr>
                                    <th>No.</th>
                                    <th>Vehicle</th>
                                    <th>License Plate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_vehicles as $key =>  $vehicle)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $vehicle->vehicle_details }}</td>
                                        <td>{{ $vehicle->license_plate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
