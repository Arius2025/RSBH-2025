{{-- berita.blade.php --}}
@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION (Konsisten dengan Halaman Lain) --}}
<section class="hero-section position-relative d-flex align-items-center justify-content-center overflow-hidden" 
    style="min-height: 40vh; background: linear-gradient(rgba(25, 135, 84, 0.9), rgba(20, 108, 67, 0.9)), url('{{ asset('images/hero-rs.jpg') }}') center/cover no-repeat;" 
    data-aos="fade-down">
    <div class="container text-center text-white position-relative z-2">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
            <i class="bi bi-newspaper me-1"></i> NEWSROOM
        </span>
        <h1 class="fw-extrabold display-4 mb-2">Berita & Kegiatan</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Informasi terbaru, kegiatan, dan update layanan dari RS Tk. III Baladhika Husada.
        </p>
    </div>
</section>

{{-- 2. LIST BERITA --}}
<div class="container py-5" style="margin-top: -50px; position: relative; z-index: 3;">
    
    {{-- Filter / Search Bar (Opsional - Visual Saja) --}}
    <div class="bg-white p-3 rounded-4 shadow-sm mb-5 d-flex justify-content-between align-items-center" data-aos="fade-up">
        <h5 class="mb-0 fw-bold text-success"><i class="bi bi-grid-fill me-2"></i> Feed Instagram</h5>
        <a href="https://www.instagram.com/rstk3baladhikahusada/" target="_blank" class="btn btn-outline-success btn-sm rounded-pill">
            <i class="bi bi-instagram"></i> Follow Kami
        </a>
    </div>

    <div class="row g-4">
        {{-- Gunakan @forelse untuk handle jika data kosong --}}
        @isset($beritas)
            @forelse($beritas as $b)
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card card-news h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        {{-- Gambar Berita --}}
                        <div class="img-container position-relative">
                            {{-- Badge Tanggal --}}
                            <div class="date-badge">
                                <span class="d-block fw-bold fs-4 lh-1">{{ \Carbon\Carbon::parse($b->tgl)->format('d') }}</span>
                                <span class="d-block small text-uppercase">{{ \Carbon\Carbon::parse($b->tgl)->format('M') }}</span>
                            </div>
                            
                            <img src="{{ $b->img }}" class="w-100 h-100 object-fit-cover transition-img" alt="{{ $b->judul }}">
                            
                            {{-- Overlay Gradient saat Hover --}}
                            <div class="overlay-hover d-flex align-items-center justify-content-center">
                                <a href="{{ $b->url }}" target="_blank" class="btn btn-light rounded-circle shadow-lg" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-instagram fs-4 text-danger"></i>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Konten Berita --}}
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-light text-secondary border rounded-pill small">
                                    <i class="bi bi-hash"></i> Kegiatan RS
                                </span>
                            </div>

                            <h5 class="fw-bold text-dark mb-3 card-title-limit">
                                {{ $b->judul }}
                            </h5>
                            
                            <p class="text-muted small flex-grow-1 card-text-limit">
                                {{ $b->isi }}
                            </p>

                            <div class="pt-3 border-top mt-auto d-flex justify-content-between align-items-center">
                                <span class="small text-muted fst-italic">
                                    <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($b->tgl)->diffForHumans() }}
                                </span>
                                <a href="{{ $b->url }}" target="_blank" class="text-success fw-bold text-decoration-none small stretched-link">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- TAMPILAN JIKA BERITA KOSONG --}}
                <div class="col-12 text-center py-5">
                    <div class="bg-light rounded-4 p-5">
                        <i class="bi bi-newspaper display-1 text-muted opacity-50"></i>
                        <h4 class="fw-bold text-muted mt-3">Belum ada berita terbaru.</h4>
                        <p class="text-muted">Silakan kunjungi Instagram kami untuk update langsung.</p>
                        <a href="https://www.instagram.com/rstk3baladhikahusada/" target="_blank" class="btn btn-success rounded-pill mt-3">
                            <i class="bi bi-instagram me-2"></i> Buka Instagram
                        </a>
                    </div>
                </div>
            @endforelse
        @endisset
    </div>
</div>

<style>
    /* CSS KHUSUS HALAMAN BERITA */
    
    /* 1. Card Styling */
    .card-news {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-news:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    /* 2. Image Container & Hover Effect */
    .img-container {
        height: 250px;
        overflow: hidden;
        position: relative;
    }
    .transition-img {
        transition: transform 0.5s ease;
    }
    .card-news:hover .transition-img {
        transform: scale(1.1);
    }
    
    /* 3. Date Badge (Kotak Tanggal) */
    .date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: white;
        color: #198754;
        padding: 8px 12px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        z-index: 10;
        line-height: 1;
    }

    /* 4. Overlay Button saat Hover */
    .overlay-hover {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.3);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .card-news:hover .overlay-hover {
        opacity: 1;
    }

    /* 5. Typography Limits (Agar kartu rapi rata) */
    .card-title-limit {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Batasi 2 baris judul */
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
    }
    .card-text-limit {
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Batasi 3 baris deskripsi */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@endsection