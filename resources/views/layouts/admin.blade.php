{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard | {{ config('app.name', 'RS Baladhika Husada') }}</title>

    {{-- Bootstrap CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/dkt.png') }}?v={{ time() }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/dkt.png') }}?v={{ time() }}" type="image/png">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Custom Stylesheet untuk Admin --}}
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #198754;
            --primary-dark: #115c39;
            --primary-light: #e8f5e9;
            --light-bg: #f4f7f5; 
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --bottom-nav-height: 70px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--light-bg); 
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            padding-top: 64px;
            margin: 0;
            color: #1e293b;
        }
        
        /* Top Navbar */
        .admin-navbar {
            height: 64px;
            background: #ffffff !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(10px);
            z-index: 1040;
        }

        /* Sidebar Styles (Desktop Only) */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 74px; 
            background: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, 0.06);
            transition: var(--transition);
        }

        /* Sidebar Nav Link Styles */
        .sidebar .nav-link {
            color: #64748b;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 10px 16px;
            margin: 3px 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
            margin-right: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
            transform: translateX(3px);
        }

        /* Active Sidebar Link Style */
        .sidebar .nav-link.active-admin {
            background-color: var(--primary-color);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25);
        }

        .sidebar .nav-link.active-admin i {
            color: #ffffff;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 28px 32px;
            transition: var(--transition);
            min-height: calc(100vh - 64px);
        }

        /* ========================================= */
        /* MOBILE STYLES & CLEAN FLOATING DOCK       */
        /* ========================================= */
        
        @media (max-width: 991.98px) {
            .sidebar {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px;
                padding-bottom: calc(var(--bottom-nav-height) + 30px); 
            }
        }
        
        /* Modern Mobile Bottom Dock */
        .mobile-dock-container {
            position: fixed;
            bottom: 12px;
            left: 12px;
            right: 12px;
            z-index: 1050;
            pointer-events: none;
        }

        .mobile-dock {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(25, 135, 84, 0.12);
            border-radius: 24px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12), 0 2px 6px rgba(25, 135, 84, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 6px 8px;
            margin: 0 auto;
            max-width: 500px;
        }
        
        .dock-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #64748b;
            padding: 6px 10px;
            border-radius: 16px;
            transition: var(--transition);
            flex: 1;
            min-width: 0;
            position: relative;
        }

        .dock-item i {
            font-size: 1.25rem;
            line-height: 1;
            margin-bottom: 3px;
            transition: var(--transition);
        }

        .dock-item span {
            font-size: 0.68rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .dock-item:hover, .dock-item:focus {
            color: var(--primary-color);
        }

        .dock-item.active {
            color: var(--primary-color);
            background: rgba(25, 135, 84, 0.08);
        }

        .dock-item.active i {
            transform: translateY(-2px);
        }

        .dock-item-btn {
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        /* User Profile Pill in Top Bar */
        .user-pill {
            background: rgba(25, 135, 84, 0.06);
            border: 1px solid rgba(25, 135, 84, 0.12);
            padding: 6px 14px;
            border-radius: 30px;
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            text-decoration: none;
        }

        .user-pill:hover {
            background: rgba(25, 135, 84, 0.12);
            color: var(--primary-dark);
        }
    </style>
        
    <!-- Author Attribution & SEO Metadata -->
    <meta name="author" content="Risang Putra Pradana">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => config('app.name', 'RS Baladhika Husada'),
        'url' => config('app.url', 'http://localhost'),
        'author' => [
            '@type' => 'Person',
            'name' => 'Risang Putra Pradana',
            'email' => 'risangputra144@gmail.com',
            'jobTitle' => 'Full-stack Web Developer'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body>
    
    {{-- Top Navbar (Fixed Top) --}}
    <nav class="navbar navbar-expand-lg admin-navbar fixed-top">
        <div class="container-fluid px-3 px-lg-4">
            
            {{-- Brand Logo --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo" style="height: 38px; width: auto; object-fit: contain;" class="me-2">
                <div class="d-flex flex-column">
                    <span class="fw-bold text-success fs-6 lh-1">RS Baladhika Husada</span>
                    <span class="text-muted small lh-1 mt-1" style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.5px;">ADMIN CONSOLE</span>
                </div>
            </a>

            {{-- Right Menu Actions --}}
            <div class="d-flex align-items-center gap-2 ms-auto">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 d-none d-sm-inline-flex align-items-center gap-1 font-monospace" style="font-size: 0.78rem;">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Situs
                </a>

                {{-- User Dropdown --}}
                <div class="dropdown">
                    <a href="#" class="user-pill dropdown-toggle text-decoration-none" id="userMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-6 text-success"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 p-2 mt-2" aria-labelledby="userMenuDropdown" style="min-width: 210px;">
                        <li class="px-3 py-2 border-bottom mb-1">
                            <p class="mb-0 fw-bold small text-dark">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="mb-0 text-muted" style="font-size: 0.72rem;">{{ Auth::user()->email ?? 'admin@rsbh.com' }}</p>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 small fw-medium" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2 text-success"></i> Pengaturan Profil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 small fw-medium" href="{{ route('home') }}" target="_blank">
                                <i class="bi bi-globe me-2 text-success"></i> Kunjungi Web Publik
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item rounded-3 py-2 small fw-semibold text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- Sidebar (Desktop Menu) --}}
    <div class="d-none d-lg-block">
        @include('admin.components.sidebar')
    </div>

    {{-- Main Content Area --}}
    <div class="main-content">
        @yield('content')
    </div>

    {{-- FLOATING BOTTOM DOCK (Mobile Only) --}}
    <div class="mobile-dock-container d-lg-none">
        <div class="mobile-dock">
            
            {{-- Dashboard --}}
            <a class="dock-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
               href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid-fill"></i>
                <span>Beranda</span>
            </a>
            
            {{-- Kelola Jadwal --}}
            <a class="dock-item {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}" 
               href="{{ route('admin.jadwal.index') }}">
                <i class="bi bi-calendar-event-fill"></i>
                <span>Jadwal</span>
            </a>

            {{-- Dokumen PPID --}}
            <a class="dock-item {{ request()->routeIs('admin.dokumen.*') || request()->routeIs('admin.documents.*') ? 'active' : '' }}" 
               href="{{ route('admin.documents.index') }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Dokumen</span>
            </a>
            
            {{-- Permohonan --}}
            <a class="dock-item {{ request()->routeIs('admin.permohonan.*') ? 'active' : '' }}" 
               href="{{ route('admin.permohonan.index') }}">
                <i class="bi bi-inbox-fill"></i>
                <span>Permohonan</span>
            </a>

            {{-- Menu Lainnya (Offcanvas/Modal Trigger) --}}
            <button type="button" class="dock-item dock-item-btn" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" aria-controls="mobileMenuOffcanvas">
                <i class="bi bi-three-dots"></i>
                <span>Lainnya</span>
            </button>
            
        </div>
    </div>

    {{-- Offcanvas Menu Tambahan untuk Mobile --}}
    <div class="offcanvas offcanvas-bottom rounded-top-4 d-lg-none" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuOffcanvasLabel" style="height: auto; max-height: 70vh;">
        <div class="offcanvas-header border-bottom py-3">
            <h6 class="offcanvas-title fw-bold text-success d-flex align-items-center gap-2" id="mobileMenuOffcanvasLabel">
                <i class="bi bi-grid-3x3-gap-fill"></i> Menu Administrasi Lengkap
            </h6>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-3">
            <div class="list-group list-group-flush gap-1">
                <a href="{{ route('admin.tarif.index') }}" class="list-group-item list-group-item-action rounded-3 border-0 py-2.5 d-flex align-items-center gap-3 {{ request()->routeIs('admin.tarif.*') ? 'bg-success-subtle text-success fw-bold' : '' }}">
                    <i class="bi bi-tag-fill fs-5 text-success"></i>
                    <div>
                        <div class="fw-semibold">Tarif RSDKT</div>
                        <small class="text-muted">Kelola daftar harga dan tarif</small>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action rounded-3 border-0 py-2.5 d-flex align-items-center gap-3 {{ request()->routeIs('profile.edit') ? 'bg-success-subtle text-success fw-bold' : '' }}">
                    <i class="bi bi-person-gear fs-5 text-primary"></i>
                    <div>
                        <div class="fw-semibold">Pengaturan Profil</div>
                        <small class="text-muted">Ubah kata sandi & akun admin</small>
                    </div>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="list-group-item list-group-item-action rounded-3 border-0 py-2.5 d-flex align-items-center gap-3">
                    <i class="bi bi-eye-fill fs-5 text-secondary"></i>
                    <div>
                        <div class="fw-semibold">Lihat Situs Publik</div>
                        <small class="text-muted">Kunjungi website utama RSBH</small>
                    </div>
                </a>

                <div class="border-top my-2 pt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i> Keluar dari Admin Panel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>