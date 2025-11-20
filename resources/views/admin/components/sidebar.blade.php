{{-- resources/views/admin/components/sidebar.blade.php --}}

<nav class="sidebar bg-white shadow-lg border-end">
    <div class="p-3">
        <h6 class="text-uppercase text-success fw-bold border-bottom pb-2 mb-3">ADMIN MENU</h6>
        
        <ul class="nav flex-column">
            
            {{-- Dashboard --}}
            <li class="nav-item mb-1">
                <a class="nav-link py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            
            {{-- Kelola Berita --}}
            <li class="nav-item mb-1">
                <a class="nav-link py-2 rounded {{ request()->routeIs('admin.berita.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.berita.index') }}">
                    <i class="bi bi-newspaper me-2"></i> Kelola Berita
                </a>
            </li>

            {{-- Kelola Jadwal --}}
            <li class="nav-item mb-1">
                <a class="nav-link py-2 rounded {{ request()->routeIs('admin.jadwal.*') ? 'active-admin' : '' }}" 
                   href="{{ route('admin.jadwal.index') }}">
                    <i class="bi bi-calendar-check me-2"></i> Kelola Jadwal
                </a>
            </li>
            
            {{-- Akun & Logout --}}
            <h6 class="text-uppercase text-success fw-bold border-bottom pb-2 mt-4 mb-3">AKUN</h6>
            
             <li class="nav-item mb-1">
                <a class="nav-link py-2 rounded {{ request()->routeIs('profile.edit') ? 'active-admin' : '' }}" 
                   href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-fill me-2"></i> Pengaturan Profil
                </a>
            </li>
             
             <li class="nav-item mb-1">
                <a class="nav-link py-2 rounded" 
                   href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-eye me-2"></i> Lihat Situs Publik
                </a>
            </li>
             
             {{-- Logout Form --}}
             <li class="nav-item mb-1 mt-2">
                 <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="nav-link py-2 rounded w-100 text-start text-danger" type="submit">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>