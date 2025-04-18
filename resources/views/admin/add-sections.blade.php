@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Company Parking Sections</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All Sections</li>
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
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New section</h5>

                        <!-- Vertical Form -->
                        <form method="POST" action="{{ route('sections.saveOrUpdate') }}">
                            @csrf
                            <input type="hidden" name="section_id" id="slot-id">

                            <div class="row">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Section Name</label>
                                    <input type="text" class="form-control" name="section_name" id="slot-name-input">
                                    @error('section_name')
                                    <span style="color: red;font-size:0.9em"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">Add section</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Sections</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_sections as $sections)
                                    <tr>
                                        <td>{{ $sections->section_name }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning edit-slot-btn"

                                            data-id="{{ $sections->id }}"
                                            data-name="{{ $sections->section_name }}"
                                            data-section="{{ $sections->id }}">
                                            <i class=" bi bi-pencil-square"></i></a>
                                            <form action="{{ route('sections.delete', $sections->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-id="{{ $sections->id }}" data-name="{{ $sections->section_name }}"
                                                    data-section="{{ $sections->id }}"
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
