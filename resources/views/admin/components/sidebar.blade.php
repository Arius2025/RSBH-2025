{{-- resources/views/admin/components/sidebar.blade.php --}}

<nav class="sidebar">
    <div class="px-2 py-3">
        <div class="px-3 mb-3">
            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.68rem; letter-spacing: 0.8px;">MENU UTAMA</span>
        </div>
        
        <ul class="nav flex-column mb-4">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            {{-- Kelola Jadwal --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.jadwal.index') }}">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>Jadwal Dokter</span>
                </a>
            </li>

            {{-- Dokumen PPID --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dokumen.*') || request()->routeIs('admin.documents.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.documents.index') }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Dokumen PPID</span>
                </a>
            </li>

            {{-- Permohonan Informasi --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.permohonan.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.permohonan.index') }}">
                    <i class="bi bi-inbox-fill"></i>
                    <span>Permohonan Info</span>
                </a>
            </li>

            {{-- Tarif RSDKT --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.tarif.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.tarif.index') }}">
                    <i class="bi bi-tag-fill"></i>
                    <span>Tarif Layanan</span>
                </a>
            </li>
        </ul>

        <div class="px-3 mb-3">
            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.68rem; letter-spacing: 0.8px;">SISTEM & AKUN</span>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active-admin' : '' }}" 
                   href="{{ route('profile.edit') }}">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Pengaturan Profil</span>
                </a>
            </li>
             
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-globe-americas"></i>
                    <span>Lihat Situs Publik</span>
                </a>
            </li>
             
            {{-- Logout Form --}}
            <li class="nav-item mt-3 pt-2 border-top mx-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link text-danger w-100 border-0 bg-transparent" type="submit">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>