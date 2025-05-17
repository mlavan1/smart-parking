 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->is('home') ? 'active' : 'collapsed' }}" href="/home">
          <i class="bi bi-grid"></i>
          <span>User Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item mt-5">
        <a class="nav-link {{ request()->is('user-bookings') || request()->is('user-bookings/*') ? 'active' : 'collapsed' }}" href="/user-bookings">
          <i class="bi bi-book"></i><span>Your Booking</span>
        </a>

      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->is('user-vehicles') || request()->is('user-vehicles/*') ? 'active' : 'collapsed' }}" href="/user-vehicles">
          <i class="bi bi-car-front"></i><span>Your Vehicles</span>
        </a>

      </li>


      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="#">
          <i class="bi bi-journal-text"></i><span>Profile</span>
        </a>

      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Settings</span>
        </a>
      </li> --}}
  </aside>
