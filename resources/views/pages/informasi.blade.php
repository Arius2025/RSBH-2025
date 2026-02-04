{{-- informasi.blade.php --}}
@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="hero-section position-relative d-flex align-items-center justify-content-center overflow-hidden" 
    style="min-height: 40vh; background: linear-gradient(rgba(25, 135, 84, 0.85), rgba(20, 108, 67, 0.9)), url('{{ asset('images/hero-rs.jpg') }}') center/cover no-repeat;" 
    data-aos="fade-down">
    <div class="container text-center text-white position-relative z-2">
        <h1 class="fw-extrabold display-4 mb-2">Informasi Rumah Sakit</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Mengenal lebih dekat profil, sejarah, dan dedikasi RS Tk. III Baladhika Husada.
        </p>
    </div>
</section>

{{-- 2. SMART STICKY NAVIGATION (Mobile Responsive Fix) --}}
<div class="smart-sticky bg-white shadow-sm border-bottom z-3">
    {{-- Padding 0 di HP agar scroll mentok ujung layar --}}
    <div class="container py-2 px-0 px-md-3"> 
        {{-- 
             Perbaikan: 
             - justify-content-start: Di HP rata kiri (biar bisa discroll)
             - justify-content-lg-center: Di Laptop rata tengah
             - px-3: Memberi napas sedikit di pinggir
        --}}
        <ul class="nav nav-pills justify-content-start justify-content-lg-center flex-nowrap overflow-auto no-scrollbar px-3 px-md-0" id="infoNav">
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#visi-misi">Visi & Misi</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#sejarah">Sejarah</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#organisasi">Organisasi</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#karumkit">Pimpinan</a></li>
        </ul>
    </div>
</div>

<div class="container py-5">
    
    {{-- 3. VISI & MISI --}}
    <section id="visi-misi" class="info-section mb-5 pt-3">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="card h-100 border-0 shadow-lg bg-success text-white rounded-4 overflow-hidden position-relative hover-scale">
                    <div class="card-body p-5 d-flex flex-column justify-content-center text-center">
                        <div class="mb-3 display-1 opacity-25"><i class="bi bi-eye"></i></div>
                        <h2 class="fw-bold mb-3">VISI</h2>
                        <p class="fs-5 lh-base">
                            "Menjadi Rumah Sakit kepercayaan dan kebanggaan Prajurit, PNS dan Keluarganya di wilayah Kodam V/Brawijaya, serta masyarakat Umum di Jember dan sekitarnya."
                        </p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10 p-3">
                        <i class="bi bi-quote display-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-success mb-4 d-flex align-items-center">
                            <i class="bi bi-bullseye me-3 fs-2"></i> MISI KAMI
                        </h3>
                        <div class="d-flex gap-3 mb-4">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">1</div>
                            <div>
                                <h5 class="fw-bold text-dark">Dukungan Kesehatan Handal</h5>
                                <p class="text-muted mb-0">Menyelenggarakan dukungan kesehatan yang responsif dan terpercaya bagi prajurit.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">2</div>
                            <div>
                                <h5 class="fw-bold text-dark">Pelayanan Paripurna</h5>
                                <p class="text-muted mb-0">Memberikan pelayanan kesehatan yang bermutu tinggi dan terjangkau bagi semua lapisan masyarakat.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">3</div>
                            <div>
                                <h5 class="fw-bold text-dark">Profesionalisme Personel</h5>
                                <p class="text-muted mb-0">Meningkatkan kompetensi medis dan non-medis secara berkelanjutan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. SEJARAH --}}
    <section id="sejarah" class="info-section mb-5 pt-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">HISTORIA</span>
            <h2 class="fw-bold text-success">Jejak Langkah Pengabdian</h2>
            <p class="text-muted">Perjalanan panjang institusi kesehatan militer di Jember sejak 1945.</p>
        </div>

        <div class="timeline-wrapper position-relative mx-auto" style="max-width: 800px;">
            <div class="position-absolute start-0 top-0 bottom-0 border-start border-3 border-success ms-3 ms-md-5 opacity-25"></div>
            
            @foreach([
                ['1945', 'Pembentukan DKT Resimen IV', 'DKT dibentuk sebagai institusi kesehatan militer di wilayah Karesidenan Besuki.', 'bi-flag-fill'],
                ['1946', 'Kepemimpinan Pertama', 'Ir. Soekarno menunjuk dr. RM. Soebandi memimpin DKT dengan 25 personel eks Tentara PETA.', 'bi-person-badge-fill'],
                ['1949', 'Gugurnya Pahlawan', 'Letkol dr. Soebandi gugur dalam pertempuran di Karang Kedawung, menjadi simbol semangat juang kami.', 'bi-flower1'],
                ['2006', 'Era Modernisasi', 'Peresmian status baru dan digitalisasi arsip sejarah sebagai landasan pengembangan RS masa depan.', 'bi-building-fill-check']
            ] as $item)
            <div class="d-flex gap-4 mb-5 position-relative" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex-shrink-0">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow border border-4 border-white" style="width: 60px; height: 60px; z-index: 2;">
                        <i class="bi {{ $item[3] }} fs-4"></i>
                    </div>
                </div>
                <div class="card border-0 shadow-sm flex-grow-1 hover-scale rounded-4">
                    <div class="card-body p-4">
                        <span class="badge bg-success-subtle text-success fw-bold mb-2">{{ $item[0] }}</span>
                        <h5 class="fw-bold text-dark">{{ $item[1] }}</h5>
                        <p class="text-muted mb-0">{{ $item[2] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- 5. ORGANISASI --}}
    <section id="organisasi" class="info-section mb-5 pt-5 text-center">
        <h2 class="fw-bold text-success mb-4">Struktur Organisasi</h2>
        <div class="card border-0 shadow-sm rounded-4 p-5 d-inline-block bg-light" style="min-width: 300px;">
             <div class="mb-3 text-muted display-4"><i class="bi bi-diagram-3"></i></div>
             <h5 class="fw-bold text-dark">Bagan Organisasi</h5>
             <p class="text-muted mb-0">Struktur organisasi RS Tk. III Baladhika Husada</p>
        </div>
    </section>

    {{-- 6. RIWAYAT KARUMKIT --}}
    <section id="karumkit" class="info-section mb-5 pt-5">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
            <div>
                <h2 class="fw-bold text-success mb-1">Pimpinan Rumah Sakit</h2>
                <p class="text-muted mb-0">Dedikasi para pemimpin dari masa ke masa.</p>
            </div>
            <div class="d-none d-md-block">
                <a href="#" class="btn btn-outline-success rounded-pill btn-sm" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"><i class="bi bi-arrow-up"></i> Ke Atas</a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach([
                ['Letkol dr. Soebandi', '1946 - 1949'], ['Mayor Cdm dr. Soedjono', '1959 - 1962'],
                ['Mayor Cdm dr. Karno Supojo', '1966 - 1969'], ['Kapten Cdm dr. Sam Pakpahan', '1969 - 1972'],
                ['Kapten Cdm dr. Soedomo Pradono', '1972 - 1973'], ['Mayor Cdm dr. Tom Uripan', '1973 - 1976'],
                ['Mayor Cdm dr. Suryono', '1977 - 1983'], ['Letkol Ckm dr. Koesnan D', '1983 - 1990'],
                ['Mayor Ckm dr. Budiharto', 'Jan - Apr 1991'], ['Mayor Ckm dr. H. Zularnain Pohan', '1991 - 1995'],
                ['Letkol Ckm Drs. Basuki, MS', '1997 - 2001'], ['Letkol Ckm dr. Bambang Haryatno', '2001 - 2004'],
                ['Letkol Ckm dr. Muhammad Ilyas', '2004 - 2006'], ['Letkol Ckm dr. Agus Sunandar', '2006 - 2009'],
                ['Letkol Ckm dr. Trio Tangkas W.M', '2009 - 2013'], ['Letkol Ckm (K) dr. Dwi Ana W', 'Feb - Des 2013'],
                ['Letkol Ckm dr. A Rusli Budi A', '2013 - 2016'], ['Letkol Ckm dr. Masri Sihombing', '2016 - 2018'],
                ['Letkol Ckm dr. Maksum Pandelima', '2018 - 2021'], ['Letkol Ckm dr. Mahyudi', '2021 - 2023'],
                ['Letkol Ckm dr. Arif Puguh Santoso', '2023 - 2025'], ['Letkol Ckm dr. Zaltonys Tolombot', '2025 - Sekarang', 'active']
            ] as $pimpinan)
            <div class="col" data-aos="fade-up" data-aos-delay="50">
                <div class="card h-100 border-0 shadow-sm hover-shadow rounded-3 {{ isset($pimpinan[2]) ? 'bg-success text-white' : 'bg-white' }}">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 {{ isset($pimpinan[2]) ? 'bg-white text-success' : 'bg-light text-secondary' }}" style="width: 50px; height: 50px;">
                                {{ substr($pimpinan[0], 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 {{ isset($pimpinan[2]) ? 'text-white' : 'text-dark' }}">{{ $pimpinan[0] }}</h6>
                            <small class="{{ isset($pimpinan[2]) ? 'text-white-50' : 'text-muted' }}"><i class="bi bi-calendar-event me-1"></i> {{ $pimpinan[1] }}</small>
                        </div>
                        @if(isset($pimpinan[2]))
                        <div class="ms-auto">
                            <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Aktif</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</div>

<style>
    /* 1. CSS SMART STICKY */
    .smart-sticky {
        position: sticky;
        top: 70px; /* Default Desktop */
        transition: top 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
    }

    /* Penyesuaian Mobile: Nempel di atas (top:0) karena navbar utama mungkin hilang/scroll */
    @media (max-width: 992px) {
        .smart-sticky {
            top: 0; 
            padding-top: 10px;
        }
    }

    /* 2. NAV PILLS STYLING (FIX TAMPILAN BULAT DI MOBILE) */
    .nav-pills { gap: 5px; }

    .nav-pills .nav-link { 
        border-radius: 50px; 
        padding: 8px 20px; 
        color: #198754; 
        transition: all 0.3s; 
        border: 1px solid transparent;
        white-space: nowrap; /* PENTING: Mencegah teks turun baris */
        font-size: 0.95rem;
    }

    .nav-pills .nav-link:hover {
        background-color: rgba(25, 135, 84, 0.1);
    }

    /* State Active */
    .nav-pills .nav-link.active {
        background-color: #198754; 
        color: white !important; 
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
    }

    /* 3. SCROLL & UTILITY */
    .info-section { scroll-margin-top: 160px; } /* Jarak aman scroll */

    /* Sembunyikan Scrollbar Horizontal tapi tetap bisa swipe */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    .hover-scale { transition: transform 0.2s ease; }
    .hover-scale:hover { transform: translateY(-3px); }

    /* Khusus Layar Kecil (Mobile) */
    @media (max-width: 576px) {
        .nav-pills .nav-link {
            padding: 6px 16px; 
            font-size: 0.85rem;
        }
        .info-section { scroll-margin-top: 120px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. JS SCROLLSPY (Deteksi Bagian Aktif) ---
        const sections = document.querySelectorAll('.info-section');
        const navLinks = document.querySelectorAll('.nav-scroll');

        function onScroll() {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                // Offset 180px untuk kompensasi tinggi navbar + sticky menu
                if (window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                    
                    // Auto scroll menu horizontal agar tombol aktif selalu terlihat
                    const menuContainer = document.getElementById('infoNav');
                    if(menuContainer && window.innerWidth < 992) {
                        const activeLinkLeft = link.offsetLeft;
                        const containerWidth = menuContainer.clientWidth;
                        // Center the active link
                        menuContainer.scrollLeft = activeLinkLeft - (containerWidth / 2) + (link.clientWidth / 2);
                    }
                }
            });
        }

        window.addEventListener('scroll', onScroll);

        // --- 2. SMOOTH SCROLL CLICK FIX ---
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if(targetSection) {
                    const offsetTop = targetSection.offsetTop - 140; 
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>

@endsection