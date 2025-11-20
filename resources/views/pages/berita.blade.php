{{-- berita.blade.php (Pastikan Anda menggunakan kode ini) --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold display-5 text-success">Berita Rumah Sakit</h1>
        <p class="lead text-muted">Informasi terbaru seputar kegiatan dan perkembangan RS Tk. III Baladhika Husada.</p>
        <hr class="w-25 mx-auto border-success border-3">
    </div>

    <div class="row g-4 justify-content-center">
        {{-- PENTING: Tambahkan pengecekan if untuk variabel $beritas --}}
        @if(isset($beritas) && count($beritas) > 0) 
            @foreach($beritas as $berita)
            <div class="col-md-8" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card shadow-sm border-0 transition hover-shadow mb-4">
                    <div class="card-body">
                        <h3 class="fw-bold text-success card-title mb-2">{{ $berita->judul }}</h3>
                        <p class="text-sm text-muted mb-3">Dipublikasikan: {{ date('d M Y', strtotime($berita->created_at ?? now())) }}</p>
                        <p class="text-gray-600">{{ Str::limit($berita->isi, 250) }}</p>
                        <a href="#" class="btn btn-outline-success btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        
        @else
        {{-- Ini akan muncul jika variabel tidak ada atau datanya kosong --}}
        <div class="col-12 text-center mt-5">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Berita Belum Tersedia!</h4>
                <p>Saat ini belum ada artikel berita yang dipublikasikan.</p>
            </div>
        </div>
        @endif
        
    </div>
</div>
@endsection