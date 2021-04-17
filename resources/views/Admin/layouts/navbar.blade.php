<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                <i data-feather="align-justify"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
            </a>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <span class="text-dark"> Hello! {{ auth()->user()->name}} </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">

                <a href="{{ auth()->user()->role === 'Admin' ? route('profile'):route('emp-profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
