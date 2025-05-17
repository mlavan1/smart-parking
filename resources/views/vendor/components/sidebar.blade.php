<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="/home">
                <i class="bi bi-grid"></i>
                <span>Vendor Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-4">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" href="{{ route('vendor.lots') }}">
                <i class="bi bi-building"></i><span>Parking lots</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{ route('vendor.slots') }}">
                <i class="bi bi-menu-button-wide"></i><span>Parking slots</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" href="{{ route('vendor.bookings') }}">
                <i class="bi bi-layout-text-window-reverse"></i><span>Bookings</span>
            </a>
        </li>
</aside>
