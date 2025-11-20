{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard | {{ config('app.name', 'RS Baladhika Husada') }}</title>

    {{-- Bootstrap CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- Fonts (Figtree/Inter) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Custom Stylesheet untuk Admin --}}
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #198754; /* success color */
            --light-bg: #E6F4EA; 
            --transition: all 0.3s ease-in-out;
            --bottom-nav-height: 65px; /* Tinggi Bottom Nav yang lebih besar */
        }

        body {
            background-color: var(--light-bg); 
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
            padding-top: 56px; /* Ruang untuk fixed top navbar */
        }
        
        /* Sidebar Styles (Desktop Only) */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 56px; 
            transition: var(--transition);
        }

        /* Sidebar Nav Link Styles */
        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar .nav-link:hover {
            background-color: #f0fff0;
            color: var(--primary-color);
        }

        /* Active Sidebar Link Style */
        .sidebar .nav-link.active-admin {
            background-color: var(--primary-color);
            color: white !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-weight: 600;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width); /* Ruang untuk sidebar desktop */
            padding: 20px;
            transition: var(--transition);
        }

        /* ========================================= */
        /* MOBILE STYLES (Bottom Nav) */
        /* ========================================= */
        
        /* Hilangkan sidebar di mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                display: none !important;
            }
            .main-content {
                margin-left: 0; /* Full width di mobile */
                /* Padding bawah disesuaikan dengan tinggi Bottom Nav yang baru */
                padding-bottom: calc(var(--bottom-nav-height) + 10px); 
            }
        }
        
        /* Bottom Nav Styling */
        .bottom-nav {
            height: var(--bottom-nav-height); /* Tinggi disesuaikan */
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0 5px; 
        }
        
        /* Style untuk A-tag (link biasa) dan FORM (link logout) */
        .bottom-nav-link,
        .bottom-nav-item {
            text-align: center;
            color: #6c757d; 
            font-size: 0.75rem; /* Ukuran teks sedikit diperbesar */
            font-weight: 500;
            text-decoration: none;
            flex-grow: 1; 
            padding: 8px 0; /* Kunci: Menambahkan padding vertikal yang lebih besar */
            transition: var(--transition);
            margin: 0; 
            display: flex; 
            flex-direction: column; /* Mengatur ikon dan teks ke bawah */
            align-items: center;
            justify-content: center;
            height: 100%; /* Memastikan klik area penuh */
        }
        
        /* Styling untuk icon dan teks di A-tag */
        .bottom-nav-link i {
            font-size: 1.3rem; /* Ukuran ikon diperbesar */
            display: block;
            margin-bottom: 2px;
        }
        
        /* Active link style */
        .bottom-nav-link.active-mobile {
            color: var(--primary-color); 
            font-weight: 600;
            /* Tambahkan efek kecil saat aktif */
            transform: scale(1.05); 
        }
        
        /* Styling khusus untuk BUTTON di dalam FORM (Logout) agar terlihat seperti link */
        .bottom-nav-item button {
            color: #dc3545; /* text-danger (warna merah) */
            background: none;
            border: none;
            padding: 8px 0; /* Padding konsisten dengan link lain */
            width: 100%;
            height: 100%;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.2; 
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        /* Styling untuk icon di dalam button Logout */
        .bottom-nav-item button i {
             font-size: 1.3rem; /* Ukuran ikon diperbesar */
            display: block;
            margin-bottom: 2px;
        }
        
    </style>
</head>
<body>
    
    {{-- Top Navbar (Fixed Top) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow">
        <div class="container-fluid">
            
            {{-- Nama Brand --}}
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-hospital-fill me-2 fs-4"></i> Admin Panel
            </a>

            {{-- Desktop User Dropdown Menu (Muncul di layar besar) --}}
            <div class="d-none d-lg-block ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDesktop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownDesktop">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-1"></i> Pengaturan Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank"><i class="bi bi-eye me-1"></i> Lihat Situs Publik</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
             {{-- Mobile User/Logout Button (Muncul di layar kecil, disamping brand) --}}
            <div class="d-lg-none">
                 <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle fs-5"></i>
                </a>
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

    
    {{-- 3. BOTTOM NAVIGATION BAR (Mobile Only) --}}
    <nav class="fixed-bottom d-lg-none bg-white border-top shadow-lg" style="z-index: 1030;">
        <div class="bottom-nav">
            
            {{-- Dashboard --}}
            <a class="bottom-nav-link {{ request()->routeIs('admin.dashboard') ? 'active-mobile' : '' }}" 
               href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dash</span>
            </a>
            
            {{-- Kelola Berita --}}
            <a class="bottom-nav-link {{ request()->routeIs('admin.berita.*') ? 'active-mobile' : '' }}" 
               href="{{ route('admin.berita.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
            
            {{-- Kelola Jadwal --}}
            <a class="bottom-nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active-mobile' : '' }}" 
               href="{{ route('admin.jadwal.index') }}">
                <i class="bi bi-calendar-check"></i>
                <span>Jadwal</span>
            </a>
            
            {{-- Profil --}}
            <a class="bottom-nav-link {{ request()->routeIs('profile.edit') ? 'active-mobile' : '' }}" 
               href="{{ route('profile.edit') }}">
                <i class="bi bi-person-fill"></i>
                <span>Profil</span>
            </a>

            {{-- Logout (Menggunakan form agar aman, menggunakan bottom-nav-item untuk konsistensi lebar) --}}
            <form method="POST" action="{{ route('logout') }}" class="bottom-nav-item">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
            
        </div>
    </nav>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>