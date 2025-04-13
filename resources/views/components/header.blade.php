<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
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
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about"> About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#feauture"> Features </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#service"> Services </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact us</a>
                        </li>
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else

                                <a href="{{ route('login') }}" class="ctm_entry_btn_anchor"><div class="ctm_entry_btn">Log in</div></a>


                            {{-- @if (Route::has('register'))
                                        <div class="ctm_entry_btn">
                                            <a href="{{ route('register') }}" class="">Register</a>
                                        </div>
                                    @endif --}}
                        @endauth
                    @endif
                    {{-- <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>


                    </form> --}}
                </div>
            </div>
        </nav>
    </div>
</header>
