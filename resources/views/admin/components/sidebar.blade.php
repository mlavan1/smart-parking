<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? 'active' : 'collapsed' }}" href="home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('slots') ? 'active' : 'collapsed' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Company</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content {{ request()->is('slots') ? 'active' : 'collapsed' }} " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="slots">
                        <i class="bi bi-circle"></i><span>Slots</span>
                    </a>
                </li>
                <li>
                    <a href="sections">
                        <i class="bi bi-circle"></i><span>Sections</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('bookings-current') ? 'active' : 'collapsed' }}" data-bs-target="#bookings-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-week"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="bookings-nav" class="nav-content {{ request()->is('/bookings-current') ? 'active' : 'collapsed' }} " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="bookings-current">
                        <i class="bi bi-circle"></i><span>Active</span>
                    </a>
                </li>
                <li>
                    <a href="bookings-past">
                        <i class="bi bi-circle"></i><span>Completed</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#vendor-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Vendors</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="vendor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="vendors">
                        <i class="bi bi-circle"></i><span>Details</span>
                    </a>
                </li>
                <li>
                    <a href="vendors">
                        <i class="bi bi-circle"></i><span>Organizations</span>
                    </a>
                </li>
                <li>
                    <a href="vendors">
                        <i class="bi bi-circle"></i><span>Slots</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users">
                <i class="bi bi-gem"></i><span>Customers</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Reports</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Settings</span>
            </a>
        </li> --}}


</aside><!-- End Sidebar-->
