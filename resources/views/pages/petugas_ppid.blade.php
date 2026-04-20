@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold display-4 text-success mb-3">Petugas PPID</h1>
        <p class="lead text-muted mx-auto" style="max-width: 900px;">
            Pejabat Pengelola Informasi dan Dokumentasi (PPID) RS Tk. III Baladhika Husada.
        </p>
        <div class="d-flex justify-content-center">
            <hr class="border-success border-3 opacity-75" style="width: 100px;">
        </div>
    </div>

    {{-- Definition Section --}}
    <div class="row justify-content-center mb-5" data-aos="fade-up">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4 text-center bg-light">
                <p class="mb-0 fs-5 text-dark" style="line-height: 1.8;">
                    <strong>PPID</strong> adalah kepanjangan dari <strong>Pejabat Pengelola Informasi dan Dokumentasi</strong>, dimana PPID berfungsi sebagai pengelola dan penyampai dokumen yang dimiliki oleh badan publik sesuai dengan amanat UU 14/2008 tentang Keterbukaan Informasi Publik. Dengan keberadaan PPID maka masyarakat yang akan menyampaikan permohonan informasi lebih mudah dan tidak berbelit karena dilayani lewat satu pintu. Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik.
                </p>
            </div>
        </div>
    </div>

    {{-- Organizational Chart Section --}}
    <div class="row g-5">
        {{-- Struktur Organisasi --}}
        <div class="col-12" data-aos="zoom-in">
            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-bold text-center"><i class="bi bi-diagram-3 me-2"></i>STRUKTUR ORGANISASI PPID</h5>
                </div>
                <div class="card-body p-0">
                    <img src="{{ asset('images/PPID/STRUKTUR ORGANISASI.png') }}" class="img-fluid w-100" alt="Struktur Organisasi PPID" style="cursor: zoom-in;" onclick="window.open(this.src)">
                </div>
            </div>
        </div>

        {{-- Anggota --}}
        <div class="col-12" data-aos="zoom-in" data-aos-delay="200">
            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-bold text-center"><i class="bi bi-people me-2"></i>ANGGOTA PPID</h5>
                </div>
                <div class="card-body p-0">
                    <img src="{{ asset('images/PPID/ANGGOTA.png') }}" class="img-fluid w-100" alt="Anggota PPID" style="cursor: zoom-in;" onclick="window.open(this.src)">
                </div>
            </div>
        </div>
    </div>

    {{-- Back Action --}}
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('ppid') }}" class="btn btn-outline-success rounded-pill px-5 py-2 shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Portal PPID
        </a>
    </div>
</div>

<style>
    .card { transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-5px); }
    img { transition: filter 0.3s ease; }
    img:hover { filter: brightness(0.95); }
</style>
@endsection
