<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Smart Parking System</title>



    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700|Roboto:400,700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('') }}/assets/css/style.css" rel="stylesheet" />
    
    <!-- responsive style -->
    <link href="{{ url('') }}/assets/css/responsive.css" rel="stylesheet" />

    <style>
        html,
        body {
            padding: 0 !important;
            margin: 0 !important;
            box-sizing: border-box !important
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- header section strats -->
    <div class="container-fluid" style="margin:0; padding:0;">@include('components.header')</div>


    @yield('main')

    <!-- footer section -->
    @include('components.footer')

    <script type="text/javascript" src="{{ url('') }}/assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="{{ url('') }}/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ url('') }}/assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $("a[href^='#']").on("click", function(event) {
                event.preventDefault();
                var target = $(this.getAttribute("href"));
                if (target.length) {
                    $("html, body").animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
            });
        });
    </script>

</body>

</html>
