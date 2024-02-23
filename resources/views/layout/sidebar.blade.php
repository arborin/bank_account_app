<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/*') ? 'active' : '' }}" href="{{ route('dashboard-info') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('account/*') ? 'active' : '' }}" href="{{ route('accounts.index') }}">
                <i class="ri-contacts-line"></i>
                <span>Accounts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('payment/*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Payments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('user/*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
