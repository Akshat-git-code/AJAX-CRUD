<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"> <span
                class="logo-name">Emp Mang</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown active">
                <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="home"></i> <span>Dashboard</span></a>
            </li>

            @if (auth()->user()->role === "Admin")
                <li class="dropdown">
                    <a href="{{ route('user.index') }}" class="nav-link"><i data-feather="user"></i> <span>Employee</span></a>
                </li>
            @endif

        </ul>
    </aside>
</div>
