{{-- resources/views/components/navbar.blade.php --}}

{{-- 1. Desktop Navbar (FIXED TOP) - HANYA Muncul di layar Besar (lg dan lebih besar) --}}
<nav class="navbar navbar-expand-lg fixed-top navbar-custom d-none d-lg-block" id="desktopNav">
    <div class="container">
        <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-hospital-fill me-2 fs-4"></i>
            <span style="font-size: 1.15rem; letter-spacing: -0.3px;">RS Baladhika Husada</span>
        </a>

        <div class="ms-auto d-flex align-items-center">
            <ul class="navbar-nav mb-0">
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('informasi') ? 'active' : '' }}" href="{{ route('informasi') }}">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('berita') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link-custom dropdown-toggle {{ request()->routeIs(['ppid', 'zona', 'komplain']) ? 'active' : '' }}" href="#" role="button">
                        Layanan
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item nav-link-custom-sub {{ request()->routeIs('ppid') ? 'active' : '' }}" href="{{ route('ppid') }}">PPID</a></li>
                        <li><a class="dropdown-item nav-link-custom-sub {{ request()->routeIs('zona') ? 'active' : '' }}" href="{{ route('zona') }}">Zona Integritas</a></li>
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li><a class="dropdown-item nav-link-custom-sub {{ request()->routeIs('komplain') ? 'active' : '' }}" href="{{ route('komplain') }}">Komplain</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- 2. Mobile Navbar (Fixed Bottom) --}}
<nav class="fixed-bottom d-lg-none bg-white border-top shadow-lg" style="z-index: 1030;">
    <div class="d-flex justify-content-around w-100">
        
        <a class="nav-link-mobile {{ request()->routeIs('home') ? 'active-mobile' : '' }}" href="{{ route('home') }}">
            <i class="bi bi-house-door-fill"></i>
            <span class="small d-block">Beranda</span>
        </a>
        
        <a class="nav-link-mobile {{ request()->routeIs('informasi') ? 'active-mobile' : '' }}" href="{{ route('informasi') }}">
            <i class="bi bi-info-circle-fill"></i>
            <span class="small d-block">Info</span>
        </a>
        
        <a class="nav-link-mobile {{ request()->routeIs('jadwal') ? 'active-mobile' : '' }}" href="{{ route('jadwal') }}">
            <i class="bi bi-calendar-check-fill"></i>
            <span class="small d-block">Jadwal</span>
        </a>
        
        <a class="nav-link-mobile {{ request()->routeIs('ppid') ? 'active-mobile' : '' }}" href="{{ route('ppid') }}">
            <i class="bi bi-file-earmark-lock-fill"></i>
            <span class="small d-block">PPID</span>
        </a>
        
        <a class="nav-link-mobile {{ request()->routeIs('komplain') ? 'active-mobile' : '' }}" href="{{ route('komplain') }}">
            <i class="bi bi-chat-right-text-fill"></i>
            <span class="small d-block">Komplain</span>
        </a>
    </div>
</nav>