{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    {{-- Clean Header --}}
    <div class="mb-5 pb-3 border-bottom d-flex align-items-center justify-content-between">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Administrasi</h2>
            <p class="text-muted mb-0">Panel kendali konten RS Tk. III Baladhika Husada</p>
        </div>
        <div class="d-none d-md-block text-end">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                <i class="bi bi-clock me-1"></i> Terakhir sinkronisasi: {{ date('H:i') }}
            </span>
        </div>
    </div>

    <div class="row g-4 justify-content-start">
        {{-- Card 1: Kelola Jadwal Dokter --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-calendar3 fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Jadwal Dokter</h5>
                </div>
                <p class="text-muted small mb-4">Pengaturan harian dokter spesialis dan ketersediaan poliklinik.</p>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-success px-4 py-2 fw-semibold w-100">
                    Buka Pengaturan
                </a>
            </div>
        </div>

        {{-- Card 2: Dokumen PPID --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-file-earmark-lock fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Dokumen PPID</h5>
                </div>
                <p class="text-muted small mb-4">Pengelolaan Regulasi, SOP, dan SK untuk transparansi informasi publik.</p>
                <a href="{{ route('admin.documents.index') }}" class="btn btn-success px-4 py-2 fw-semibold w-100">
                    Buka Pengaturan
                </a>
            </div>
        </div>

        {{-- Card 3: Tarif RSDKT --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-tag fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Tarif RSDKT</h5>
                </div>
                <p class="text-muted small mb-4">Pemantauan daftar harga dan jenis layanan unit RSDKT.</p>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-success px-4 py-2 fw-semibold w-100">
                    Buka Dashboard
                </a>
            </div>
        </div>

        {{-- Card 4: Pengaturan Keamanan --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-shield-lock fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Profil Keamanan</h5>
                </div>
                <p class="text-muted small mb-4">Pembaruan data login, email, dan otentikasi administrator.</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-success px-4 py-2 fw-semibold w-100">
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- Card 5: Integrasi Media --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-arrow-repeat fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Sinkronisasi Media</h5>
                </div>
                <p class="text-muted small mb-4">Pembaruan paksa feed Instagram agar tetap aktual di halaman utama.</p>
                <form action="{{ route('admin.refresh_instagram') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-success px-4 py-2 fw-semibold w-100">
                        Sinkronkan Sekarang
                    </button>
                </form>
            </div>
        </div>

        {{-- Card 6: Monitoring Web --}}
        <div class="col-xl-4 col-md-6">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm transition-all hover-border-success d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded p-3 me-3">
                        <i class="bi bi-hdd-network fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Website Publik</h5>
                </div>
                <p class="text-muted small mb-4">Peninjauan langsung tampilan visual pada situs RS Tk. III Baladhika Husada.</p>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-dark px-4 py-2 fw-semibold w-100 mt-auto">
                    Kunjungi Situs <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.transition-all {
    transition: all 0.25s ease;
}
.hover-border-success:hover {
    border-color: #198754 !important;
    background-color: #f8fdfb !important;
}
</style>
@endsection