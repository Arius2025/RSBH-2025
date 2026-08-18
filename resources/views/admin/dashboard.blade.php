{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    {{-- Header Section --}}
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <span>Dashboard Administrasi</span>
                <span class="badge bg-success-subtle text-success fs-6 fw-semibold rounded-pill px-3 py-1">Online</span>
            </h3>
            <p class="text-muted mb-0 small">Pusat kendali dan manajemen informasi RS Tk. III Baladhika Husada Jember</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-white border text-secondary px-3 py-2 rounded-pill shadow-xs d-flex align-items-center gap-1">
                <i class="bi bi-clock-history text-success"></i> {{ date('d M Y') }} &bull; {{ date('H:i') }} WIB
            </span>
        </div>
    </div>

    {{-- Action Cards Grid --}}
    <div class="row g-3 g-lg-4">
        {{-- Card 1: Kelola Jadwal Dokter --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-calendar2-week-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Jadwal Dokter</h5>
                        <span class="text-muted small">Update ketersediaan poliklinik</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Atur jadwal praktik harian dokter spesialis dan ketersediaan poliklinik rawat jalan.</p>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-success rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Kelola Jadwal</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Card 2: Dokumen PPID --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-file-earmark-lock2-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Dokumen PPID</h5>
                        <span class="text-muted small">Transparansi Informasi Publik</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Unggah dan kelola regulasi, SOP, laporan kinerja, serta dokumen keterbukaan informasi.</p>
                <a href="{{ route('admin.documents.index') }}" class="btn btn-success rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Kelola Dokumen</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Card 3: Permohonan Informasi --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-inbox-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Permohonan Info</h5>
                        <span class="text-muted small">Inbox & Pengajuan Publik</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Tinjau formulir permohonan informasi dan aspirasi yang diajukan oleh masyarakat.</p>
                <a href="{{ route('admin.permohonan.index') }}" class="btn btn-success rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Tinjau Permohonan</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Card 4: Tarif RSDKT --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-tag-fill fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Tarif Pelayanan</h5>
                        <span class="text-muted small">Monitoring Biaya Layanan</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Pantau dan sinkronkan daftar harga tindakan, kamar, dan layanan medis rumah sakit.</p>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-outline-success rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Lihat Tarif</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Card 5: Profil & Keamanan --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-primary" style="background: rgba(13, 110, 253, 0.1);">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Akun & Keamanan</h5>
                        <span class="text-muted small">Kredensial Administrator</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Perbarui kata sandi, nama pengguna, dan informasi kontak akun admin Anda.</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Ubah Profil</span>
                    <i class="bi bi-gear"></i>
                </a>
            </div>
        </div>

        {{-- Card 6: Sinkronisasi Instagram --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 p-3 text-warning" style="background: rgba(255, 193, 7, 0.15);">
                        <i class="bi bi-instagram fs-3 text-warning"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Feed Media Sosial</h5>
                        <span class="text-muted small">Cache Instagram</span>
                    </div>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">Segarkan data cache Instagram untuk menampilkan postingan terbaru di situs publik.</p>
                <form action="{{ route('admin.refresh_instagram') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark rounded-3 py-2 px-3 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Refresh Feed Instagram</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.transition-all {
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(25, 135, 84, 0.08) !important;
}
.shadow-xs {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}
</style>
@endsection