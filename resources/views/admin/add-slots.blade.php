@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Company Parking Slots</h1>
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
                        <h5 class="card-title">Add New Slot</h5>

                        <!-- Vertical Form -->
                        <form method="POST" action="{{ route('slots.saveOrUpdate') }}">
                            @csrf
                            <input type="hidden" name="slot_id" id="slot-id">

                            <label class="form-label">Section</label>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <select class="form-select" name="section_id" id="section-select">
                                        <option selected disabled>Select a section</option>
                                        @foreach ($all_sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="slot_name" id="slot-name-input">
                                    @error('slot_name')
                                        <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">Add slot</button>
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
                        <h5 class="card-title">All Slots</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
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
                                                data-id="{{ $slots->id }}" data-name="{{ $slots->name }}"
                                                data-section="{{ $slots->section_id }}">
                                                <i class=" bi bi-pencil-square"></i></a>
                                            <form action="{{ route('slots.delete', $slots->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-id="{{ $slots->id }}" data-name="{{ $slots->name }}"
                                                    data-section="{{ $slots->section_id }}"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash-fill"></i></button>
                                            </form>
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
