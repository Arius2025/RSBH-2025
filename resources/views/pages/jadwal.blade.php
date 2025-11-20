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
      <div class="rounded shadow-lg overflow-hidden border border-success p-2 bg-white" data-aos="fade-up">
        
        {{-- Gambar 1 --}}
        @if(isset($jadwal) && $jadwal->gambar_pagi)
            <img src="{{ asset('storage/' . $jadwal->gambar_pagi) }}" alt="Jadwal Dokter Bagian 1" class="w-100 mb-0 d-block" loading="lazy">
        @else
            <div class="alert alert-warning text-center">Jadwal Pagi belum tersedia.</div>
        @endif

        {{-- Gambar 2 --}}
        @if(isset($jadwal) && $jadwal->gambar_sore)
            <img src="{{ asset('storage/' . $jadwal->gambar_sore) }}" alt="Jadwal Dokter Bagian 2" class="w-100 mt-0 d-block" loading="lazy">
        @else
            <div class="alert alert-warning text-center">Jadwal Sore belum tersedia.</div>
        @endif
        
      </div>
      <p class="text-center text-muted small mt-3 fst-italic">Gambar di atas diambil dari data terbaru. Mohon hubungi kami untuk konfirmasi.</p>
    </div>
  </div>

  <div class="text-center mt-5" data-aos="fade-up">
    <a href="{{ route('home') }}" class="btn btn-outline-success transition hover-shadow">Kembali ke Beranda</a>
  </div>
</div>
@endsection