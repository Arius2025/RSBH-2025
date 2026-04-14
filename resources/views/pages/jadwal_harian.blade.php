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
        display: block;
    }
    


    /* Full width on mobile/tablet */
    @media (max-width: 991.98px) {
        .glass-card {
            border-radius: 0;
            border: none;
        }
        .glass-card-body {
            padding: 0 !important;
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
<div class="container py-2 py-md-4" style="font-family: 'Inter', sans-serif;">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            @if($items->isEmpty())
                <div class="glass-card p-5 text-center" data-aos="fade-up">
                    <i class="bi bi-calendar-x display-1 text-muted opacity-50"></i>
                    <h4 class="mt-4 fw-bold text-dark">Belum Ada Jadwal</h4>
                    <p class="text-muted">Jadwal harian untuk hari ini belum diunggah.</p>
                </div>
            @else
                <div class="glass-card p-0 overflow-hidden" data-aos="fade-up">
                    <div class="p-3 p-md-4 border-bottom glass-card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fw-bold text-success mb-1">Jadwal Harian Dokter</h4>
                                <p class="text-muted small mb-2 d-none d-md-block">Informasi praktik dokter RS Tk. III Baladhika Husada.</p>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                                        <i class="bi bi-clock-history me-1"></i> Update Terbaru
                                    </span>
                                    <span class="fw-bold text-dark small">{{ \Carbon\Carbon::parse($items->first()->tanggal)->translatedFormat('l, d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card-body p-0 p-md-4">
                        <div class="row g-0 g-md-4">
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
