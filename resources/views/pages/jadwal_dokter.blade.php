@extends('layouts.app')

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }
    
    .hero-gradient {
        background: linear-gradient(135deg, #e6fced 0%, #ffffff 100%);
        border: 1px solid rgba(25, 135, 84, 0.15);
        border-radius: 24px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .img-schedule {
        width: 100%;
        display: block;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .img-schedule:hover {
        transform: scale(1.01);
    }
</style>

<div class="container py-3 py-md-4" style="font-family: 'Inter', sans-serif;">
    <div class="hero-gradient shadow-sm" data-aos="fade-up">
        <span class="badge bg-success px-3 py-1.5 rounded-pill mb-3 shadow-sm fw-semibold">Pelayanan Maksimal</span>
        <h1 class="fw-bold text-success display-5 mb-2">Dokter di Rumah Sakit</h1>
        <p class="text-muted fs-5 mb-0" style="max-width: 650px; margin: 0 auto;">Berikut adalah informasi jadwal pelayanan dokter umum dan spesialis di RS Tk. III Baladhika Husada, diperbarui secara berkala.</p>
    </div>

    @php
        $jadwal = \App\Models\JadwalDokter::orderBy('id', 'desc')->first(); 
        $fotoList = $jadwal ? $jadwal->foto_list : [];
    @endphp
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @forelse($fotoList as $index => $fotoPath)
                <div class="glass-card mb-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                    @if(count($fotoList) > 1)
                        <div class="px-4 py-2.5 bg-light border-bottom d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-success small"><i class="bi bi-calendar-event me-1"></i> Jadwal Dokter Bagian {{ $index + 1 }}</span>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1">Hal {{ $index + 1 }} dari {{ count($fotoList) }}</span>
                        </div>
                    @endif
                    <div class="position-relative bg-white text-center p-2 p-md-3">
                        <a href="{{ Storage::url($fotoPath) }}" target="_blank" class="d-block" title="Klik untuk membuka resolusi penuh">
                            <img src="{{ Storage::url($fotoPath) }}" 
                                 alt="Jadwal Dokter RS Bagian {{ $index + 1 }}" 
                                 class="w-100 d-block img-schedule rounded-3 shadow-sm" 
                                 onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    </div>
                </div>
            @empty
                <div class="glass-card p-5 text-center bg-white shadow-sm" data-aos="fade-up">
                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold text-dark mt-3">Jadwal Dokter Sedang Diperbarui</h5>
                    <p class="text-muted small mb-0">Informasi jadwal pelayanan dokter akan segera diunggah oleh pihak rumah sakit.</p>
                </div>
            @endforelse

            @if(count($fotoList) > 0)
                <p class="text-center text-muted small mt-3 fst-italic"><i class="bi bi-zoom-in me-1"></i> Klik pada gambar jadwal untuk melihat ukuran penuh / resolusi tinggi.</p>
            @endif
        </div>
    </div>
</div>
@endsection
