<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow">
            <div class="nav-link dropdown-toggle">
                @if(auth()->user()->role == 'Admin')
                    <span class="badge badge-info d-none d-lg-inline small">Administrator</span>
                @elseif(auth()->user()->role == 'CO')
                    <span class="badge badge-info d-none d-lg-inline small">Community Officer</span>
                @elseif(auth()->user()->role == 'SO')
                    <span class="badge badge-info d-none d-lg-inline small">Senior Officer</span>
                @elseif(auth()->user()->role == 'BM')
                    <span class="badge badge-info d-none d-lg-inline small">Business Manager</span>
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->role == 'Admin' ? 'Administrator' : auth()->user()->userable->nama }}</span>
                @if(auth()->user()->role != 'Admin' && auth()->user()->userable->foto)
                    <img class="img-profile rounded-circle" src="{{ asset('storage/' . auth()->user()->userable->foto) }}">
                @else
                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('auth.editPassword') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Update Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->