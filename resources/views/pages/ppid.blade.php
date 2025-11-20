{{-- ppid.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Header --}}
  <div class="text-center mb-5" data-aos="fade-down">
    <h1 class="fw-bold display-5 text-success">PPID – Pejabat Pengelola Informasi</h1>
    <p class="lead text-muted">PPID berfungsi sebagai pengelola dan penyampai dokumentasi publik sesuai amanat UU 14/2008 tentang Keterbukaan Informasi Publik.</p>
    <hr class="w-25 mx-auto border-success border-3">
    <p class="text-muted fst-italic">Dengan keberadaan PPID, masyarakat dapat menyampaikan permohonan informasi lebih mudah dan tidak berbelit, karena dilayani lewat satu pintu.</p>
  </div>

  {{-- Menu Layanan --}}
  <section class="bg-white rounded shadow-lg p-4 mb-5" data-aos="fade-up"> 
    <div class="text-center mb-5">
      <h4 class="fw-bold text-success border-bottom border-success pb-2 mb-3"><i class="bi bi-list-check me-2"></i>Pilih Menu Informasi Publik</h4>
    </div>
    <div class="row g-4 justify-content-center">

      @php
        $menus = [
          ['icon' => 'file-earmark-text', 'title' => 'Sprin', 'desc' => 'Surat Perintah Informasi', 'link' => 'https://drive.google.com/file/d/1GPzo5jJDu-MMuAuG33ifVrV_7tji_bCW/view?usp=sharing'],
          ['icon' => 'envelope-paper', 'title' => 'Surat Struktur', 'desc' => 'Struktur Informasi Rumah Sakit', 'link' => 'https://drive.google.com/file/d/1MPjo6wxXfJwObpRitpQPoMFP-qmhgJbL/view?usp=sharing'],
          ['icon' => 'info-circle', 'title' => 'Informasi RS', 'desc' => 'Fasilitas & Profil RS', 'link' => route('informasi')],
          ['icon' => 'exclamation-triangle', 'title' => 'Komplain', 'desc' => 'Layanan Pengaduan Publik', 'link' => route('komplain')],
          ['icon' => 'phone', 'title' => 'Pendaftaran Online (BPJS)', 'desc' => 'Melalui Mobile JKN', 'link' => 'https://play.google.com/store/apps/details?id=app.bpjs.mobile&hl=id&gl=US&pli=1'],
        ];
      @endphp

      @foreach($menus as $menu)
      <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="card h-100 text-center border-0 shadow-sm hover-shadow transition">
          <div class="card-body">
            <i class="bi bi-{{ $menu['icon'] }} fs-1 text-success mb-2"></i>
            <h6 class="fw-bold text-success">{{ $menu['title'] }}</h6>
            <p class="text-muted small">{{ $menu['desc'] }}</p>
            <a href="{{ $menu['link'] }}" class="btn btn-outline-success btn-sm mt-2">Buka</a>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </section>

  {{-- Galeri Foto IKP --}}
  <section class="mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
      <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-graph-up me-2"></i> Indeks Kepuasan Pasien (IKP)</h4>
      <p class="lead text-muted">Transparansi hasil survey kepuasan pasien per bulan.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
      @php
        // PATH MENGGUNAKAN public/images/smile/ DAN EKSTENSI .jpg SESUAI FILE YANG DIUPLOAD
        $ikp_photos = [
          ['src' => asset('images/smile/oktober25.jpeg'), 'alt' => 'IKP Oktober 2025'],
          ['src' => asset('images/smile/september25.jpeg'), 'alt' => 'IKP September 2025'],
          ['src' => asset('images/smile/agustus25.jpeg'), 'alt' => 'IKP Agustus 2025'],
          ['src' => asset('images/smile/juli25.jpeg'), 'alt' => 'IKP Juli 2025'],
        ];
      @endphp

      @foreach($ikp_photos as $photo)
      <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
        <div class="card border-0 shadow-lg hover-shadow transition h-100"> 
          <img src="{{ $photo['src'] }}" class="card-img-top" alt="{{ $photo['alt'] }}" style="object-fit: cover; height: 350px;">
          <div class="card-body text-center">
            <p class="fw-semibold text-success mb-0">{{ $photo['alt'] }}</p>
            {{-- Tombol untuk melihat gambar dalam ukuran penuh --}}
            <a href="{{ $photo['src'] }}" target="_blank" class="btn btn-outline-success btn-sm mt-2" title="Lihat ukuran penuh">
                <i class="bi bi-zoom-in"></i> Lihat
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>
  {{-- Akhir Galeri Foto IKP --}}
  
  {{-- Galeri Video Edukasi --}}
  <section class="mb-5">
  <div class="text-center mb-5" data-aos="fade-up">
    <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-play-circle me-2"></i> Video Edukasi Kesehatan</h4>
    <p class="lead text-muted">Informasi penting seputar layanan BPJS, fasilitas rumah sakit, jam kunjung, dan edukasi publik.</p>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach([
      ['https://www.youtube.com/embed/0JI0aZKU9LA', 'Jam Kunjung Pasien – RS Tk III Baladhika Husada'],
      ['https://www.youtube.com/embed/3pvq9bJuRfE', '144 Penyakit yang TIDAK DAPAT DIRUJUK ke Ruman Sakit'],
      ['https://www.youtube.com/embed/8EOSLgoK8vw', 'SITERBAT (Siap Antar Obat)'],
      ['https://www.youtube.com/embed/50h3kzWWPyo', 'Layanan ambulance gratis'],
      ['https://www.youtube.com/embed/1iC1Yrt1xDI', 'Kegiatan Pemeriksaan Mata dan Jantung'],
    ] as $video)
    <div class="col" data-aos="zoom-in">
      <div class="card border-0 shadow-lg hover-shadow transition h-100"> 
        <div class="ratio ratio-16x9">
          <iframe src="{{ $video[0] }}" title="{{ $video[1] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
        </div>
        <div class="card-body text-center">
          <p class="fw-semibold text-success mb-0">{{ $video[1] }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="text-center mt-5" data-aos="fade-up">
    <a href="/kontak" class="btn btn-success btn-lg shadow-lg transition hover-shadow">Hubungi Kami</a>
    <p class="text-muted mt-2 small">Untuk pertanyaan seputar layanan atau informasi tambahan, silakan klik tombol di atas.</p>
  </div>
</section>


</div>
@endsection