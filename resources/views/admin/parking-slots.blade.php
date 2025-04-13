@extends('admin.layout')

@section('main')
    <div class="pagetitle">
        <h1>Company Parking Slots</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">All Slots</li>
            </ol>
        </nav>
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
                                    <th>
                                        Name
                                    </th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_slots as $slots)
                                    <tr>
                                        <td>{{ $slots->name }}</td>
                                        <td><span class="badge bg-success">{{ $slots->status }}</span></td>
                                        <td> <button type="button" class="btn btn-sm btn-danger">Disable</button></td>
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
