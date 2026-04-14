@extends('layouts.app')

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 28px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
        overflow: hidden;
    }
    
    .hero-gradient {
        background: linear-gradient(135deg, #e6fced 0%, #ffffff 100%);
        border: 1px solid rgba(25, 135, 84, 0.1);
        border-radius: 32px;
        padding: 3rem;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .img-schedule {
        width: 100%;
        display: block;
        transition: transform 0.4s ease;
    }
    .img-schedule:hover {
        transform: scale(1.02);
    }
</style>

<div class="container py-5 mt-4" style="font-family: 'Inter', sans-serif;">
    <div class="hero-gradient shadow-sm" data-aos="fade-up">
        <span class="badge bg-success px-3 py-2 rounded-pill mb-3 shadow-sm">Pelayanan Maksimal</span>
        <h1 class="fw-bold text-success display-5 mb-2">Dokter di Rumah Sakit</h1>
        <p class="text-muted fs-5 mb-0" style="max-width: 600px; margin: 0 auto;">Berikut adalah informasi jadwal pelayanan dokter umum dan spesialis di RS Tk. III Baladhika Husada, diperbarui secara berkala.</p>
    </div>

    @php
        $jadwal = \App\Models\JadwalDokter::first(); 
    @endphp
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card mb-4" data-aos="fade-up" data-aos-delay="100">
            
                {{-- Container Gambar 1 --}}
                <div class="position-relative bg-white">
                    @if(isset($jadwal) && $jadwal->gambar_pagi && Storage::disk('public')->exists($jadwal->gambar_pagi))
                        <a href="{{ Storage::url($jadwal->gambar_pagi) }}" target="_blank" class="d-block">
                            <img src="{{ Storage::url($jadwal->gambar_pagi) }}" 
                                 alt="Dokter RS Bagian 1" 
                                 class="w-100 d-block img-schedule" 
                                 onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    @else
                        <div class="py-5 text-center bg-light">
                            <i class="bi bi-image text-muted fs-1"></i>
                            <p class="text-muted mt-2">Data gambar pertama belum tersedia.</p>
                        </div>
                    @endif
                </div>

                {{-- Container Gambar 2 --}}
                <div class="position-relative bg-white border-top">
                    @if(isset($jadwal) && $jadwal->gambar_sore && Storage::disk('public')->exists($jadwal->gambar_sore))
                        <a href="{{ Storage::url($jadwal->gambar_sore) }}" target="_blank" class="d-block">
                            <img src="{{ Storage::url($jadwal->gambar_sore) }}" 
                                 alt="Dokter RS Bagian 2" 
                                 class="w-100 d-block img-schedule" 
                                 onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        </a>
                    @else
                        <div class="py-5 text-center bg-light">
                            <i class="bi bi-image text-muted fs-1"></i>
                            <p class="text-muted mt-2">Data gambar kedua belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
            <p class="text-center text-muted small mt-3 fst-italic">Catatan: Klik gambar untuk melihat ukuran penuh.</p>
        </div>
    </div>
</div>
@endsection
