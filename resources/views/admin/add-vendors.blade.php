@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <div class="row">
            <div class="col">
                <h1>Vendors</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">All vendors</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- End Page Title -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <section class="section">
        <div class="row">
            <div class="col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Vendor</h5>

                        <!-- Vertical Form -->
                        <form method="POST" action="{{ route('vendors.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" name="organization_name">
                                    @error('organization_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address">
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Contact No</label>
                                    <input type="text" class="form-control" name="contact_no">
                                    @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Add Vendor</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Vendors</h5>

                        <table class="table datatable">
                            <thead>

                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact no</th>
                                    <th>Org. name</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_vendors as $vendors)
                                    <tr>
                                        <td>{{ $vendors->organization_name }}</td>
                                        <td>{{ $vendors->organization_name }}</td>
                                        <td>{{ $vendors->organization_name }}</td>
                                        <td>{{ $vendors->organization_name }}</td>
                                        <td><span class="badge bg-success">{{ $vendors->address }}</span></td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning edit-slot-btn"

                                            data-id="{{ $vendors->id }}"
                                            data-name="{{ $vendors->organization_name }}"
                                            data-section="{{ $vendors->id }}">
                                            <i class=" bi bi-pencil-square"></i></a>
                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                            data-id="{{ $vendors->id }}"
                                            data-name="{{ $vendors->organization_name }}"
                                            data-section="{{ $vendors->id }}"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash-fill"></i></button >
                                            </form>
                                            {{-- <a type="button" class="btn btn-sm btn-secondary"
                                            data-id="{{ $vendors->id }}"
                                            data-name="{{ $vendors->name }}"
                                            data-section="{{ $vendors->section_id }}">
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
