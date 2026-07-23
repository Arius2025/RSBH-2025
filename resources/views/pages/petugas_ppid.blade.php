@extends('layouts.app')

@section('content')
<section class="py-5 bg-gradient-success text-white text-center position-relative overflow-hidden mb-4">
    <div class="container py-3 position-relative z-1">
        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">Badan Publik</span>
        <h1 class="display-5 fw-bold mb-2" style="letter-spacing: -1px;">Petugas PPID</h1>
        <p class="lead opacity-90 mb-0 mx-auto" style="max-width: 600px;">Pejabat Pengelola Informasi dan Dokumentasi RS Tk. III Baladhika Husada</p>
    </div>
</section>

<div class="container pb-5">
    {{-- Definition Section --}}
    <div class="row justify-content-center mb-5" data-aos="fade-up">
        <div class="col-lg-11">
            <div class="apple-glass-card p-4 p-md-5 rounded-5 text-center">
                <span class="apple-badge mb-3 d-inline-block">Pengertian & Landasan Hukum</span>
                <p class="mb-0 fs-5 text-dark lh-lg" style="letter-spacing: -0.3px;">
                    <strong>PPID</strong> (Pejabat Pengelola Informasi dan Dokumentasi) bertugas mengelola dan menyampaikan dokumen badan publik sesuai amanat <strong>UU No. 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik. Dengan PPID, masyarakat dapat mengajukan permohonan informasi publik dengan mudah, cepat, dan transparan lewat layanan satu pintu.
                </p>
            </div>
        </div>
    </div>

    {{-- Organizational Chart Section --}}
    <div class="row g-4 justify-content-center">
        {{-- Struktur Organisasi --}}
        <div class="col-12 col-lg-11" data-aos="zoom-in">
            <div class="apple-glass-card p-4 rounded-5 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-success"><i class="bi bi-diagram-3-fill me-2"></i>Struktur Organisasi PPID</h5>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5 small">Klik Gambar untuk Memperbesar</span>
                </div>
                <div class="text-center rounded-4 overflow-hidden bg-light p-2 border border-light">
                    <img src="{{ asset('images/PPID/STRUKTUR ORGANISASI.png') }}" class="img-fluid rounded-3 apple-hover-img" alt="Struktur Organisasi PPID" style="cursor: zoom-in;" onclick="window.open(this.src)">
                </div>
            </div>
        </div>

        {{-- Anggota --}}
        <div class="col-12 col-lg-11" data-aos="zoom-in" data-aos-delay="200">
            <div class="apple-glass-card p-4 rounded-5 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-success"><i class="bi bi-people-fill me-2"></i>Anggota PPID</h5>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1.5 small">Klik Gambar untuk Memperbesar</span>
                </div>
                <div class="text-center rounded-4 overflow-hidden bg-light p-2 border border-light">
                    <img src="{{ asset('images/PPID/ANGGOTA.png') }}" class="img-fluid rounded-3 apple-hover-img" alt="Anggota PPID" style="cursor: zoom-in;" onclick="window.open(this.src)">
                </div>
            </div>
        </div>
    </div>

    {{-- Back Action --}}
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('ppid') }}" class="btn btn-outline-success rounded-pill px-5 py-2.5 fw-bold shadow-sm hover-lift">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Portal PPID
        </a>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #198754 0%, #115c39 100%);
}

.apple-glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    border-radius: 28px;
}

.apple-badge {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
    font-weight: 700;
    font-size: 0.75rem;
    padding: 6px 16px;
    border-radius: 9999px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.apple-hover-img {
    transition: transform 0.35s ease, filter 0.35s ease;
}
.apple-hover-img:hover {
    transform: scale(1.01);
    filter: brightness(0.97);
}
</style>
@endsection
