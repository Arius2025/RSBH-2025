@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    }
    
    .media-container {
        border-radius: 16px;
        overflow: hidden;
        background: #000;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .media-container img, .media-container video {
        width: 100%;
        height: auto;
        max-height: 1200px;
        object-fit: contain;
        display: block;
    }
    
    .hero-gradient {
        background: linear-gradient(135deg, #e6fced 0%, #ffffff 100%);
        border: 1px solid rgba(25, 135, 84, 0.1);
        border-radius: 32px;
        padding: 3rem;
        text-align: center;
        margin-bottom: 3rem;
    }

    /* Full width on mobile/tablet */
    @media (max-width: 991.98px) {
        .glass-card-body {
            padding: 1.5rem 0 !important;
        }
        .media-container {
            border-radius: 0;
        }
    }
    
    .img-zoom-hover {
        cursor: zoom-in;
        transition: transform 0.3s ease;
    }
    .img-zoom-hover:hover {
        opacity: 0.95;
    }
</style>
@endpush

@section('content')
<div class="container py-5" style="font-family: 'Inter', sans-serif;">
    <div class="hero-gradient shadow-sm" data-aos="fade-up">
        <h1 class="fw-bold text-success display-5 mb-2">Jadwal Harian Dokter</h1>
        <p class="text-muted fs-5 mb-0">Informasi praktik dokter hari ini di Poli Eksekutif & Reguler RS Tk. III Baladhika Husada.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12"> {{-- Wider container --}}
            @if($items->isEmpty())
                <div class="glass-card p-5 text-center" data-aos="fade-up">
                    <i class="bi bi-calendar-x display-1 text-muted opacity-50"></i>
                    <h4 class="mt-4 fw-bold text-dark">Belum Ada Jadwal</h4>
                    <p class="text-muted">Jadwal harian untuk hari ini belum diunggah.</p>
                </div>
            @else
                <div class="glass-card p-0 overflow-hidden" data-aos="fade-up">
                    <div class="p-4 border-bottom glass-card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-success rounded-pill px-3 py-2 mb-2">
                                    <i class="bi bi-clock-history me-1"></i> Update Terbaru
                                </span>
                                <h4 class="fw-bold text-dark mb-0">Jadwal Tanggal: <span class="text-success">{{ \Carbon\Carbon::parse($items->first()->tanggal)->translatedFormat('l, d F Y') }}</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card-body p-4">
                        <div class="row g-4">
                            @foreach($items as $item)
                            <div class="col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="media-container shadow-sm">
                                    @if($item->type === 'video')
                                        <video controls playsinline class="w-100">
                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @else
                                        <a href="{{ asset('storage/' . $item->file_path) }}" class="glightbox" data-gallery="jadwal-gallery" data-title="Jadwal Dokter - {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}">
                                            <img src="{{ asset('storage/' . $item->file_path) }}" 
                                                 alt="{{ $item->keterangan ?? 'Jadwal Dokter' }}" 
                                                 class="img-zoom-hover">
                                        </a>
                                    @endif
                                </div>
                                @if($item->keterangan)
                                    <div class="mt-3 px-4 text-center">
                                        <p class="fs-5 fw-medium text-dark mx-auto" style="max-width: 800px;"><i class="bi bi-info-circle text-success me-2"></i>{{ $item->keterangan }}</p>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    });
</script>
@endpush
@endsection
