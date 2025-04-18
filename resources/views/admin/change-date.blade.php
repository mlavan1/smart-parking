@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Update Booking Date</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Change date</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Date</h5>

                        <!-- Vertical Form -->
                        <form method="POST" action="{{ route('bookings.updateDate', $booking->id) }}">
                            @csrf
                            <input type="hidden" name="slot_id" id="slot-id">

                            <div class="row">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">New Date & Time</label>
                                    <input type="datetime-local" class="form-control" name="date_time" id="date_time"
                                    value="{{ \Carbon\Carbon::parse($booking->date_time)->format('Y-m-d\TH:i') }}" required>
                                    @error('slot_name')
                                    <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">Update date</button>
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
                        <h5 class="card-title">Details</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>No:</th>
                                    <th>Name</th>
                                    <th>Date& Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_bookings as $key => $booking)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->date_time)->format('jS F h:ia') }}</td>
                                        <td><span class="badge {{ $booking->status=="active"? 'bg-success':'bg-danger' }} bg-success">{{ $booking->status }}</span></td>

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
