@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Current Bookings</h1>
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

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Slots</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>No:</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Slots</th>
                                    <th>Date& Time</th>
                                    <th>Vehicle</th>
                                    <th>License plate</th>
                                    <th>Tp No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_bookings as $key => $booking)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $booking->user_type == 1 ? 'Company' : ($booking->user_type == 3 ? 'Vendor' : 'Other') }}
                                        </td>

                                        <td>{{ $booking->name }}</td>
                                        <td>
                                            @foreach (explode(',', $booking->slot_names) as $slot)
                                            <span style="background: orange; border-radius: 5px; padding: 2px 6px; color: rgb(0, 0, 0); margin-right: 4px; display: inline-block;font-size:0.7em;box-shadow:2px 2px 3px rgba(0,0,0,0.1)">
                                                {{ trim($slot) }}
                                            </span>
                                        @endforeach

                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($booking->date_time)->format('jS F h:ia') }}</td>
                                        <td>{{ $booking->vehicle_details }}</td>
                                        <td>{{ $booking->license_plate }}</td>
                                        <td>{{ $booking->contact_number }}</td>
                                        <td><span class="badge {{ $booking->status=="active"? 'bg-success':'bg-danger' }} bg-success">{{ $booking->status }}</span></td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning edit-slot-btn"
                                                href="{{ route('bookings.editDate', $booking->id) }}"
                                                data-id="{{ $booking->user_id }}"
                                                data-name="{{ $booking->user_id }}"
                                                data-section="{{ $booking->user_id }}">
                                                <i class="bi bi-calendar-event"></i>
                                            </a>
                                            @if ($booking->status == 'active')
                                            {{-- Cancel Button --}}
                                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    <i class="bi bi-x-circle"></i> Cancel
                                                </button>
                                            </form>
                                        @elseif ($booking->status == 'cancelled')
                                            {{-- Accept/Reactivate Button --}}
                                            <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    onclick="return confirm('Are you sure you want to reactivate this booking?')">
                                                    <i class="bi bi-check-circle"></i> Accept
                                                </button>
                                            </form>
                                        @endif
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
        $(document).ready(function () {
        $('.edit-slot-btn').on('click', function () {

            var slotId = $(this).data('id');
            var slotName = $(this).data('name');
            var sectionId = $(this).data('section');

            $('#slot-id').val(slotId);
            $('#slot-name-input').val(slotName);
            $('#section-select').val(sectionId);
            $('#submit-btn').text('Update Slot');
        });
    });
    </script>
@endsection
