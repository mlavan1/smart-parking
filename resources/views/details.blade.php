@extends('layouts.layout')

@section('main')
    <style>
        button.pay_now {
            background: #007aff;
            color: white;
            width: 200px;
            padding: 10px 0;
            border: none;
            border-radius: 5px;
            transition: background 0.3s ease-in-out
        }

        button.pay_now:hover {
            background: #0052a8;
        }

        h3.sub_heading {
            font-size: 24px;
            font-weight: 600;
        }

        input[type="text"] {
            height: 35px
        }

        input[type="text"]:focus {
            box-shadow: none;
            border: 1px solid black
        }

        @media (min-width: 1025px) {}

        .gradient-custom-2 {
            background: linear-gradient(to right, rgb(3, 34, 83), rgba(194, 233, 251, 1))
        }

        .bg-indigo {
            background-color: #02304a;
        }

        @media (min-width: 992px) {
            .card-registration-2 .bg-indigo {
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }

        @media (max-width: 991px) {
            .card-registration-2 .bg-indigo {
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
    </style>
    <section class="h-100 gradient-custom-2">
        <div class="container py-3 h-100" style="font-size: 0.9em !important">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="py-4 px-4">
                                        <h3 class="sub_heading fw-normal mb-4" style="color: #02304a;">General Infomation
                                        </h3>

                                        <form action="{{ route('book.pay') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">Full name</label>
                                                        <input type="text" id="full_name" name="full_name"
                                                            value="{{ Auth::user()->name ?? '' }}"
                                                            class="form-control form-control-lg" style="font-size: 1em" />
                                                        @error('full_name')
                                                            <span
                                                                style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">E-mail</label>
                                                        <input type="text" id="email" name="email"
                                                            value="{{ Auth::user()->email ?? '' }}" style="font-size: 1em"
                                                            class="form-control form-control-lg" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">Contact no</label>
                                                        <input type="text" id="contact_number" name="contact_number"
                                                            value="{{ Auth::user()->contact_number ?? '' }}"
                                                            class="form-control form-control-lg" style="font-size: 1em" />
                                                        @error('contact_number')
                                                            <span
                                                                style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <h3 class="sub_heading fw-normal mb-3" style="color: #02304a;">Vehicle
                                                        Infomation
                                                    </h3>
                                                </div>
                                                {{-- {{ dd($vehicle) }} --}}
                                                @if ($vehicle)
                                                    <div class="col-5">
                                                        <button class="btn btn-sm btn-warning" id="fetch"
                                                        data-v_make="{{ $vehicle->v_make }}"
                                                        data-v_model="{{ $vehicle->v_make }}"
                                                        data-v_color="{{ $vehicle->v_color }}"
                                                        data-license_plate="{{ $vehicle->license_plate }}"
                                                        >
                                                        Fetch Vehicle Details
                                                        </button>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">Vehicle Make</label>
                                                        <input type="text" id="v_make" name="v_make"
                                                            class="form-control form-control-lg" style="font-size: 1em"/>
                                                        @error('v_make')
                                                            <span
                                                                style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">Vehicle Model</label>
                                                        <input type="text" id="v_model" name="v_model"
                                                            class="form-control form-control-lg" style="font-size: 1em"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev2">Vehicle Color</label>
                                                        <input type="text" id="v_color" name="v_color"
                                                            class="form-control form-control-lg" style="font-size: 1em"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <label class="form-label" for="form3Examplev4">License Plate
                                                            No</label>
                                                        <input type="text" id="license_plate" name="license_plate"
                                                            class="form-control form-control-lg" style="font-size: 1em"/>
                                                        @error('license_plate')
                                                            <span
                                                                style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-4 pb-2">
                                                    <button type="submit" class="pay_now">Pay Now</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="text-danger">
                                                    <strong><i>*** Book your parking with minimum of 1 hour ***</i></strong>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-indigo text-white">
                                    <div class="py-4 pl-4">
                                        <h3 class="sub_heading fw-normal mb-5">Booking Details</h3>

                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Location : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div><b>{{ $location_name[0] }}</b></div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Date : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div><b>{{ \Carbon\Carbon::parse($date)->format('jS F') }}</b></div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Time : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div><b>{{ \Carbon\Carbon::parse($time)->format('h : i a') }}</b></div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>No of Slots : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div><b>{{ $count_slots }}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#fetch').on('click', function (e) {
                e.preventDefault();
                var v_make = $(this).data('v_make');
                var v_model = $(this).data('v_model');
                var v_color = $(this).data('v_color');
                var license_plate = $(this).data('license_plate');
                $('#v_make').val(v_make);
                $('#v_model').val(v_model);
                $('#v_color').val(v_color);
                $('#license_plate').val(license_plate);
            });
        });
    </script>
@endsection
