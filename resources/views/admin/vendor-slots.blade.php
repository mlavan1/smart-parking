@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Vendor Parking Slots</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All Vendor Slots</li>
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
                        <h5 class="card-title">All Slots</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_slots as $slots)
                                    <tr>
                                        <td>{{ $slots->name }}</td>
                                        <td>{{ $slots->section_name }}</td>
                                        <td><span class="badge bg-success">{{ $slots->status }}</span></td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning edit-slot-btn"

                                            data-id="{{ $slots->id }}"
                                            data-name="{{ $slots->name }}"
                                            data-section="{{ $slots->section_id }}">
                                            <i class=" bi bi-pencil-square"></i></a>
                                            <form action="{{ route('slots.destroy', $slots->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                            data-id="{{ $slots->id }}"
                                            data-name="{{ $slots->name }}"
                                            data-section="{{ $slots->section_id }}"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash-fill"></i></button >
                                            </form>
                                            {{-- <a type="button" class="btn btn-sm btn-secondary"
                                            data-id="{{ $slots->id }}"
                                            data-name="{{ $slots->name }}"
                                            data-section="{{ $slots->section_id }}">
                                            <i class="bi bi-stop-circle-fill"></i></a> --}}
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
