@extends('vendor.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Your Parking Lots</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All Slots</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Space</h5>

                        <!-- Vertical Form -->
                        <form method="POST" action="{{ route('vendor.lots.save') }}">
                            @csrf
                            <input type="hidden" name="lot_id" id="lot-id">

                            <div class="row">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="lot_name" id="lot-name-input">
                                    @error('lot_name')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="lot_address" id="lot-address-input">
                                    @error('lot_address')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Hourly Rate</label>
                                    <input type="number" class="form-control" name="hourly_rate" id="lot-hourly-rate-input">
                                    @error('hourly_rate')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Location (Eg: Jaffna) </label>
                                    <input type="text" class="form-control" name="location_name" id="lot-location-name-input">
                                    @error('location_name')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">Add space</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Lots</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Location</th>
                                    <th>Hourly rate</th>
                                    <th>Status</th>
                                    <th>Slots</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ dd($all_lots) }} --}}
                                @foreach ($all_lots as $lot)
                                    <tr>
                                        <td>{{ $lot->name }}</td>
                                        <td>{{ $lot->address }}</td>
                                        <td>{{ $lot->hourly_rate }}</td>
                                        <td><span class="badge bg-success">{{ $lot->status }}</span></td>
                                        <td>{{ $lot->total_slots }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning edit-slot-btn"
                                                data-id="{{ $lot->id }}"
                                                data-name="{{ $lot->name }}"
                                                data-address="{{ $lot->address }}"
                                                data-hourly_rate="{{ $lot->hourly_rate }}"
                                                data-location_name="{{ $lot->location_name }}"
                                                >
                                                <i class=" bi bi-pencil-square"></i></a>
                                            {{-- <form action="{{ route('lot.delete', $lot->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-id="{{ $lot->id }}" data-name="{{ $lot->name }}"
                                                    data-section="{{ $lot->section_id }}"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash-fill"></i></button>
                                            </form> --}}
                                        </td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-slot-btn').on('click', function() {

                var lotId = $(this).data('id');
                var lotName = $(this).data('name');
                var lotAddress = $(this).data('address');
                var lotRate = $(this).data('hourly_rate');
                var locationName = $(this).data('location_name');

                $('#lot-id').val(lotId);
                $('#lot-name-input').val(lotName);
                $('#lot-address-input').val(lotAddress);
                $('#lot-hourly-rate-input').val(lotRate);
                $('#lot-location-name-input').val(locationName);
                $('#submit-btn').text('Update space');
            });
        });
    </script>
@endsection
