{{-- 1. Desktop Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2 shadow-sm d-none d-lg-block border-bottom" style="z-index: 1100;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center me-3" href="{{ route('home') }}">
                    <div class="lh-1 border-end pe-3">
                        <span class="text-success d-block fw-black" style="font-size: 1.3rem; letter-spacing: -0.8px; font-weight: 900 !important; filter: drop-shadow(0 1px 1px rgba(0,0,0,0.1));">RS Tk. III Baladhika Husada</span>
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
                            <li><a class="dropdown-item rounded-2" href="{{ route('informasi') }}">Profil Singkat</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('dokter') }}">Dokter RS</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('tidur') }}">Ketersediaan Tempat Tidur</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown">Jadwal</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3">
                            <li><a class="dropdown-item rounded-2" href="{{ route('jadwal') }}">Jadwal Dokter</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('jadwaloperasi') }}">Jadwal Operasi</a></li>
                        </ul>
                    </li>

                    
                    {{-- MENU LAYANAN --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2 {{ (request()->is('siterbat*') || request()->is('ambulance*') || request()->is('dashboard-indikator*')) ? 'text-success active' : '' }}" href="#" data-bs-toggle="dropdown">Layanan</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3" style="min-width: 250px;">
                            <li><a class="dropdown-item rounded-2" href="{{ route('ppid') }}">PPID</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('zona') }}">Zona Integritas</a></li>
                            
                            <li><hr class="dropdown-divider opacity-50"></li>
                            
                            {{-- NESTED DROPDOWN SIGAP --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item rounded-2 py-2 fw-bold text-success d-flex justify-content-between align-items-center" href="#">
                                    <span><i class="bi bi-lightning-fill me-2"></i>SIGAP</span>
                                    <i class="bi bi-chevron-right small"></i>
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg p-2 rounded-3">
                                    <li><a class="dropdown-item rounded-2 py-2 {{ request()->routeIs('siterbat') ? 'bg-success text-white' : '' }}" href="{{ route('siterbat') }}">
                                        <i class="bi bi-bicycle me-2"></i>Siterbat
                                    </a></li>
                                    <li><a class="dropdown-item rounded-2 py-2 {{ request()->routeIs('ambulance') ? 'bg-danger text-white' : '' }}" href="{{ route('ambulance') }}">
                                        <i class="bi bi-truck me-2"></i>Ambulan
                                    </a></li>
                                    <li><a class="dropdown-item rounded-2 py-2 {{ request()->routeIs('dashboard-indikator') ? 'bg-info bg-opacity-10 text-dark fw-bold' : '' }}" href="{{ route('dashboard-indikator') }}">
                                        <i class="bi bi-graph-up-arrow me-2 text-info"></i>Dashboard
                                    </a></li>
                                </ul>
                            </li>

                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li><a class="dropdown-item rounded-2 text-danger fw-bold" href="{{ route('komplain') }}">Komplain / Aduan</a></li>
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
        
        {{-- SIGAP MOBILE --}}
        <a class="nav-link-mobile {{ (request()->is('siterbat*') || request()->is('ambulance*') || request()->is('dashboard-indikator*')) ? 'active-mobile' : '' }}" href="#" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 42px; height: 42px; margin-top: -20px; border: 4px solid white;">
                <i class="bi bi-lightning-fill fs-5"></i>
            </div>
            <span class="d-block mt-1 fw-bold" style="font-size: 0.65rem;">SIGAP</span>
        </a>

        <a class="nav-link-mobile {{ request()->routeIs('kontak') ? 'active-mobile' : '' }}" href="{{ route('kontak') }}">
            <i class="bi bi-whatsapp fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Kontak</span>
        </a>
        <button class="nav-link-mobile border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas">
            <i class="bi bi-grid-fill fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Lainnya</span>
        </button>
    </div>
</nav>

{{-- Mobile Offcanvas Bottom Menu --}}
<div class="offcanvas offcanvas-bottom rounded-top-4 shadow-lg border-0" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuLabel" style="height: auto; max-height: 85vh;">
    <div class="offcanvas-header border-bottom px-4 pt-4 pb-3">
        <h5 class="offcanvas-title fw-bold text-success d-flex align-items-center" id="mobileMenuLabel">
            <i class="bi bi-grid-fill me-2 fs-4"></i> Menu Utama
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4 pt-1 small">
        <p class="text-muted mb-4 mt-3 fw-medium" style="font-size: 0.8rem;">Jelajahi seluruh layanan dan informasi Rumah Sakit.</p>
        
        <div class="row g-4 text-center">
            <!-- Informasi / Profil -->
            <div class="col-4">
                <a href="{{ route('informasi') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-info-circle fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">Profil</span>
                </a>
            </div>
            <!-- Dokter RS -->
            <div class="col-4">
                <a href="{{ route('dokter') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-person-badge fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">Dokter RS</span>
                </a>
            </div>
            <!-- Kamar -->
            <div class="col-4">
                <a href="{{ route('tidur') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-hospital fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">Kamar Bed</span>
                </a>
            </div>
            <!-- Jadwal Operasi -->
            <div class="col-4">
                <a href="{{ route('jadwaloperasi') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-heart-pulse fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">Op. Jadwal</span>
                </a>
            </div>
            <!-- PPID -->
            <div class="col-4">
                <a href="{{ route('ppid') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">PPID</span>
                </a>
            </div>
            <!-- SIGAP SECTION -->
            <div class="col-12 mt-4">
                <div class="p-3 bg-success bg-opacity-10 rounded-4">
                    <h6 class="fw-bold text-success mb-3 d-flex align-items-center">
                        <i class="bi bi-lightning-fill me-2"></i> LAYANAN SIGAP
                    </h6>
                    <div class="row g-3">
                        <div class="col-4">
                            <a href="{{ route('siterbat') }}" class="text-decoration-none text-dark d-block">
                                <div class="p-2 bg-white rounded-3 mb-1 mx-auto d-flex align-items-center justify-content-center text-success shadow-sm" style="width: 45px; height: 45px;">
                                    <i class="bi bi-bicycle fs-4"></i>
                                </div>
                                <span style="font-size: 0.65rem;">Siterbat</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('ambulance') }}" class="text-decoration-none text-dark d-block">
                                <div class="p-2 bg-white rounded-3 mb-1 mx-auto d-flex align-items-center justify-content-center text-danger shadow-sm" style="width: 45px; height: 45px;">
                                    <i class="bi bi-truck fs-4"></i>
                                </div>
                                <span style="font-size: 0.65rem;">Ambulan</span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('dashboard-indikator') }}" class="text-decoration-none text-dark d-block">
                                <div class="p-2 bg-white rounded-3 mb-1 mx-auto d-flex align-items-center justify-content-center text-info shadow-sm" style="width: 45px; height: 45px;">
                                    <i class="bi bi-graph-up-arrow fs-4"></i>
                                </div>
                                <span style="font-size: 0.65rem;">Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Zona Integritas -->
            <div class="col-4">
                <a href="{{ route('zona') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-light rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px;">
                        <i class="bi bi-award fs-3"></i>
                    </div>
                    <span class="fw-medium" style="font-size: 0.75rem;">Zona Intg.</span>
                </a>
            </div>
            <!-- Aduan -->
            <div class="col-4">
                <a href="{{ route('komplain') }}" class="text-decoration-none text-dark d-block hover-shadow-menu">
                    <div class="p-3 bg-danger bg-opacity-10 rounded-4 mb-2 mx-auto d-flex align-items-center justify-content-center text-danger" style="width: 55px; height: 55px;">
                        <i class="bi bi-chat-right-text fs-3"></i>
                    </div>
                    <span class="fw-bold text-danger" style="font-size: 0.75rem;">Aduan</span>
                </a>
            </div>
        </div>
        
        <div class="mt-4 pb-2 text-center">
            <button type="button" class="btn btn-outline-success rounded-pill px-4 btn-sm fw-bold" data-bs-dismiss="offcanvas">Tutup Menu</button>
        </div>
    </div>
</div>

{{-- Spacer agar konten tidak tertutup navbar yang melayang (Desktop Only) --}}
<div class="d-none d-lg-block bg-white" style="height: 75px;"></div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .hover-shadow:hover { 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2) !important;
    }
    .hover-shadow-menu > div { transition: all 0.2s ease; }
    .hover-shadow-menu:active > div { 
        transform: scale(0.92);
        background-color: #e6fced !important;
    }
    .nav-link { color: #4a4a4a !important; }
    .nav-link:hover, .nav-link.active { color: #198754 !important; }
    
    .nav-link-mobile {
        text-align: center;
        text-decoration: none;
        color: #6c757d;
        flex: 1;
        cursor: pointer;
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

    /* NESTED DROPDOWN SIGAP */
    @media (min-width: 992px) {
        .dropdown-submenu { position: relative; }
        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -10px;
            margin-left: 5px;
            display: none;
            min-width: 180px;
        }
        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }
    }
</style>