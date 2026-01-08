<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RS Tk. III Baladhika Husada') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{-- Custom Styles --}}
        <style>
/* ========================================= */
/* UTILITY & GENERAL */
/* ========================================= */

body {
  background-color: #E6F4EA; /* Warna latar yang lebih lembut */
  min-height: 100vh;
  /* PENTING: Padding untuk fixed-top navbar agar konten tidak tertutup */
  padding-top: 60px; 
}

.transition {
  transition: all 0.3s ease;
}

/* Efek angkat dan bayangan kuat saat hover */
.hover-shadow:hover, .card.hover-shadow:hover {
  transform: translateY(-5px); 
  box-shadow: 0 12px 28px rgba(0,0,0,0.2)!important; /* Bayangan lebih kuat */
}

/* Text Shadow for Hero */
.text-shadow {
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

/* ========================================= */
/* NAVBAR CUSTOM (Desktop) */
/* ========================================= */

/* ========================================= */
    /* 1. SHARED & DESKTOP STYLES                */
    /* ========================================= */
    .navbar-custom {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: rgba(255, 255, 255, 0.8) !important; /* Lebih Transparan */
        backdrop-filter: blur(8px); /* Efek blur halus */
        -webkit-backdrop-filter: blur(8px);
        padding: 10px 0; /* Lebih tipis */
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Efek Ramping saat Scroll */
    .navbar-scrolled {
        padding: 5px 0 !important;
        background-color: rgba(255, 255, 255, 0.95) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    }

    /* Nav Links Styling */
    .nav-link-custom {
        font-weight: 600;
        color: #444 !important;
        padding: 6px 15px !important;
        margin: 0 2px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        border-radius: 8px;
    }

    .nav-link-custom:hover {
        color: #2ecc71 !important;
        background: rgba(46, 204, 113, 0.1);
    }

    .nav-link-custom.active {
        color: #ffffff !important;
        background-color: #2ecc71;
    }

    /* Dropdown Animasi Halus */
    @media (min-width: 992px) {
        .dropdown-menu {
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.25s ease;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            margin-top: 8px !important;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    }

    .nav-link-custom-sub {
        font-size: 0.88rem;
        padding: 8px 15px;
        color: #555;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .nav-link-custom-sub:hover {
        background: #f1fcf4;
        color: #2ecc71;
        padding-left: 20px;
    }

/* ========================================= */
/* NAVBAR MOBILE (Fixed Bottom) */
/* ========================================= */

.nav-link-mobile {
  color: #3498db;
  text-align: center;
  padding: 10px 0;
  text-decoration: none;
  font-size: 1.5rem;
  transition: all 0.3s;
  flex-grow: 1;
}

.nav-link-mobile .small {
    font-size: 0.7rem!important;
    font-weight: 600;
    margin-top: -5px;
}

.nav-link-mobile.active-mobile {
  color: #2ecc71; /* Warna hijau sukses untuk aktif */
  border-top: 3px solid #2ecc71;
}

/* ========================================= */
/* HERO SECTION - Updated for 2 Columns */
/* ========================================= */

.hero-section {
  position: relative;
  height: 500px; 
  background: url('images/rumah sakit dkt.jpg') no-repeat center center/cover;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  display: flex;
  align-items: center; 
}

/* Penyesuaian untuk tampilan mobile */
@media (max-width: 992px) {
  .hero-section {
    height: 380px; 
    align-items: flex-end; 
  }
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 50, 0, 0.65); /* Darker overlay */
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 0 15px; 
}

/* ========================================= */
/* KOREKSI HERO BUTTONS MOBILE */
/* ========================================= */

/* Target perangkat dengan lebar layar hingga 768px (Mobile & Tablet kecil) */
@media (max-width: 768px) {
  
  /* Target tombol yang berada di dalam hero-content */
  .hero-content .btn-lg {
    /* Mengganti ukuran padding dan font yang setara dengan btn-sm atau btn-md */
    padding: 8px 15px; 
    font-size: 0.9rem;
    
    /* Memastikan tombol menggunakan lebar penuh pada container sangat kecil */
    width: 100%; 
    margin-bottom: 10px; 
  }
  
  /* Memastikan tombol mengambil ruang penuh dan terpisah jika berdampingan */
  .hero-content .d-flex {
    flex-direction: column; /* Tumpuk tombol secara vertikal */
    gap: 10px !important;
  }
}


/* ========================================= */
/* TENTANG KAMI CARD */
/* ========================================= */
.tentang-kami-card {
  display: flex;
  flex-direction: row;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.tentang-kami-img {
  background-color: #2ecc71; /* Warna hijau solid */
  padding: 40px;
  flex: 0 0 35%; 
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.karumkit-photo-wrapper {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  overflow: hidden;
  border: 5px solid rgba(255, 255, 255, 0.7);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.karumkit-photo-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.tentang-kami-content {
  background-color: #fff;
  flex: 1; 
}

@media (max-width: 768px) {
  .tentang-kami-card {
    flex-direction: column; 
  }
  .tentang-kami-img {
    flex: 0 0 100%;
    padding: 30px;
  }
}

/* ========================================= */
/* AUTO-SCROLL GALERI CSS */
/* ========================================= */

.galeri-carousel {
  /* Pastikan overflow-x: auto; */
  overflow-x: hidden; /* Ganti auto menjadi hidden saat menggunakan JS scroll */
  white-space: nowrap;
  padding-bottom: 10px; 
}

/* Tambahkan kelas untuk animasi JS */
.is-scrolling {
  scroll-behavior: smooth;
}

/* Jika Anda ingin menggunakan CSS Animation Murni (Lebih sulit untuk dikontrol)
.galeri-track {
    animation: scroll-left 30s linear infinite;
}

@keyframes scroll-left {
  from { transform: translateX(0); }
  to { transform: translateX(-50%); } 
}
*/

/* ========================================= */
/* GALERI SECTION (Horizontal Scroll) */
/* ========================================= */
.galeri-section {
    background-color: #f9f9f9;
    padding-top: 50px;
    padding-bottom: 50px;
    margin-top: 30px;
}

.galeri-carousel {
  overflow-x: auto;
  white-space: nowrap;
  padding-bottom: 10px; 
}

.galeri-track {
  display: inline-flex;
  gap: 15px;
  padding: 0 15px;
}

.galeri-track img {
  width: 300px; 
  height: 200px; 
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
}

.galeri-track img:hover {
    transform: scale(1.03);
}

/* ========================================= */
/* TESTIMONI SECTION */
/* ========================================= */
.testimoni-section {
    background: linear-gradient(135deg, #1abc9c, #2ecc71); /* Gradient hijau segar */
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    margin-top: 40px;
}

.testimoni-slider {
  display: flex;
  gap: 30px;
  justify-content: center;
  flex-wrap: wrap;
}

.testimoni-card {
  background: #ffffff;
  border-left: 5px solid #f39c12; /* Garis kuning untuk kesan penting */
  border-radius: 10px;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
  padding: 30px;
  max-width: 350px;
  text-align: left;
}

.testimoni-card .quote {
  font-style: italic;
  color: #34495e;
  margin-bottom: 15px;
  line-height: 1.6;
}

.testimoni-card .name {
  font-weight: 700;
  color: #2c3e50;
  margin-top: 15px;
  border-top: 1px dashed #ecf0f1;
  padding-top: 10px;
}


/* ========================================= */
/* SPLASH & LOADER SCREENS */
/* ========================================= */
/* Menghapus atau mengomentari #splash dan #loader (atau pastikan Anda tidak menggunakannya) 
   adalah langkah terbaik jika konten hilang total */
/*
#splash {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: linear-gradient(45deg, #2ecc71, #1abc9c);
  color: white;
  z-index: 10000;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  opacity: 1;
  transition: opacity 0.8s ease;
}

#splash h1 {
  font-size: 2.5rem;
  font-weight: bold;
}

#splash p {
    font-style: italic;
}

#loader {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-color: rgba(230, 244, 234, 0.85);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 1;
  transition: opacity 0.8s ease;
}

#splash.fade-out, #loader.fade-out {
  opacity: 0;
  pointer-events: none;
}
*/
  </style>
        
        @stack('styles')
    </head>
    
    <body class="font-sans antialiased">
        {{-- Jika Anda masih menggunakan div#splash dan div#loader di body, 
             pastikan Anda menghapusnya untuk sementara waktu agar konten utama (@yield('content')) terlihat --}}

        {{-- 1. NAVBAR (Perbaikan path include) --}}
        @include('components.navbar')

        {{-- 2. HEADER/HEADING --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- 3. KONTEN UTAMA (Page Content) --}}
        <main class="min-h-screen"> 
            @yield('content') 
        </main>
        
        {{-- 4. FOOTER --}}
        @include('components.footer')

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        {{-- AOS JS --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ once: true, offset: 100, duration: 800 });

            // Highlight active nav (DESKTOP)
            document.querySelectorAll('.nav-link-custom').forEach(link => {
                
                // *** PENTING: Filter Wajib agar dropdown tidak nge-bug ***
                // Abaikan link yang merupakan tombol dropdown.
                if (link.hasAttribute('data-bs-toggle') || link.classList.contains('dropdown-toggle')) {
                    return; 
                }
                // ************************

                // Membandingkan path (Hapus trailing slash untuk perbandingan yang akurat)
                const currentPath = window.location.pathname.replace(/\//g, ""); // Hapus semua slash
                const linkPath = new URL(link.href).pathname.replace(/\//g, ""); // Hapus semua slash
                
                // Tambahkan konsol log jika masih bermasalah untuk debugging
                // console.log(`Path: ${linkPath} | Current: ${currentPath} | Match: ${linkPath === currentPath}`);

                if (linkPath === currentPath) {
                    link.classList.add('active');
                }
            });

            // Logic untuk nav mobile
            document.querySelectorAll('.nav-link-mobile').forEach(link => {
                const currentPath = window.location.pathname.replace(/\//g, "");
                const linkPath = new URL(link.href).pathname.replace(/\//g, "");

                if (linkPath === currentPath) {
                    link.classList.add('active-mobile');
                }
            });
            
            // =========================================
// LOGIC AUTO-SCROLL GALERI
// =========================================
const galeriCarousel = document.querySelector('.galeri-carousel');

if (galeriCarousel) {
    // Kecepatan (semakin kecil angkanya, semakin cepat scrolling)
    const scrollSpeed = 50; 
    let scrollInterval;
    let scrollPosition = 0;
    
    // Fungsi untuk menggeser
    function autoScroll() {
        // Tambahkan kelas untuk transisi halus
        galeriCarousel.classList.add('is-scrolling');
        
        // Pindah 1 piksel ke kanan
        scrollPosition += 1; 

        // Atur posisi scroll
        galeriCarousel.scrollLeft = scrollPosition;

        // Cek jika sudah mencapai akhir scroll, kembalikan ke awal
        // scrollWidth adalah total lebar konten, clientWidth adalah lebar viewport
        if (scrollPosition >= (galeriCarousel.scrollWidth - galeriCarousel.clientWidth)) {
            // Setelah mencapai ujung, geser cepat ke awal tanpa animasi
            galeriCarousel.classList.remove('is-scrolling');
            galeriCarousel.scrollLeft = 0;
            scrollPosition = 0;
            // Setelah reset, beri jeda singkat sebelum memulai animasi lagi
            setTimeout(() => {
                galeriCarousel.classList.add('is-scrolling');
            }, 50); 
        }
    }

    // Mulai scrolling saat halaman dimuat
    scrollInterval = setInterval(autoScroll, scrollSpeed);
    
    // Hentikan scroll saat mouse diarahkan (hover)
    galeriCarousel.addEventListener('mouseenter', () => {
        clearInterval(scrollInterval);
    });

    // Lanjutkan scroll saat mouse menjauh
    galeriCarousel.addEventListener('mouseleave', () => {
        scrollInterval = setInterval(autoScroll, scrollSpeed);
    });
}
    // JS Minimalis untuk Scroll Effect
    (function() {
        const nav = document.getElementById('desktopNav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                nav.classList.add('navbar-scrolled');
            } else {
                nav.classList.remove('navbar-scrolled');
            }
        });
    })();
// ------------------------------------

            // Logic Splash Screen dihapus
        </script>
        @stack('scripts')
    </body>
</html>