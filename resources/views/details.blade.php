@extends('layouts.layout')

@section('main')
    <style>
        a.pay_now {
            background: rgb(29, 29, 28);
            color: white;
            padding: 10px 30px;
            border-radius: 5px;
            transition: background 0.3s ease-in-out
        }

        a.pay_now:hover {
            background: rgb(74, 75, 78);
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
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <h3 class="sub_heading fw-normal mb-4" style="color: #02304a;">General Infomation
                                        </h3>

                                        <div class="row">
                                            <div class="col-md-12 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev2">Full name</label>
                                                    <input type="text" id="form3Examplev2"
                                                        class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev2">E-mail</label>
                                                    <input type="text" id="form3Examplev2"
                                                        class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev2">Contact no</label>
                                                    <input type="text" id="form3Examplev2"
                                                        class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="sub_heading fw-normal mb-4" style="color: #02304a;">Vehicle Infomation
                                        </h3>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev2">Vehicle Make</label>
                                                    <input type="text" id="form3Examplev2"
                                                        class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev2">Vehicle Model</label>
                                                    <input type="text" id="form3Examplev2"
                                                        class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="form3Examplev4">License Plate No</label>
                                                    <input type="text" id="form3Examplev4"
                                                        class="form-control form-control-lg" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-4 pb-2">
                                                <a href="" class="pay_now">Pay Now</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 bg-indigo text-white">
                                    <div class="p-5">
                                        <h3 class="sub_heading fw-normal mb-5">Booking Details</h3>

                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Location : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div>Jan -34</div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Date : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div>Jan -34</div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Time : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div>Jan -34</div>
                                            </div>
                                        </div>
                                        <div class="row p-4" style="border-bottom:1px solid rgb(255, 255, 255)">
                                            <div class="col-md-6 ">
                                                <div>Slots : </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div>Jan -34</div>
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
@endsection
