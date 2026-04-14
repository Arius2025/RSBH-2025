@extends('layouts.app')

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    }
    
    .media-container {
        border-radius: 20px;
        overflow: hidden;
        background: #f8fafc;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .media-container img, .media-container video {
        width: 100%;
        max-height: 800px;
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
</style>

<div class="container py-5" style="font-family: 'Inter', sans-serif;">
    <div class="hero-gradient shadow-sm" data-aos="fade-up">
        <h1 class="fw-bold text-success display-5 mb-2">Jadwal Harian Dokter</h1>
        <p class="text-muted fs-5 mb-0">Informasi praktik dokter hari ini di Poli Eksekutif & Reguler RS Tk. III Baladhika Husada.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($items->isEmpty())
                <div class="glass-card p-5 text-center" data-aos="fade-up">
                    <i class="bi bi-calendar-x display-1 text-muted opacity-50"></i>
                    <h4 class="mt-4 fw-bold text-dark">Belum Ada Jadwal</h4>
                    <p class="text-muted">Jadwal harian untuk hari ini belum diunggah.</p>
                </div>
            @else
                <div class="glass-card p-4" data-aos="fade-up">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div>
                            <span class="badge bg-success rounded-pill px-3 py-2 mb-2">
                                <i class="bi bi-clock-history me-1"></i> Update Terbaru
                            </span>
                            <h4 class="fw-bold text-dark mb-0">Jadwal Tanggal: <span class="text-success">{{ \Carbon\Carbon::parse($items->first()->tanggal)->translatedFormat('l, d F Y') }}</span></h4>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach($items as $item)
                        <div class="col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="media-container border shadow-sm">
                                @if($item->type === 'video')
                                    <video controls playsinline>
                                        <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @else
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->keterangan ?? 'Jadwal' }}">
                                    </a>
                                @endif
                            </div>
                            @if($item->keterangan)
                                <div class="mt-3 text-center">
                                    <p class="fs-5 fw-medium text-dark"><i class="bi bi-info-circle text-success me-2"></i>{{ $item->keterangan }}</p>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
