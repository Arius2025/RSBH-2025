{{-- jadwal.blade.php (Pastikan Anda menggunakan kode ini) --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="text-center mb-5" data-aos="fade-down">
    <h2 class="fw-bold display-5 text-success">Jadwal Dokter Spesialis</h2>
    <p class="lead text-muted">Berikut adalah jadwal lengkap dokter umum dan spesialis di RS Tk. III Baladhika Husada.</p>
    <hr class="w-25 mx-auto border-success border-3">
  </div>

  @php
      // Pastikan Model JadwalDokter sudah ada dan query ini tidak error
      // Jika Model tidak ada, beri komentar baris ini saat testing:
      $jadwal = \App\Models\JadwalDokter::first(); 
  @endphp
  
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="rounded-4 shadow-lg overflow-hidden border-0 bg-white" data-aos="fade-up" style="border: 1px solid rgba(46, 204, 113, 0.2) !important;">
    
    {{-- Container Gambar 1 --}}
    <div class="position-relative overflow-hidden border-bottom">
        @if(isset($jadwal) && $jadwal->gambar_pagi && Storage::disk('public')->exists($jadwal->gambar_pagi))
            <a href="{{ asset('storage/' . $jadwal->gambar_pagi) }}" target="_blank" title="Klik untuk memperbesar">
                <img src="{{ asset('storage/' . $jadwal->gambar_pagi) }}" 
                     alt="Jadwal Dokter Bagian 1" 
                     class="w-100 d-block img-hover-zoom" 
                     style="object-fit: contain; max-height: 600px;"
                     onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
            </a>
            <div class="badge bg-success position-absolute top-0 start-0 m-3 shadow-sm"></div>
        @else
            <div class="py-5 text-center bg-light">
                <i class="bi bi-image text-muted fs-1"></i>
                <p class="text-muted mt-2">Jadwal Sesi 1 belum tersedia.</p>
            </div>
        @endif
    </div>

    {{-- Container Gambar 2 --}}
    <div class="position-relative overflow-hidden">
        @if(isset($jadwal) && $jadwal->gambar_sore && Storage::disk('public')->exists($jadwal->gambar_sore))
            <a href="{{ asset('storage/' . $jadwal->gambar_sore) }}" target="_blank" title="Klik untuk memperbesar">
                <img src="{{ asset('storage/' . $jadwal->gambar_sore) }}" 
                     alt="Jadwal Dokter Bagian 2" 
                     class="w-100 d-block img-hover-zoom" 
                     style="object-fit: contain; max-height: 600px;"
                     onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
            </a>
            <div class="badge bg-primary position-absolute top-0 start-0 m-3 shadow-sm"></div>
        @else
            <div class="py-5 text-center bg-light border-top">
                <i class="bi bi-image text-muted fs-1"></i>
                <p class="text-muted mt-2">Jadwal Sesi 2 belum tersedia.</p>
            </div>
        @endif
    </div>
</div>
      <p class="text-center text-muted small mt-3 fst-italic">Gambar di atas diambil dari data terbaru. Mohon hubungi kami untuk konfirmasi.</p>
    </div>
  </div>

  <div class="text-center mt-5" data-aos="fade-up">
    <a href="{{ route('home') }}" class="btn btn-outline-success transition hover-shadow">Kembali ke Beranda</a>
  </div>
</div>
@endsection