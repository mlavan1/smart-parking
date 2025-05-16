<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/dollar.png" type="image/png" sizes="16x16">
    <title>Payment Success</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    ._failed {
        border-bottom: solid 4px red !important;
    }

    ._failed i {
        color: red !important;
    }

    ._success {
        box-shadow: 0 15px 25px #00000019;
        padding: 45px;
        width: 100%;
        text-align: center;
        margin: 40px auto;
        border-bottom: solid 4px #28a745;
    }

    ._success i {
        font-size: 55px;
        color: #28a745;
    }

    ._success h2 {
        margin-bottom: 12px;
        font-size: 40px;
        font-weight: 500;
        line-height: 1.2;
        margin-top: 10px;
    }

    ._success p {
        margin-bottom: 0px;
        font-size: 18px;
        color: #495057;
        font-weight: 500;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="message-box _success _failed">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    <h2> Your payment failed </h2>
                    <p> Try again later. <a href="/">   Go back to Home Page</a></p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
