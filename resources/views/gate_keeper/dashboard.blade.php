@extends('gate_keeper.layout')
@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Vehicle Control</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All Vehicle Controls</li>
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
                        {{-- {{ dd($allTodayVehicles) }} --}}
                        <table class="table datatable" style="font-size: 1.4em;">
                            <thead>

                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Vehicle Details</th>
                                    <th>License Plate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allTodayVehicles as $key =>  $vehicle)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $vehicle->vehicle_details }}</td>
                                        <td>{{ $vehicle->license_plate }}</td>
                                        <td>
                                             @if ($vehicle->status == 'booked')
                                            <form action="{{ route('keeper.accept', ["booking_id" => $vehicle->booking_id, "vehicle_id" => $vehicle->vehicle_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-md btn-success w-100"
                                                    onclick="return confirm('Are you sure you want to allow this vehicle?')">
                                                    <i class="bi bi-check-circle"></i> In
                                                </button>
                                            </form>
                                            @else
                                            <form action="{{ route('keeper.exit', ["booking_id" => $vehicle->booking_id, "vehicle_id" => $vehicle->vehicle_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-md btn-danger w-100"
                                                    onclick="return confirm('Are you sure you want to exit this vehicle?')">
                                                    <i class="bi bi-check-circle"></i> Out
                                                </button>
                                            </form>
                                            @endif

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
