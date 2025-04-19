<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="/">
                <span>
                    Smart-Spot
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                    <ul class="navbar-nav  ">

                        @if (Request::is('/'))
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#feauture"> Features </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about"> About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#service"> Services </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact us</a>
                            </li>
                        @endif
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" style="background: #fe4701;padding:10px 30px; border-radius:5px;color:rgb(255, 255, 255)"
                                class="ml-5">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="ctm_entry_btn_anchor">
                                <div class="ctm_entry_btn">Log in</div>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </div>
</header>
