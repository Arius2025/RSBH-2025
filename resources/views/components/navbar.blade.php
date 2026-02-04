{{-- 1. Desktop Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2 shadow-sm d-none d-lg-block border-bottom" style="z-index: 1100;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between w-100">
            {{-- KIRI: Nama RS & Logo --}}
            <div class="d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center me-3" href="{{ route('home') }}">
                    <div class="lh-1 border-end pe-3">
                        <span class="fw-bold text-success d-block" style="font-size: 1.2rem; letter-spacing: -0.5px;">RS Baladhika Husada</span>
                        <small class="text-muted fw-bold" style="font-size: 0.6rem; letter-spacing: 1px;">HESTI WIRA SAKTI</small>
                    </div>
                </a>
                <div class="ps-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; width: auto; object-fit: contain;">
                </div>
            </div>

            {{-- KANAN: Menu --}}
            <div class="d-flex align-items-center">
                <ul class="navbar-nav fw-semibold gap-1 me-4">
                    <li class="nav-item">
                        <a class="nav-link px-2 {{ request()->routeIs('home') ? 'text-success active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown">Informasi</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3">
                            <li><a class="dropdown-item rounded-2" href="{{ route('informasi') }}">Visi & Misi</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('tidur') }}">Ketersedian Tempat Tidur</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown">Jadwal</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3">
                            <li><a class="dropdown-item rounded-2" href="{{ route('jadwal') }}">Jadwal Dokter</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('jadwaloperasi') }}">Jadwal Operasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item border-end pe-2 me-1">
                        <a class="nav-link px-2 {{ request()->routeIs('berita') ? 'text-success active' : '' }}" href="{{ route('berita') }}">Berita</a>
                    </li>
                    
                    {{-- MENU LAYANAN --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2 {{ request()->routeIs('siterbat') ? 'text-success active' : '' }}" href="#" data-bs-toggle="dropdown">Layanan</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3">
                            <li><a class="dropdown-item rounded-2" href="{{ route('ppid') }}">PPID</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('zona') }}">Zona Integritas</a></li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li><a class="dropdown-item rounded-2 text-danger fw-bold" href="{{ route('komplain') }}">Komplain</a></li>
                            
                            {{-- SITERBAT: Ikon Sepeda Listrik & Penanda PENTING --}}
                            <li>
                                <a class="dropdown-item rounded-2 fw-bold text-success d-flex justify-content-between align-items-center py-2" href="{{ route('siterbat') }}">
                                    <span><i class="bi bi-bicycle me-2"></i>SITERBAT</span>
                                    <span class="badge rounded-pill bg-primary ms-2" style="font-size: 0.55rem;">PENTING</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <a href="{{ route('kontak') }}" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold d-flex align-items-center py-2 transition-all hover-shadow">
                    <i class="bi bi-whatsapp me-2 fs-5"></i> KONTAK
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- 2. Mobile Bottom Nav --}}
<nav class="fixed-bottom d-lg-none bg-white border-top shadow-lg" style="z-index: 1100; height: 65px;">
    <div class="d-flex justify-content-around align-items-center h-100">
        <a class="nav-link-mobile {{ request()->routeIs('home') ? 'active-mobile' : '' }}" href="{{ route('home') }}">
            <i class="bi bi-house-door{{ request()->routeIs('home') ? '-fill' : '' }} fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Beranda</span>
        </a>
        <a class="nav-link-mobile {{ request()->routeIs('jadwal') ? 'active-mobile' : '' }}" href="{{ route('jadwal') }}">
            <i class="bi bi-calendar-check{{ request()->routeIs('jadwal') ? '-fill' : '' }} fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Jadwal</span>
        </a>
        
        {{-- SITERBAT MOBILE: Ikon Sepeda Listrik --}}
        <a class="nav-link-mobile {{ request()->routeIs('siterbat') ? 'active-mobile' : '' }}" href="{{ route('siterbat') }}">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 42px; height: 42px; margin-top: -20px; border: 4px solid white;">
                <i class="bi bi-bicycle fs-5"></i>
            </div>
            <span class="d-block mt-1 fw-bold" style="font-size: 0.65rem;">Siterbat</span>
        </a>

        <a class="nav-link-mobile {{ request()->routeIs('kontak') ? 'active-mobile' : '' }}" href="{{ route('kontak') }}">
            <i class="bi bi-whatsapp fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Kontak</span>
        </a>
        <a class="nav-link-mobile {{ request()->routeIs('komplain') ? 'active-mobile' : '' }}" href="{{ route('komplain') }}">
            <i class="bi bi-chat-right-text{{ request()->routeIs('komplain') ? '-fill' : '' }} fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Aduan</span>
        </a>
    </div>
</nav>

{{-- Spacer agar konten tidak tertutup navbar yang melayang --}}
<div class="d-none d-lg-block" style="height: 80px;"></div>
<div class="d-lg-none" style="height: 60px;"></div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .hover-shadow:hover { 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2) !important;
    }
    .nav-link { color: #4a4a4a !important; }
    .nav-link:hover, .nav-link.active { color: #198754 !important; }
    
    .nav-link-mobile {
        text-align: center;
        text-decoration: none;
        color: #6c757d;
        flex: 1;
    }
    .active-mobile { 
        color: #198754 !important; 
        font-weight: bold;
    }
    
    .dropdown-menu { 
        animation: slideIn 0.3s ease-out; 
        border-radius: 12px;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>