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
        ['icon' => 'file-earmark-text', 'title' => 'Sprin', 'desc' => 'Surat Perintah Informasi', 'link' => 'https://drive.google.com/file/d/1ywXMNVDJD7hVEJt_ZAnGyiYbjOqyolF3/view', 'type' => 'normal'],
        ['icon' => 'envelope-paper', 'title' => 'Surat Struktur', 'desc' => 'Struktur Informasi Rumah Sakit', 'link' => 'https://drive.google.com/file/d/1MPjo6wxXfJwObpRitpQPoMFP-qmhgJbL/view?usp=sharing', 'type' => 'normal'],
        ['icon' => 'info-circle', 'title' => 'Informasi RS', 'desc' => 'Fasilitas & Profil RS', 'link' => route('informasi'), 'type' => 'normal'],
        ['icon' => 'exclamation-triangle', 'title' => 'Komplain', 'desc' => 'Layanan Pengaduan Publik', 'link' => route('komplain'), 'type' => 'normal'],
        
        // Pendaftaran BPJS dengan Logic Deep Link
        ['icon' => 'phone', 'title' => 'Pendaftaran Online (BPJS)', 'desc' => 'Melalui Mobile JKN', 'link' => 'https://play.google.com/store/apps/details?id=app.bpjs.mobile', 'type' => 'jkn'],
        
        ['icon' => 'phone', 'title' => 'Pendaftaran Online', 'desc' => 'Melalui Aplikasi DKT', 'link' => 'https://dkt-jember.promedika.id/pelayanan/pasien', 'type' => 'normal'],
      ];
    @endphp

    @foreach($menus as $menu)
    <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
      <div class="card h-100 text-center border-0 shadow-sm hover-shadow transition">
        <div class="card-body">
          <i class="bi bi-{{ $menu['icon'] }} fs-1 text-success mb-2"></i>
          <h6 class="fw-bold text-success">{{ $menu['title'] }}</h6>
          <p class="text-muted small">{{ $menu['desc'] }}</p>

          @if($menu['type'] == 'jkn')
            {{-- Tombol Khusus JKN --}}
            <button onclick="smartOpenJKN()" class="btn btn-outline-success btn-sm mt-2">Buka</button>
          @else
            {{-- Tombol Normal --}}
            <a href="{{ $menu['link'] }}" class="btn btn-outline-success btn-sm mt-2">Buka</a>
          @endif
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

    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach([
            ['https://www.youtube.com/embed/0JI0aZKU9LA', 'Jam Kunjung Pasien – RS Tk III Baladhika Husada'],
            ['https://www.youtube.com/embed/3pvq9bJuRfE', '144 Penyakit yang TIDAK DAPAT DIRUJUK'],
            ['https://www.youtube.com/embed/8EOSLgoK8vw', 'SITERBAT (Siap Antar Obat)'],
            ['https://www.youtube.com/embed/50h3kzWWPyo', 'Layanan Ambulance Gratis'],
            ['https://www.youtube.com/embed/1iC1Yrt1xDI', 'Kegiatan Pemeriksaan Mata dan Jantung'],
        ] as $video)
        <div class="col" data-aos="zoom-in">
            <div class="card border-0 shadow-sm h-100 video-card"> 
                <div class="ratio ratio-16x9">
                    <iframe 
                        src="{{ $video[0] }}?rel=0&enablejsapi=1&origin={{ urlencode(request()->getSchemeAndHttpHost()) }}" 
                        title="{{ $video[1] }}" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen 
                        loading="lazy">
                    </iframe>
                </div>
                <div class="card-body p-3">
                    <p class="fw-bold text-dark text-center mb-0" style="font-size: 0.95rem; line-height: 1.4;">
                        {{ $video[1] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

  <div class="text-center mt-5" data-aos="fade-up">
    <a href="/kontak" class="btn btn-success btn-lg shadow-lg transition hover-shadow">Hubungi Kami</a>
    <p class="text-muted mt-2 small">Untuk pertanyaan seputar layanan atau informasi tambahan, silakan klik tombol di atas.</p>
  </div>
</section>

<script>
function smartOpenJKN() {
    const playStoreUrl = "https://play.google.com/store/apps/details?id=app.bpjs.mobile";
    
    // Intent URL: Cara paling ampuh untuk Android agar langsung buka aplikasi JKN
    // Jika tidak ada, otomatis diarahkan ke package (Play Store)
    const androidIntent = "intent://#Intent;scheme=mobilejkn;package=app.bpjs.mobile;end";
    
    // Deteksi User Agent
    const isAndroid = /Android/i.test(navigator.userAgent);
    const isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);

    if (isAndroid) {
        // Langsung tembak Intent (Buka JKN atau Playstore otomatis)
        window.location.href = androidIntent;
    } else if (isIOS) {
        // Untuk iOS menggunakan custom scheme
        window.location.href = "mobilejkn://";
        setTimeout(() => {
            window.location.href = "https://apps.apple.com/id/app/mobile-jkn/id1237601115";
        }, 2000);
    } else {
        // Jika Desktop buka Play Store
        window.open(playStoreUrl, '_blank');
    }
}
</script>

<style>
  .transition { transition: all 0.3s ease; }
  .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>
</div>
@endsection