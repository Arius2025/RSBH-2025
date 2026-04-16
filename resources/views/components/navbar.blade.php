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
                        <a class="nav-link dropdown-toggle px-2 {{ (request()->is('siterbat*') || request()->is('ambulance*') || request()->is('dashboard-indikator*')) ? 'text-success' : '' }}" href="#" data-bs-toggle="dropdown">Layanan</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3" style="min-width: 250px;">
                            <li><a class="dropdown-item rounded-2" href="{{ route('ppid') }}">PPID</a></li>
                            <li><a class="dropdown-item rounded-2" href="{{ route('zona') }}">Zona Integritas</a></li>
                            
                 
                    
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li><a class="dropdown-item rounded-2 text-danger fw-bold" href="{{ route('komplain') }}">Komplain / Aduan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown"><span class="fw-bold text-success"><i class="bi bi-lightning-fill me-2 "></i>SIGAP</span></a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-3">
                            <li><a class="dropdown-item rounded-2 text-success" href="{{ route('siterbat') }}"><i class="bi bi-bicycle me-2"></i>SITERBAT</a></li>
                            <li><a class="dropdown-item rounded-2 text-danger" href="{{ route('ambulance') }}"> <i class="bi bi-truck me-2"></i>AMBULAN</a></li>
                            <li><a class="dropdown-item rounded-2 text-info" href="{{ route('dashboard-indikator') }}"><i class="bi bi-graph-up-arrow me-2 text-info"></i>DASHBOARD INDIKATOR</a></li>
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
        <a class="nav-link-mobile {{ (request()->is('siterbat*') || request()->is('ambulance*') || request()->is('dashboard-indikator*')) ? 'active-mobile' : '' }}" href="javascript:void(0)" onclick="toggleSigapMenu()">
            <div id="sigapTrigger" class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow transition-all" style="width: 42px; height: 42px; margin-top: -20px; border: 4px solid white;">
                <i class="bi bi-lightning-fill fs-5"></i>
            </div>
            <span class="d-block mt-1 fw-bold" style="font-size: 0.65rem;">SIGAP</span>
        </a>

        <a class="nav-link-mobile {{ request()->routeIs('kontak') ? 'active-mobile' : '' }}" href="{{ route('kontak') }}">
            <i class="bi bi-whatsapp fs-5"></i>
            <span class="d-block" style="font-size: 0.65rem;">Kontak</span>
        </a>
        <button class="nav-link-mobile border-0 bg-transparent" type="button" onclick="toggleOthersMenu()">
            <div id="othersTrigger" class="transition-all">
                <i class="bi bi-grid-fill fs-5"></i>
            </div>
            <span class="d-block" style="font-size: 0.65rem;">Lainnya</span>
        </button>
    </div>
</nav>


{{-- SIGAP CUSTOM FLOATING MENU (MOBILE) --}}
<div id="sigapBackdrop" class="sigap-backdrop" onclick="closeAllMenus()"></div>

<div id="sigapQuickMenu" class="sigap-quick-popup">
    <div class="sigap-popup-header mb-3 stagger-1">
        <h6 class="fw-bold text-white mb-0 text-shadow-sm"><i class="bi bi-lightning-fill me-2"></i> LAYANAN SIGAP</h6>
    </div>
    <div class="d-flex justify-content-around align-items-center">
        <a href="{{ route('siterbat') }}" class="sigap-pop-item stagger-2">
            <div class="icon-wrap bg-success"><i class="bi bi-bicycle"></i></div>
            <span>Siterbat</span>
        </a>
        <a href="{{ route('ambulance') }}" class="sigap-pop-item stagger-3">
            <div class="icon-wrap bg-danger"><i class="bi bi-truck"></i></div>
            <span>Ambulan</span>
        </a>
        <a href="{{ route('dashboard-indikator') }}" class="sigap-pop-item stagger-4">
            <div class="icon-wrap bg-info"><i class="bi bi-graph-up-arrow"></i></div>
            <span>Indikator</span>
        </a>
    </div>
</div>

{{-- OTHERS (LAINNYA) CUSTOM FLOATING MENU --}}
<div id="othersQuickMenu" class="sigap-quick-popup" style="bottom: 85px;">
    <div class="sigap-popup-header mb-4 stagger-1">
        <h6 class="fw-bold text-white mb-0 text-shadow-sm"><i class="bi bi-grid-fill me-2"></i> MENU UTAMA</h6>
    </div>
    <div class="row g-4 justify-content-center px-2">
        <div class="col-4">
            <a href="{{ route('informasi') }}" class="sigap-pop-item stagger-2">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-info-circle"></i></div>
                <span>Profil</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('dokter') }}" class="sigap-pop-item stagger-2">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-person-badge"></i></div>
                <span>Dokter</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('tidur') }}" class="sigap-pop-item stagger-3">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-hospital"></i></div>
                <span>Kamar</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('jadwaloperasi') }}" class="sigap-pop-item stagger-3">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-heart-pulse"></i></div>
                <span>Op. Jadwal</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('ppid') }}" class="sigap-pop-item stagger-4">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-shield-check"></i></div>
                <span>PPID</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('zona') }}" class="sigap-pop-item stagger-4">
                <div class="icon-wrap bg-white text-success"><i class="bi bi-award"></i></div>
                <span>Zona</span>
            </a>
        </div>
        <div class="col-12 mt-4">
            <a href="{{ route('komplain') }}" class="sigap-pop-item stagger-5">
                <div class="icon-wrap bg-danger text-white mx-auto" style="width: 140px; height: 50px; border-radius: 15px;">
                    <i class="bi bi-chat-right-text me-2 fs-5"></i> ADUAN
                </div>
            </a>
        </div>
    </div>
</div>

{{-- Spacer agar konten tidak tertutup navbar yang melayang (Desktop Only) --}}
<div class="d-none d-lg-block bg-white" style="height: 75px;"></div>

<style>
    /* SIGAP POPUP STYLES */
    .sigap-backdrop {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4); backdrop-filter: blur(4px);
        z-index: 1090; display: none; opacity: 0; transition: opacity 0.3s ease;
    }
    .sigap-quick-popup {
        position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%) translateY(40px);
        width: 100%; max-width: 380px; z-index: 1100;
        display: none; opacity: 0; transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-align: center; pointer-events: none;
    }
    .sigap-quick-popup.active { display: block; opacity: 1; transform: translateX(-50%) translateY(0); pointer-events: auto; }
    .sigap-backdrop.active { display: block; opacity: 1; }

    /* Staggered Animations */
    .sigap-pop-item { text-decoration: none; color: white !important; display: block; opacity: 0; transform: translateY(20px); transition: all 0.4s ease-out; }
    .sigap-popup-header { opacity: 0; transform: translateY(10px); transition: all 0.4s ease-out; }

    .active .stagger-1 { opacity: 1; transform: translateY(0); transition-delay: 0.1s; }
    .active .stagger-2 { opacity: 1; transform: translateY(0); transition-delay: 0.2s; }
    .active .stagger-3 { opacity: 1; transform: translateY(0); transition-delay: 0.3s; }
    .active .stagger-4 { opacity: 1; transform: translateY(0); transition-delay: 0.4s; }
    .active .stagger-5 { opacity: 1; transform: translateY(0); transition-delay: 0.5s; }

    .sigap-pop-item .icon-wrap {
        width: 60px; height: 60px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 8px; font-size: 1.6rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0.3);
        transition: transform 0.2s ease;
    }
    .sigap-pop-item:active .icon-wrap { transform: scale(0.9); }
    .sigap-pop-item span { font-size: 0.75rem; font-weight: bold; text-shadow: 1px 1px 4px rgba(0,0,0,0.5); }
    
    .text-shadow-sm { text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
    
    .transition-all { transition: all 0.3s ease; }
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

    /* Fix footer covered by dock */
    @media (max-width: 991.98px) {
        body { padding-bottom: 85px !important; }
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

<script>
    function toggleSigapMenu() {
        closeOthers('sigapQuickMenu');
        const menu = document.getElementById('sigapQuickMenu');
        const backdrop = document.getElementById('sigapBackdrop');
        const trigger = document.getElementById('sigapTrigger');
        
        if (menu.classList.contains('active')) {
            menu.classList.remove('active');
            backdrop.classList.remove('active');
            trigger.style.transform = 'scale(1) rotate(0deg)';
        } else {
            menu.classList.add('active');
            backdrop.classList.add('active');
            trigger.style.transform = 'scale(0.9) rotate(45deg)';
        }
    }

    function toggleOthersMenu() {
        closeOthers('othersQuickMenu');
        const menu = document.getElementById('othersQuickMenu');
        const backdrop = document.getElementById('sigapBackdrop');
        const trigger = document.getElementById('othersTrigger');
        
        if (trigger) {
            if (menu.classList.contains('active')) {
                menu.classList.remove('active');
                backdrop.classList.remove('active');
                trigger.style.transform = 'scale(1)';
            } else {
                menu.classList.add('active');
                backdrop.classList.add('active');
                trigger.style.transform = 'scale(0.8)';
            }
        }
    }

    function closeOthers(except) {
        ['sigapQuickMenu', 'othersQuickMenu'].forEach(id => {
            const el = document.getElementById(id);
            if (el && id !== except) {
                el.classList.remove('active');
            }
        });
        if (except === 'none') {
            document.getElementById('sigapBackdrop').classList.remove('active');
            const sigapTrigger = document.getElementById('sigapTrigger');
            const othersTrigger = document.getElementById('othersTrigger');
            if(sigapTrigger) sigapTrigger.style.transform = 'scale(1) rotate(0deg)';
            if(othersTrigger) othersTrigger.style.transform = 'scale(1)';
        }
    }

    function closeAllMenus() {
        closeOthers('none');
    }
</script>