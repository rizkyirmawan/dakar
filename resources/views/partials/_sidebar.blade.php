<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dasbor.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DAKAR <sup>ALPHA</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(auth() && auth()->user()->role == 'Admin')
    <li class="nav-item {{ Request::segment(1) === 'dasbor' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dasbor.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dasbor</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item {{ Request::segment(1) === 'master' ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseMaster"
            aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-archive"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMaster" class="collapse {{ Request::segment(1) === 'master' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(1) === 'master' && Request::segment(2) === 'bank' ? 'active' : '' }}" href="{{ route('bank.index') }}">Bank</a>
                <a class="collapse-item {{ Request::segment(1) === 'master' && Request::segment(2) === 'bagian' ? 'active' : '' }}" href="{{ route('bagian.index') }}">Bagian</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Input Data
    </div>

    <li class="nav-item {{ Request::segment(1) === 'input' ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseInput"
            aria-expanded="true" aria-controls="collapseInput">
            <i class="fas fa-fw fa-edit"></i>
            <span>Input Data</span>
        </a>
        <div id="collapseInput" class="collapse {{ Request::segment(1) === 'input' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'karyawan' ? 'active' : '' }}" href="{{ route('karyawan.index') }}">Data Karyawan</a>
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'absensi' ? 'active' : '' }}" href="{{ route('absensiKaryawan.index') }}">Data Absensi</a>
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'slip-gaji' ? 'active' : '' }}" href="{{ route('slipGaji.index') }}">Slip Gaji</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan Data
    </div>

    <li class="nav-item {{ Request::segment(1) === 'laporan' ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan Data</span>
        </a>
        <div id="collapseLaporan" class="collapse {{ Request::segment(1) === 'laporan' ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'karyawan' ? 'active' : '' }}" href="{{ route('karyawan.indexLaporan') }}">Laporan Karyawan</a>
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'absensi' ? 'active' : '' }}" href="{{ route('absensi.indexLaporan') }}">Laporan Absensi</a>
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'slip-gaji' ? 'active' : '' }}" href="{{ route('slipGaji.indexLaporan') }}">Laporan Slip Gaji</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth() && auth()->user()->role == 'SO')
    <li class="nav-item {{ Request::segment(1) === 'dasbor' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dasbor.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dasbor</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Input Data
    </div>

    <li class="nav-item {{ Request::segment(1) === 'input' ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseInput"
            aria-expanded="true" aria-controls="collapseInput">
            <i class="fas fa-fw fa-edit"></i>
            <span>Input Data</span>
        </a>
        <div id="collapseInput" class="collapse {{ Request::segment(1) === 'input' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'karyawan' ? 'active' : '' }}" href="{{ route('karyawan.index') }}">Data Karyawan</a>
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'absensi' ? 'active' : '' }}" href="{{ route('absensiKaryawan.index') }}">Data Absensi</a>
                <a class="collapse-item {{ Request::segment(1) === 'input' && Request::segment(2) === 'slip-gaji' ? 'active' : '' }}" href="{{ route('slipGaji.index') }}">Slip Gaji</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth() && auth()->user()->role == 'BM')
    <li class="nav-item {{ Request::segment(1) === 'dasbor' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dasbor.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dasbor</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan Data
    </div>

    <li class="nav-item {{ Request::segment(1) === 'laporan' ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan Data</span>
        </a>
        <div id="collapseLaporan" class="collapse {{ Request::segment(1) === 'laporan' ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'karyawan' ? 'active' : '' }}" href="{{ route('karyawan.indexLaporan') }}">Laporan Karyawan</a>
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'absensi' ? 'active' : '' }}" href="{{ route('absensi.indexLaporan') }}">Laporan Absensi</a>
                <a class="collapse-item {{ Request::segment(1) === 'laporan' && Request::segment(2) === 'slip-gaji' ? 'active' : '' }}" href="{{ route('slipGaji.indexLaporan') }}">Laporan Slip Gaji</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth() && auth()->user()->role == 'CO')
    <li class="nav-item {{ Request::segment(1) === 'dasbor' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dasbor.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Slip Gaji
    </div>

    <li class="nav-item {{ Request::segment(2) === 'slip-gaji' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('slipGaji.indexKaryawan') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Slip Gaji</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->