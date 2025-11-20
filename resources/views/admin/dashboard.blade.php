{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold text-success mb-2">Dashboard Administrasi</h1>
    <p class="lead text-muted border-bottom pb-3">Panel kontrol untuk pengelolaan konten RS Tk. III Baladhika Husada.</p>
    
    <div class="row g-4 mt-4">
        
        {{-- Card 1: Kelola Berita --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-newspaper me-3 fs-1 text-success"></i>
                        <div>
                            <h5 class="card-title fw-bold text-success mb-1">Kelola Berita</h5>
                            <p class="card-text text-muted small">Publikasikan informasi terbaru rumah sakit.</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-success w-100 mt-2">
                        <i class="bi bi-arrow-right-circle me-1"></i> Mulai Kelola
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Card 2: Kelola Jadwal --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-check me-3 fs-1 text-warning"></i>
                        <div>
                            <h5 class="card-title fw-bold text-warning mb-1">Kelola Jadwal Dokter</h5>
                            <p class="card-text text-muted small">Perbarui gambar jadwal dokter spesialis.</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-outline-warning w-100 mt-2">
                        <i class="bi bi-arrow-right-circle me-1"></i> Mulai Kelola
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Card 3: Pengaturan Akun --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-gear me-3 fs-1 text-info"></i>
                        <div>
                            <h5 class="card-title fw-bold text-info mb-1">Pengaturan Akun</h5>
                            <p class="card-text text-muted small">Kelola profil dan kata sandi Anda.</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-info w-100 mt-2">
                        <i class="bi bi-arrow-right-circle me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Card 4: Lihat Frontend --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white border-0 shadow-lg h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-globe me-3 fs-1 text-primary"></i>
                        <div>
                            <h5 class="card-title fw-bold text-primary mb-1">Lihat Situs Publik</h5>
                            <p class="card-text text-muted small">Kunjungi tampilan utama rumah sakit.</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary w-100 mt-2">
                        <i class="bi bi-arrow-up-right-square me-1"></i> Kunjungi
                    </a>
                </div>
            </div>
        </div>
            
    </div>
</div>
@endsection