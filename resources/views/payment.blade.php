<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

        body {
            background-color: #505050;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }

        .container {
            height: 100vh;
        }

        .card {

            border: none;
        }

        .card-header {
            padding: .5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: none;
        }

        .btn-light:focus {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
            box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
        }

        .form-control {
            height: 50px;
            border: 2px solid #eee;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #039be5;
            outline: 0;
            box-shadow: none;
        }

        .input {
            position: relative;
        }

        .input i {
            position: absolute;
            top: 16px;
            left: 11px;
            color: #989898;
        }

        .input input {
            text-indent: 25px;
        }

        .card-text {
            font-size: 13px;
            margin-left: 6px;
        }

        .certificate-text {
            font-size: 12px;
        }


        .billing {
            font-size: 11px;
        }

        .super-price {
            top: 0px;
            font-size: 22px;
        }

        .super-month {
            font-size: 11px;
        }


        .line {
            color: #bfbdbd;
        }

        .free-button {
            background: #1565c0;
            height: 52px;
            font-size: 15px;
            border-radius: 8px;
        }


        .payment-card-body {
            flex: 1 1 auto;
            padding: 24px 1rem !important;
        }

        .accept {
            background: #1cb15f;
        }

        .reject {
            background: #c71717;
        }

        .reject:hover {
            background: #860707;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column align-items-center mt-5">
        <div class="row">
            <div class="col-md-6">
                <span style="color: white;font-weight: 600;">Payment Method</span>
                <div class="card">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header p-0">
                                <h2 class="mb-0">
                                    <button class="btn btn-light btn-block text-left p-3 rounded-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>Credit card</span>
                                            <div class="icons" style="margin-left: 20px">
                                                <img src="{{ asset('assets/images/credit_card.png') }}" width="200">
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body payment-card-body">
                                    <span class="font-weight-normal card-text">Card Number</span>
                                    <div class="input">
                                        <i class="fa fa-credit-card"></i>
                                        <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-6">
                                            <span class="font-weight-normal card-text">Expiry Date</span>
                                            <div class="input">
                                                <i class="fa fa-calendar"></i>
                                                <input type="text" class="form-control" placeholder="MM/YY">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-normal card-text">CVC/CVV</span>
                                            <div class="input">
                                                <i class="fa fa-lock"></i>
                                                <input type="text" class="form-control" placeholder="000">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your
                                        transaction is secured with ssl certificate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <span style="color: white;font-weight: 600;">Summary</span>
                <div class="card">
                    <div class="d-flex justify-content-between p-3">
                        <div class="d-flex flex-column">
                            <span>Pre-booking fees <i class="fa fa-caret-down"></i></span>
                            <a href="#" class="billing">Save 20% with annual billing</a>
                        </div>
                        <div class="mt-1">
                            <sup class="super-price">Rs. 200</sup>
                            <span class="super-month">/slot</span>
                        </div>
                    </div>
                    <hr class="mt-0 line">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Name</span>
                            <span>Daniel</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total Slots</i></span>
                            <span>02</span>
                        </div>
                    </div>
                    <hr class="mt-0 line">
                    <div class="p-3 d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <span>Total Amount (Rs.)</span>
                            <small>Not refundable</small>
                        </div>
                        <span>Rs. 400</span>
                    </div>
                    <div class="p-3">
                        <button class="btn btn-primary btn-block free-button w-100">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
        <form id="cardForm" method="POST" action="{{ route('book.check') }}">
            @csrf
            <input type="hidden" name="payment_status" id="payment_status">
            <div class="row mt-5 d-flex justify-content-center align-items-center">

                <div class="p-3 w-70">
                    <button type="button" value="1"
                        class="btn btn-success btn-block free-button accept w-100">Simulate Card Accepted</button>
                </div>


                <div class="p-3 w-70">
                    <button type="button" value="0"
                        class="btn btn-danger btn-block free-button reject w-100">Simulate Card Rejected</button>
                </div>

            </div>
        </form>
    </div>

    {{-- Bootstrap CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- JQUERY CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.free-button').click(function() {
                var button = $(this);
                button.prop('disabled', true);
                $('#payment_status').val(button.val());
                $('#cardForm').submit();
            });
        });
    </script>
</body>

</html>
