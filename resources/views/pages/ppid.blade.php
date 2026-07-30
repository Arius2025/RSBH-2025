{{-- ppid.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Carousel Jumbotron --}}
  <div id="ppidCarousel" class="carousel slide mb-5 shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel" data-aos="fade-down">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#ppidCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#ppidCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/PPID/PPID1.jpeg') }}" class="d-block w-100 ppid-carousel-img" alt="PPID Slide 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/PPID/PPID2.jpeg') }}" class="d-block w-100 ppid-carousel-img" alt="PPID Slide 2">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#ppidCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#ppidCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  {{-- Header --}}
  <div class="text-center mb-5" data-aos="fade-down">
    <h1 class="fw-bold display-5 text-success">PPID – Pejabat Pengelola Informasi</h1>
    <p class="lead text-muted">PPID berfungsi sebagai pengelola dan penyampai dokumentasi publik sesuai amanat UU 14/2008 tentang Keterbukaan Informasi Publik.</p>
    <hr class="w-25 mx-auto border-success border-3">
    <p class="text-muted fst-italic">Dengan keberadaan PPID, masyarakat dapat menyampaikan permohonan informasi lebih mudah dan tidak berbelit, karena dilayani lewat satu pintu.</p>
  </div>

  {{-- Menu Layanan (Apple Aesthetic) --}}
<section class="apple-glass-card rounded-5 p-4 p-md-5 mb-5 position-relative overflow-hidden" data-aos="fade-up"> 
  <div class="text-center mb-5">
    <span class="apple-badge mb-2 d-inline-block">Portal Layanan Publik</span>
    <h3 class="fw-bold text-dark display-6 mb-2" style="letter-spacing: -1px;">Menu Informasi Publik</h3>
    <p class="text-muted small">Akses informasi resmi dan dokumentasi publik RS Baladhika Husada secara transparan</p>
  </div>

  <div class="row g-4 justify-content-center">
    @php
      $menus = [
        ['icon' => 'file-earmark-text-fill', 'title' => 'Dokumen PPID', 'desc' => 'Regulasi, SOP & SK PPID', 'link' => route('dokumen-ppid'), 'type' => 'normal'],
        ['icon' => 'person-badge-fill', 'title' => 'Profil PPID', 'desc' => 'Struktur, Visi, Misi & Maklumat', 'link' => route('profil-ppid'), 'type' => 'normal'],
        ['icon' => 'info-circle-fill', 'title' => 'Informasi Publik', 'desc' => 'Ringkasan Program & Kebijakan', 'link' => route('informasi-publik'), 'type' => 'normal'],
        ['icon' => 'exclamation-triangle-fill', 'title' => 'Komplain & Pengaduan', 'desc' => 'Layanan Pengaduan Publik', 'link' => route('komplain'), 'type' => 'normal'],
        ['icon' => 'whatsapp', 'title' => 'Tanya Jawab', 'desc' => 'Konsultasi Informasi via WhatsApp', 'link' => 'https://wa.me/6285330115991', 'type' => 'normal'],
        ['icon' => 'clipboard-check-fill', 'title' => 'Survei Kepuasan', 'desc' => 'Survei Layanan Online', 'link' => route('survei'), 'type' => 'normal'],
        ['icon' => 'phone-fill', 'title' => 'Pendaftaran BPJS', 'desc' => 'Via Mobile JKN App', 'link' => 'https://play.google.com/store/apps/details?id=app.bpjs.mobile', 'type' => 'jkn'],
        ['icon' => 'hospital-fill', 'title' => 'Pendaftaran Online', 'desc' => 'Via Aplikasi DKT Jember', 'link' => 'https://dkt-jember.promedika.id/pelayanan/pasien', 'type' => 'normal'],
      ];
    @endphp

    @foreach($menus as $menu)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 75 }}">
      <div class="apple-menu-card h-100 p-4 text-center d-flex flex-column align-items-center justify-content-between">
        <div class="w-100 d-flex flex-column align-items-center">
          <div class="apple-icon-wrapper mb-3">
            <i class="bi bi-{{ $menu['icon'] }} fs-3 text-white"></i>
          </div>
          <h6 class="fw-bold text-dark mb-1 fs-6" style="letter-spacing: -0.3px;">{{ $menu['title'] }}</h6>
          <p class="text-secondary small mb-3 lh-sm opacity-75" style="font-size: 0.82rem;">{{ $menu['desc'] }}</p>
        </div>

        @if($menu['type'] == 'jkn')
          <button onclick="smartOpenJKN()" class="btn apple-pill-btn w-100 py-2 small fw-bold">Akses Menu <i class="bi bi-chevron-right ms-1 small"></i></button>
        @else
          <a href="{{ $menu['link'] }}" class="btn apple-pill-btn w-100 py-2 small fw-bold">Akses Menu <i class="bi bi-chevron-right ms-1 small"></i></a>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</section>



  {{-- Galeri Foto IKM --}}
  <section class="mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
      <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-graph-up me-2"></i> Indeks Kepuasan Masyarakat (IKM)</h4>
      <p class="lead text-muted">Transparansi hasil survey kepuasan masyarakat per Triwulan.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
      @php
        $ikm_photos = [
          ['src' => asset('images/ikm/TW I 2024.jpeg'), 'alt' => 'IKM TRIWULAN I 2024'],
          ['src' => asset('images/ikm/TW II 2024.jpeg'), 'alt' => 'IKM TRIWULAN II 2024'],
          ['src' => asset('images/ikm/TW III 2024.jpeg'), 'alt' => 'IKM TRIWULAN III 2024'],
          ['src' => asset('images/ikm/TW IV 2024.jpeg'), 'alt' => 'IKM TRIWULAN IV 2024'],
          ['src' => asset('images/ikm/TW I 2025.jpeg'), 'alt' => 'IKM TRIWULAN I 2025'],
          ['src' => asset('images/ikm/TW II 2025.jpeg'), 'alt' => 'IKM TRIWULAN II 2025'],
          ['src' => asset('images/ikm/TW III 2025.jpeg'), 'alt' => 'IKM TRIWULAN III 2025'],
          ['src' => asset('images/ikm/TW IV 2025.jpeg'), 'alt' => 'IKM TRIWULAN IV 2025'],
        ];
      @endphp

      @foreach($ikm_photos as $photo)
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
  {{-- Akhir Galeri Foto IKM --}}
  
  {{-- Galeri Video Edukasi --}}
  <section class="mb-5">
  <div class="text-center mb-5" data-aos="fade-up">
    <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-play-circle me-2"></i> Video Edukasi Kesehatan</h4>
    <p class="lead text-muted">Informasi penting seputar layanan BPJS, fasilitas rumah sakit, jam kunjung, dan edukasi publik.</p>

    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col" data-aos="zoom-in">
            <div class="card border-0 shadow-sm h-100 video-card"> 
                <div class="ratio ratio-16x9">
                    <video controls controlsList="nodownload" preload="metadata" style="width: 100%; height: 100%; object-fit: cover;">
                        <source src="{{ asset('videos/Cara Pendaftaran Mobile JKN.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
                <div class="card-body p-3">
                    <p class="fw-bold text-dark text-center mb-0" style="font-size: 0.95rem; line-height: 1.4;">
                        Cara Pendaftaran Mobile JKN
                    </p>
                </div>
            </div>
        </div>
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

<!-- FLOATING WIDGET (Permohonan Form) -->
<div class="floating-widget-container" id="floatingWidgetContainer">
    
    <!-- Widget Form Box -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-3 floating-form-box" id="floatingFormBox">
        <!-- Header -->
        <div class="bg-success text-white px-4 py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%);">
            <div class="d-flex align-items-center">
                <i class="bi bi-envelope-paper-fill fs-4 me-2"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Permohonan Informasi</h6>
                    <small class="opacity-75" style="font-size: 0.75rem;">Tim PPID Siap Membantu</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-link text-white p-0" id="closeWidgetBtn" style="text-decoration: none;">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>
        
        <!-- Form Body -->
        <div class="card-body bg-white p-4 custom-scrollbar" style="max-height: 450px; overflow-y: auto; background-color: #fcfcfc;">
            <div class="alert alert-info border-0 rounded-3 mb-4 p-3 d-flex align-items-start" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);">
                <i class="bi bi-info-circle-fill text-info-emphasis fs-4 me-2 mt-1"></i>
                <p class="text-dark mb-0 opacity-75" style="font-size: 0.8rem;">Balasan akan dikirim melalui email Anda dalam maks 3x24 jam kerja.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 p-3" style="font-size: 0.85rem;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonan.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Nama Lengkap Sesuai KTP <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control apple-input shadow-sm" required placeholder="Budi Santoso" value="{{ old('nama_lengkap') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Alamat Email Aktif <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control apple-input shadow-sm" required placeholder="budi@contoh.com" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Alamat Domisili <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control apple-input shadow-sm" rows="2" required placeholder="Sesuai KTP / Domisili">{{ old('alamat') }}</textarea>
                </div>
                
                <hr class="my-4">

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Kategori Permohonan <span class="text-danger">*</span></label>
                    <select name="jenis_permohonan" class="form-select apple-input shadow-sm" required>
                        <option value="">Pilih kategori...</option>
                        <option value="Informasi Publik" {{ old('jenis_permohonan') == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik Secara Umum</option>
                        <option value="Data Regulasi" {{ old('jenis_permohonan') == 'Data Regulasi' ? 'selected' : '' }}>Salinan Dokumen Regulasi / SOP</option>
                        <option value="Data Layanan Kesehatan" {{ old('jenis_permohonan') == 'Data Layanan Kesehatan' ? 'selected' : '' }}>Informasi Terkait Layanan Kesehatan</option>
                        <option value="Lainnya" {{ old('jenis_permohonan') == 'Lainnya' ? 'selected' : '' }}>Permintaan Lainnya</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark fs-7">Pesan & Tujuan <span class="text-danger">*</span></label>
                    <textarea name="pesan" class="form-control apple-input shadow-sm" rows="3" required placeholder="Jelaskan spesifik yang Anda butuhkan..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold shadow-lg hover-lift py-2.5" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
                    Kirim Sekarang <i class="bi bi-send-fill ms-1"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Floating Action Button (FAB) -->
    <button class="btn btn-success shadow-lg floating-btn rounded-pill d-flex align-items-center" id="openWidgetBtn" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
        <i class="bi bi-chat-left-text-fill fs-5 me-2"></i>
        <span class="fw-bold">Ajukan Permohonan</span>
    </button>
</div>

<!-- SweetAlert2 untuk Notifikasi Pop-up -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Widget Toggle Logic
        const widgetContainer = document.getElementById('floatingWidgetContainer');
        const openBtn = document.getElementById('openWidgetBtn');
        const closeBtn = document.getElementById('closeWidgetBtn');
        
        // Open Widget if there are errors so user can see them
        @if($errors->any())
            widgetContainer.classList.add('widget-open');
        @endif
        
        if (openBtn) {
            openBtn.addEventListener('click', function() {
                widgetContainer.classList.toggle('widget-open');
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                widgetContainer.classList.remove('widget-open');
            });
        }

        // SweetAlert
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil Terkirim!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Baik, Saya Mengerti',
                confirmButtonColor: '#198754',
                background: '#ffffff',
                backdrop: `rgba(0,0,0,0.5)`,
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'rounded-pill fw-bold px-4'
                }
            });
        @endif
    });

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
.apple-input {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 0.75rem;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}
.apple-input:focus {
    background: #fff;
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15);
    outline: none;
}

/* Floating Widget Styles */
.floating-widget-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.floating-btn {
    padding: 12px 24px;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
.floating-btn:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 15px 25px rgba(25, 135, 84, 0.4) !important;
}

.floating-form-box {
    width: 380px;
    max-width: calc(100vw - 40px);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transform-origin: bottom right;
    transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    border-radius: 1rem;
}

.widget-open .floating-form-box {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.widget-open .floating-btn {
    display: none !important;
}

/* Custom Scrollbar for Widget Body */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8; 
}

.fs-7 {
    font-size: 0.85rem;
}

/* Hover Lift Effect */
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

@media (max-width: 768px) {
    .floating-widget-container {
        position: static;
        padding: 2rem 1rem;
        align-items: center;
    }
    .floating-btn {
        display: none !important;
    }
    .floating-form-box {
        width: 100%;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    #closeWidgetBtn {
        display: none !important;
    }
}

  .transition { transition: all 0.3s ease; }
  .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }

  /* Apple-inspired Aesthetic */
  .apple-glass-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border: 1px solid rgba(255, 255, 255, 0.8);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
      border-radius: 28px;
  }

  .apple-badge {
      background: rgba(25, 135, 84, 0.1);
      color: #198754;
      font-weight: 700;
      font-size: 0.75rem;
      padding: 6px 16px;
      border-radius: 9999px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
  }

  .apple-menu-card {
      background: rgba(248, 249, 250, 0.95);
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 22px;
      transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .apple-menu-card:hover {
      transform: scale(1.03) translateY(-6px);
      background: #ffffff;
      border-color: rgba(25, 135, 84, 0.3);
      box-shadow: 0 20px 35px -10px rgba(25, 135, 84, 0.18) !important;
  }

  .apple-icon-wrapper {
      width: 58px;
      height: 58px;
      border-radius: 18px;
      background: linear-gradient(135deg, #198754 0%, #115c39 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3);
      transition: transform 0.3s ease;
  }

  .apple-menu-card:hover .apple-icon-wrapper {
      transform: scale(1.1) rotate(3deg);
  }

  .apple-pill-btn {
      background: rgba(25, 135, 84, 0.08);
      color: #198754;
      border: 1px solid rgba(25, 135, 84, 0.2);
      border-radius: 9999px;
      transition: all 0.25s ease;
      font-size: 0.8rem;
  }

  .apple-pill-btn:hover {
      background: #198754;
      color: #ffffff;
      box-shadow: 0 6px 15px rgba(25, 135, 84, 0.3);
  }

  /* Responsive Carousel */
  .ppid-carousel-img {
      object-fit: cover;
      height: 450px;
  }

  @media (max-width: 768px) {
      .ppid-carousel-img {
          height: 250px;
      }
      .display-5 {
          font-size: 2rem;
      }
  }

  @media (max-width: 480px) {
      .ppid-carousel-img {
          height: 180px;
      }
  }
</style>
</div>
@endsection