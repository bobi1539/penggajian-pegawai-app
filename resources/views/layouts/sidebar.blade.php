<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('groups') ? 'active' : '' }}" href="/groups">
                    <span data-feather="bar-chart"></span>
                    Golongan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('positions') ? 'active' : '' }}" href="/positions">
                    <span data-feather="bar-chart-2"></span>
                    Jabatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('employees*') ? 'active' : '' }}" href="/employees">
                    <span data-feather="users"></span>
                    Pegawai
                </a>
            </li>
        </ul>
    </div>
</nav>
