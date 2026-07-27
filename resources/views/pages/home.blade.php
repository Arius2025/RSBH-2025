{{-- home.blade.php --}}
@extends('layouts.app')

@push('styles')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Manrope:wght@600;700&family=JetBrains+Mono:wght@500&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
  tailwind.config = {
    darkMode: "class",
    corePlugins: {
      preflight: false,
    },
    theme: {
      extend: {
        "colors": {
            "on-surface": "#1a1c1a",
            "on-tertiary-fixed": "#331111",
            "secondary": "#735c00",
            "tertiary": "#401b1b",
            "error-container": "#ffdad6",
            "on-primary-fixed-variant": "#274e3d",
            "gold-light": "#F1E4B3",
            "surface-container": "#eeeeeb",
            "surface-variant": "#e2e3e0",
            "secondary-fixed-dim": "#e9c349",
            "outline-variant": "#c1c8c2",
            "surface-bright": "#f9faf6",
            "on-secondary-fixed": "#241a00",
            "surface-container-low": "#f3f4f1",
            "tertiary-fixed": "#ffdad8",
            "military-green-dark": "#081C15",
            "secondary-container": "#fed65b",
            "surface-tint": "#3f6653",
            "on-tertiary-fixed-variant": "#673a39",
            "surface": "#f9faf6",
            "primary-fixed-dim": "#a5d0b9",
            "on-tertiary-container": "#d29895",
            "surface-container-high": "#e8e8e5",
            "inverse-on-surface": "#f0f1ee",
            "on-error-container": "#93000a",
            "surface-container-highest": "#e2e3e0",
            "inverse-surface": "#2f312f",
            "on-surface-variant": "#414844",
            "surface-container-lowest": "#ffffff",
            "on-tertiary": "#ffffff",
            "on-background": "#1a1c1a",
            "primary": "#012d1d",
            "background": "#f9faf6",
            "on-error": "#ffffff",
            "hospital-white": "#F8F9FA",
            "error": "#ba1a1a",
            "outline": "#717973",
            "on-secondary-container": "#745c00",
            "on-primary-container": "#86af99",
            "emergency-red": "#D00000",
            "tertiary-container": "#5a302f",
            "inverse-primary": "#a5d0b9",
            "surface-dim": "#dadad7",
            "on-secondary-fixed-variant": "#574500",
            "primary-fixed": "#c1ecd4",
            "on-primary": "#ffffff",
            "secondary-fixed": "#ffe088",
            "tertiary-fixed-dim": "#f5b7b4",
            "on-secondary": "#ffffff",
            "primary-container": "#1b4332",
            "on-primary-fixed": "#002114"
        },
        "borderRadius": {
            "DEFAULT": "0.125rem",
            "lg": "0.25rem",
            "xl": "0.5rem",
            "full": "0.75rem"
        },
        "spacing": {
            "gutter": "24px",
            "section-gap": "80px",
            "unit": "8px",
            "margin-mobile": "16px",
            "container-max": "1280px"
        },
        "fontFamily": {
            "body-md": ["Inter"],
            "headline-lg": ["Manrope"],
            "headline-lg-mobile": ["Manrope"],
            "label-caps": ["JetBrains Mono"],
            "headline-xl": ["Manrope"]
        },
        "fontSize": {
            "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
            "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
            "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
            "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "500"}],
            "headline-xl": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
        }
      }
    }
  }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .text-glow-gold { text-shadow: 0 0 10px rgba(241, 228, 179, 0.4); }
    .bento-card { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease; }
    .bento-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -10px rgba(0,0,0,0.1); }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    
    /* MODAL STYLING */
    #infoModal {
        z-index: 999999 !important;
    }
    #infoModal .modal-content {
        border-radius: 1.5rem !important;
        border: none !important;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    #infoModal .news-side-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        min-height: 500px;
    }
    .modal-backdrop {
        z-index: 999998 !important;
    }
    
    /* Perbaikan Reset CSS sementara karena preflight dimatikan */
    .tw-section h1, .tw-section h2, .tw-section h3, .tw-section h4 {
        margin: 0;
    }
    .tw-section ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .tw-section a {
        text-decoration: none;
    }
    .tw-section p {
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')

<!-- Wrapper untuk mengisolasi class Tailwind -->
<div class="tw-section bg-background text-on-surface font-body-md overflow-x-hidden">

<!-- Hero Section -->
<section class="relative h-[85vh] min-h-[600px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img alt="" class="w-full h-full object-cover brightness-50" src="https://lh3.googleusercontent.com/aida/AP1WRLuFO46QgXxyCWB0W45OS3xEHJuTT7bg9KfwSJ79IXYjzyyqwA_Fx6t3JDfA-bkJJAMtYDktuG-Fl4zqnYM69BjjST1fQDMCW3BU5fhGLgaOyOIn5VaaNqME6GvgnqlNgTQNHqVHYCP_-k24wzOsg-iUBStkf5zQW07MIdc7JY_m76R63a1Bymk7NJNSTGXbCg7mxn1HXaAgB_BQw-LvXxGjjUcz65a92iNKsollTwZ8C0WKU89v4Reo-Nc"/>
<div class="absolute inset-0 bg-gradient-to-r from-military-green-dark/80 to-transparent"></div>
</div>
<div class="relative z-10 max-w-container-max mx-auto px-gutter w-full">
<div class="max-w-2xl text-white">
<div class="flex items-center gap-2 mb-6">
<span class="w-12 h-[2px] bg-gold-light"></span>
<span class="font-label-caps text-gold-light">SIGAP • PROFESIONAL • EMPATI</span>
</div>
<h1 class="font-headline-xl text-headline-xl mb-6 leading-tight">RS Tk. III Baladhika Husada</h1>
<p class="font-body-md text-body-md mb-10 text-surface-variant opacity-90 leading-relaxed">
                    Melayani Prajurit TNI/POLRI, ASN, dan masyarakat umum dengan fasilitas modern dan kehangatan sepenuh hati. Terakreditasi Paripurna untuk kenyamanan dan keselamatan Anda.
                </p>
<div class="flex flex-col sm:flex-row gap-4">
<a href="{{ route('jadwal') }}" class="px-8 py-4 bg-primary-fixed text-primary font-bold rounded flex items-center justify-center gap-2 hover:bg-gold-light transition-all no-underline">
<span class="material-symbols-outlined">calendar_month</span>
                        JADWAL DOKTER
</a>
<a href="{{ route('ambulance') }}" class="px-8 py-4 border border-white text-white font-bold rounded flex items-center justify-center gap-2 hover:bg-white/10 transition-all no-underline">
<span class="material-symbols-outlined">phone_in_talk</span>
                        KONTAK IGD
</a>
</div>
</div>
</div>
<!-- Status Bar -->
<div class="absolute bottom-0 left-0 w-full bg-white/10 backdrop-blur-md border-t border-white/20 py-4">
<div class="max-w-container-max mx-auto px-gutter flex flex-wrap gap-8 justify-between text-white">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></span>
<span class="font-label-caps text-white text-decoration-none">IGD 24 JAM SIAGA</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-gold-light">verified</span>
<span class="font-label-caps text-white">AKREDITASI PARIPURNA</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-gold-light">medical_services</span>
<span class="font-label-caps text-white">MITRA BPJS KESEHATAN</span>
</div>
</div>
</div>
</section>

<!-- SITERBAT Service Section -->
<section class="py-section-gap bg-hospital-white overflow-hidden">
<div class="max-w-container-max mx-auto px-gutter">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
<div class="relative">
<div class="aspect-square rounded-xl overflow-hidden shadow-2xl">
<img alt="" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida/AP1WRLvWnuAJ6ZyKLTTh4YxgF5K81h84b8i11zsEV1Znuo9Xu5ZFa3YpOhwRSvi5sqBjL5hVHL9lESFgfVgBfkJ6SjBfq3iLboxTu2Ooqo-K3M6uO6nVvdqfWHKqnQXBKWsDiVSVGjq2lCtNlB7ym1ry_5X08cuN2gZ1VmZbdJi7CrCymDQLyGZc23UUjlJMBkpBCv9NY3kwCq174V23QJzTHG6KXqf_6LqR_id4Fp25QXmJjvn7SqV5SPeMpaM"/>
</div>
<div class="absolute -bottom-8 -right-8 bg-military-green-dark p-8 rounded-xl shadow-xl max-w-xs text-white">
<h4 class="font-headline-lg text-headline-lg-mobile text-gold-light mb-2">SITERBAT</h4>
<p class="font-body-md text-sm opacity-80">Siap Antar Obat - Tanpa Antri, Khusus Pasien Geriatri &amp; Purnawirawan.</p>
</div>
</div>
<div class="space-y-8">
<div>
<span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary-container font-label-caps rounded mb-4">LAYANAN UNGGULAN SIGAP</span>
<h2 class="font-headline-xl text-headline-lg mb-6 text-primary">Malas Antri Obat?</h2>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                            Kami memahami waktu Anda berharga. Melalui inovasi SITERBAT, RS Baladhika Husada menghadirkan kemudahan pengambilan obat bagi pasien prioritas. Obat akan diantar langsung ke depan pintu rumah Anda dengan pengawasan apoteker profesional.
                        </p>
</div>
<ul class="space-y-4 font-label-caps text-primary m-0 p-0" style="list-style: none;">
<li class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary">check_circle</span> 01. KHUSUS GERIATRI &amp; PURNAWIRAWAN
                        </li>
<li class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary">check_circle</span> 02. PENGIRIMAN CEPAT &amp; AMAN
                        </li>
<li class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary">check_circle</span> 03. TANPA ANTRI DI APOTEK
                        </li>
</ul>
<a class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white font-bold rounded-lg group transition-all hover:pr-10 no-underline" href="{{ route('siterbat') }}">
                        COBA SITERBAT SEKARANG
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-2">arrow_forward</span>
</a>
</div>
</div>
</div>
</section>

<!-- Bento Box Facilities Gallery -->
<section class="bg-military-green-dark py-section-gap overflow-hidden">
<div class="max-w-container-max mx-auto px-gutter mb-12">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="space-y-2">
<span class="font-label-caps text-gold-light tracking-widest block">INFRASTRUKTUR &amp; TEKNOLOGI</span>
<h2 class="font-headline-xl text-white text-headline-xl">Fasilitas Unggulan</h2>
</div>
<div class="flex flex-wrap gap-x-8 gap-y-4 items-center border-b border-white/10 pb-4 md:pb-0 md:border-b-0">
<button class="nav-item active group flex flex-col items-start gap-1 cursor-pointer transition-all bg-transparent border-0" onclick="scrollToSlide(0)" id="btn-slide-0">
<span class="font-label-caps text-xs text-surface-variant group-hover:text-gold-light transition-colors">01. LOGISTIK</span>
<span class="text-white font-bold tracking-tight" id="text-slide-0" style="color: #F1E4B3;">AMBULAN</span>
<div class="gallery-active-line bg-gold-light h-1 w-full mt-1 transition-all" id="line-slide-0"></div>
</button>
<button class="nav-item group flex flex-col items-start gap-1 cursor-pointer transition-all bg-transparent border-0" onclick="scrollToSlide(1)" id="btn-slide-1">
<span class="font-label-caps text-xs text-surface-variant group-hover:text-gold-light transition-colors">02. RAWAT INAP</span>
<span class="text-white font-bold tracking-tight" id="text-slide-1">KAMAR VIP</span>
<div class="gallery-active-line bg-transparent h-1 w-0 mt-1 transition-all" id="line-slide-1"></div>
</button>
<button class="nav-item group flex flex-col items-start gap-1 cursor-pointer transition-all bg-transparent border-0" onclick="scrollToSlide(2)" id="btn-slide-2">
<span class="font-label-caps text-xs text-surface-variant group-hover:text-gold-light transition-colors">03. DIAGNOSTIK</span>
<span class="text-white font-bold tracking-tight" id="text-slide-2">LABORATORIUM</span>
<div class="gallery-active-line bg-transparent h-1 w-0 mt-1 transition-all" id="line-slide-2"></div>
</button>
<button class="nav-item group flex flex-col items-start gap-1 cursor-pointer transition-all bg-transparent border-0" onclick="scrollToSlide(3)" id="btn-slide-3">
<span class="font-label-caps text-xs text-surface-variant group-hover:text-gold-light transition-colors">04. PELAYANAN</span>
<span class="text-white font-bold tracking-tight" id="text-slide-3">POLIKLINIK</span>
<div class="gallery-active-line bg-transparent h-1 w-0 mt-1 transition-all" id="line-slide-3"></div>
</button>
</div>
</div>
</div>
<div class="relative w-full max-w-[1440px] mx-auto px-gutter">
<div class="flex overflow-x-hidden snap-x snap-mandatory hide-scrollbar gap-0 scroll-smooth rounded-2xl" id="facility-slider-container">
<!-- Slide 1 -->
<div class="min-w-full snap-center relative aspect-[21/9] min-h-[400px] group overflow-hidden" id="slide-0">
<img alt="Ambulan" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ asset('images/fasilitas/ambulan.jpeg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-military-green-dark via-military-green-dark/20 to-transparent flex flex-col justify-end p-8 md:p-16">
<h3 class="font-headline-xl text-white text-4xl md:text-6xl mb-4 max-w-2xl leading-tight">Ambulan Siaga 24 Jam</h3>
<p class="text-surface-variant max-w-xl font-body-md opacity-80">Siap merespon keadaan darurat dengan peralatan medis lengkap dan tim medis yang terlatih secara sigap dan profesional.</p>
</div>
</div>
<!-- Slide 2 -->
<div class="min-w-full snap-center relative aspect-[21/9] min-h-[400px] group overflow-hidden" id="slide-1">
<img alt="Kamar VIP" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ asset('images/fasilitas/kamar.jpeg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-military-green-dark via-military-green-dark/20 to-transparent flex flex-col justify-end p-8 md:p-16">
<h3 class="font-headline-xl text-white text-4xl md:text-6xl mb-4 max-w-2xl leading-tight">Ruang Perawatan Nyaman</h3>
<p class="text-surface-variant max-w-xl font-body-md opacity-80">Fasilitas kamar yang mengutamakan privasi, kenyamanan, dan pemulihan optimal bagi pasien.</p>
</div>
</div>
<!-- Slide 3 -->
<div class="min-w-full snap-center relative aspect-[21/9] min-h-[400px] group overflow-hidden" id="slide-2">
<img alt="Laboratorium" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ asset('images/fasilitas/lab.jpeg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-military-green-dark via-military-green-dark/20 to-transparent flex flex-col justify-end p-8 md:p-16">
<h3 class="font-headline-xl text-white text-4xl md:text-6xl mb-4 max-w-2xl leading-tight">Laboratorium Modern</h3>
<p class="text-surface-variant max-w-xl font-body-md opacity-80">Didukung oleh peralatan diagnosa canggih dan tenaga analis yang kompeten untuk hasil yang akurat.</p>
</div>
</div>
<!-- Slide 4 -->
<div class="min-w-full snap-center relative aspect-[21/9] min-h-[400px] group overflow-hidden" id="slide-3">
<img alt="Poliklinik" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ asset('images/fasilitas/poli1.jpeg') }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-military-green-dark via-military-green-dark/20 to-transparent flex flex-col justify-end p-8 md:p-16">
<h3 class="font-headline-xl text-white text-4xl md:text-6xl mb-4 max-w-2xl leading-tight">Layanan Poliklinik Terpadu</h3>
<p class="text-surface-variant max-w-xl font-body-md opacity-80">Menyediakan berbagai poliklinik spesialis dengan pelayanan yang ramah, informatif, dan tanpa antrean panjang.</p>
</div>
</div>
</div>
<button onclick="scrollSlider('left')" class="absolute left-12 top-1/2 -translate-y-1/2 w-16 h-16 rounded-full border border-white/20 bg-military-green-dark/30 backdrop-blur-sm text-white flex items-center justify-center hover:bg-gold-light hover:text-military-green-dark transition-all hidden md:flex cursor-pointer">
<span class="material-symbols-outlined text-3xl">chevron_left</span>
</button>
<button onclick="scrollSlider('right')" class="absolute right-12 top-1/2 -translate-y-1/2 w-16 h-16 rounded-full border border-white/20 bg-military-green-dark/30 backdrop-blur-sm text-white flex items-center justify-center hover:bg-gold-light hover:text-military-green-dark transition-all hidden md:flex cursor-pointer">
<span class="material-symbols-outlined text-3xl">chevron_right</span>
</button>
</div>
</section>

<!-- Profil Pimpinan -->
<section class="py-section-gap bg-military-green-dark text-white overflow-hidden relative">
<div class="max-w-container-max mx-auto px-gutter relative z-10">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
<div class="lg:col-span-5 order-2 lg:order-1 text-center">
<div class="relative inline-block mb-8">
<div class="absolute -top-4 -left-4 w-24 h-24 border-t-4 border-l-4 border-gold-light"></div>
<img alt="Letkol CKM dr. Zaltonys Tolombot, Sp.M" class="relative z-10 w-full max-w-sm mx-auto rounded-lg shadow-2xl filter brightness-110" src="{{ asset('images/Karumkit (2).png') }}"/>
<div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-4 border-r-4 border-gold-light"></div>
</div>
<div class="mt-4">
<span class="text-gold-light font-label-caps tracking-widest block mb-2">KEPALA RUMAH SAKIT</span>
<h2 class="font-headline-xl text-3xl md:text-4xl leading-tight m-0">Letkol CKM dr. Zaltonys Tolombot, Sp.M</h2>
</div>
</div>
<div class="lg:col-span-7 order-1 lg:order-2 space-y-8 flex flex-col justify-center">
<blockquote class="font-body-md italic text-xl md:text-2xl text-surface-variant opacity-90 border-l-4 border-gold-light pl-6 py-2 leading-relaxed m-0">
                        "Rumah Sakit Tk. III Baladhika Husada Jember berkomitmen memberikan pelayanan kesehatan prima bagi prajurit TNI, PNS, keluarga, serta masyarakat umum dengan profesionalisme tinggi dan empati mendalam."
                    </blockquote>
<div class="grid grid-cols-2 gap-8 pt-8 border-t border-white/10">
<div>
<p class="text-gold-light font-headline-lg text-2xl m-0">SIGAP</p>
<p class="text-xs text-surface-variant/70 font-label-caps m-0">Fast Response &amp; Alert</p>
</div>
<div>
<p class="text-gold-light font-headline-lg text-2xl m-0">PROFESIONAL</p>
<p class="text-xs text-surface-variant/70 font-label-caps m-0">Excellence in Service</p>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- Berita Terbaru -->
<section class="py-section-gap bg-hospital-white">
<div class="max-w-container-max mx-auto px-gutter">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <span class="text-secondary font-label-caps tracking-widest block mb-2">UPDATE INFORMASI</span>
            <h2 class="font-headline-xl text-headline-lg text-primary m-0">Berita & Artikel</h2>
        </div>
        <a href="{{ route('berita') }}" class="px-6 py-3 border border-primary text-primary font-bold rounded hover:bg-primary hover:text-white transition-all no-underline text-center">LIHAT SEMUA BERITA</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @if(isset($beritas) && count($beritas) > 0)
            @foreach(collect($beritas)->take(3) as $berita)
            <div class="bg-white rounded-xl overflow-hidden border border-outline-variant shadow-sm hover:shadow-xl transition-all group flex flex-col h-full bento-card">
                <div class="relative h-48 overflow-hidden bg-surface-container">
                    @if(isset($berita->type) && $berita->type == 'VIDEO')
                        <video class="berita-video w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" muted loop playsinline preload="metadata">
                            <source src="{{ $berita->img }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ $berita->img ?? asset('images/hero-rs.jpg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="News Image">
                    @endif
                    <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded">INFO</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <p class="font-body-md text-on-surface-variant mb-4 text-sm" style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ strip_tags($berita->caption ?? $berita->isi ?? 'Informasi terbaru seputar layanan dan kegiatan di RS Baladhika Husada.') }}
                    </p>
                    <div class="mt-auto pt-4 border-t border-outline-variant/30 flex justify-between items-center">
                        <a href="{{ $berita->permalink ?? $berita->url ?? '#' }}" target="_blank" class="text-secondary font-bold text-sm flex items-center gap-1 hover:text-primary no-underline">
                            Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-outline-variant">
                <span class="material-symbols-outlined text-4xl text-surface-variant mb-2">newspaper</span>
                <p class="text-on-surface-variant m-0">Belum ada berita terbaru saat ini.</p>
            </div>
        @endif
    </div>
</div>
</section>

<!-- Testimoni Pasien -->
<section class="py-section-gap bg-surface">
<div class="max-w-container-max mx-auto px-gutter">
<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
<div>
<h2 class="font-headline-xl text-headline-lg text-primary m-0">Apa Kata Pasien Kami?</h2>
<p class="text-on-surface-variant mt-2 m-0">Dukungan Anda adalah motivasi terbesar bagi kami untuk terus melayani.</p>
</div>
<div class="bg-white p-4 rounded-xl shadow-sm border border-outline-variant flex items-center gap-4">
<div class="text-secondary flex items-center gap-1">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="font-bold text-xl text-secondary">4.8</span>
</div>
<div class="h-8 w-[1px] bg-outline-variant"></div>
<div class="text-xs font-label-caps text-on-surface-variant">
                        GOOGLE MAPS REVIEWS
                    </div>
</div>
</div>
<div class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory hide-scrollbar" id="testimonial-slider-container">
    
    @php
        $reviews = [
            ["Budi Santoso", "Peserta BPJS", "Pelayanan sangat memuaskan, perawatnya ramah dan cekatan. Saya pakai BPJS tidak dipersulit sama sekali.", "BS"],
            ["Siti Aminah", "Pasien Umum", "IGD siaga 24 jam. Langsung ditangani saat itu juga dengan fasilitas lengkap. Mantap RS DKT Jember.", "SA"],
            ["Rahmat Hidayat", "Keluarga Pasien", "Ruang perawatannya sangat bersih dan nyaman, VIP-nya seperti di hotel. Makanan dari gizi juga enak.", "RH"],
            ["Linda Sari", "Pasien Umum", "Dokter spesialisnya sangat komunikatif dan sabar menjelaskan kondisi orang tua saya. Terima kasih dokter.", "LS"],
            ["Supriyadi", "Purnawirawan", "Fasilitas SITERBAT sangat membantu! Obat diantar sampai rumah, jadi tidak perlu capek antri.", "SP"],
            ["Dwi Cahyono", "Pasien Umum", "Proses pendaftaran sekarang lebih mudah dan modern. Ruang tunggu poli luas dan ber-AC dingin.", "DC"],
            ["Ayu Lestari", "Pasien BPJS", "Saya melahirkan di sini, bidan dan dokternya luar biasa sabar. Pelayanan jempolan untuk warga Jember.", "AL"],
            ["Hendra Wijaya", "Pasien Umum", "Apotek pelayanannya cepat, petugasnya ramah memberikan edukasi cara minum obat yang benar.", "HW"],
            ["Maya Indah", "Pasien Umum", "Layanan fisioterapi di RS Baladhika Husada sangat bagus. Alat-alatnya modern, terapisnya telaten.", "MI"],
            ["Joko Susilo", "Keluarga Pasien", "Satpamnya ramah-ramah, dari awal masuk langsung dibantu arahkan ke poli tujuan. Sangat informatif.", "JS"],
            ["Dimas Pratama", "Pasien Umum", "Parkirannya luas dan aman. Kantin rumah sakit juga bersih. Fasilitas pendukungnya memadai.", "DP"],
            ["Ratna Dilla", "Pasien Rujukan", "Pelayanan luar biasa baik. Perawat sangat memberi semangat kepada pasien.", "RD"],
            ["Andre Firmansyah", "Pasien Umum", "Laboratoriumnya cepat dan hasilnya bisa ditunggu dengan nyaman. Harga umum juga sangat terjangkau.", "AF"],
            ["Kusuma Wardhani", "Keluarga Pasien", "Ambulans siaga cepat tanggap saat kami butuh evakuasi keluarga ke IGD. Terima kasih banyak RS DKT!", "KW"],
            ["Eka Putra", "Pasien BPJS", "Satu-satunya rumah sakit langganan keluarga. Baik pakai jalur umum maupun BPJS pelayanannya setara, tidak dibedakan.", "EP"],
        ];
    @endphp

    @foreach($reviews as $index => $review)
    <div class="min-w-[320px] max-w-[350px] snap-center bg-white p-8 rounded-xl border border-outline-variant hover:border-secondary hover:shadow-lg transition-all group flex flex-col justify-between">
        <div>
            <div class="text-secondary mb-4 flex gap-1">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'opsz' 20;">star</span>
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'opsz' 20;">star</span>
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'opsz' 20;">star</span>
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'opsz' 20;">star</span>
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'opsz' 20;">star</span>
            </div>
            <p class="font-body-md text-on-surface mb-8 italic m-0">"{{ $review[2] }}"</p>
        </div>
        <div class="flex items-center gap-4 mt-8 pt-4 border-t border-outline-variant/30">
            <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold">{{ $review[3] }}</div>
            <div>
                <h4 class="font-bold text-primary m-0">{{ $review[0] }}</h4>
                <p class="text-xs text-on-surface-variant font-label-caps m-0 mt-1">{{ $review[1] }}</p>
            </div>
        </div>
    </div>
    @endforeach

</div>
<!-- Indikator Geser (Mobile Only) -->
<div class="text-center mt-2 md:hidden">
    <span class="text-xs text-on-surface-variant font-label-caps flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-sm">swipe</span> Geser untuk melihat lebih banyak
    </span>
</div>
</div>
</section>

<!-- Mitra Asuransi -->
<section class="py-10 bg-white border-y border-outline-variant/30">
    <div class="max-w-container-max mx-auto px-gutter text-center">
        <p class="font-label-caps text-on-surface-variant mb-8 tracking-widest">MELAYANI PASIEN DARI BERBAGAI MITRA KESEHATAN</p>
        <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-6 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700">
            <h3 class="font-bold text-2xl text-secondary m-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl">health_and_safety</span> BPJS Kesehatan
            </h3>
            <h3 class="font-bold text-2xl text-secondary m-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl">security</span> BPJS Ketenagakerjaan
            </h3>
            <h3 class="font-bold text-2xl text-secondary m-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl">shield</span> Jasa Raharja
            </h3>
            <h3 class="font-bold text-2xl text-secondary m-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl">local_hospital</span> Kemenkes RI
            </h3>
            <h3 class="font-bold text-2xl text-secondary m-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl">military_tech</span> TNI AD
            </h3>
        </div>
    </div>
</section>

</div> <!-- End wrapper Tailwind -->

{{-- MODAL PENGUMUMAN (Centered) --}}
<!-- Atribut data-bs-backdrop="static" membuat layar belakang diklik tidak menutup modal, wajib tutup pakai tombol X atau Tutup -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="row g-0">
                    
                    {{-- BAGIAN KIRI: MEDIA (50% Layar) --}}
                    <div class="col-md-5 d-none d-md-block position-relative">
                        @if(isset($beritas) && count($beritas) > 0)
                            @if(isset($beritas[0]->type) && $beritas[0]->type == 'VIDEO')
                                <video class="news-side-img w-100 h-100 object-fit-cover" autoplay muted loop playsinline preload="metadata">
                                    <source src="{{ $beritas[0]->img }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ $beritas[0]->img ?? asset('images/hero-rs.jpg') }}" 
                                     class="news-side-img w-100 h-100 object-fit-cover" 
                                     alt="Instagram Update">
                            @endif
                            <div class="position-absolute top-0 start-0 m-4 badge bg-danger shadow-sm fs-6">
                                <i class="bi bi-instagram me-1"></i> UPDATE TERBARU
                            </div>
                        @else
                            <img src="{{ asset('images/hero-rs.jpg') }}" class="news-side-img w-100 h-100 object-fit-cover" style="filter: brightness(0.9);" alt="Welcome Image">
                            <div class="position-absolute top-0 start-0 m-4 badge bg-success shadow-sm fs-6">
                                <i class="bi bi-hospital me-1"></i> SELAMAT DATANG
                            </div>
                        @endif
                    </div>

                    {{-- BAGIAN KANAN: KONTEN (50% Layar) --}}
                    <div class="col-md-7 bg-light">
                        <div class="p-4 p-lg-5 d-flex flex-column justify-content-center h-100">
                            
                            {{-- Header Modal --}}
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <span class="text-success fw-bold text-uppercase fs-6">
                                    <i class="bi bi-info-circle-fill me-1"></i> Pengumuman
                                </span>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            {{-- LOGIKA KONTEN TEKS --}}
                            @if(isset($beritas) && count($beritas) > 0)
                                <h2 class="fw-bold text-dark mb-3">Update Kegiatan RS</h2>
                                <p class="text-muted fs-6 mb-4" style="line-height: 1.6;">
                                    {{ Str::limit($beritas[0]->caption ?? $beritas[0]->isi ?? 'Silakan cek update terbaru di Instagram kami.', 400) }}
                                </p>
                            @else
                                <h2 class="fw-bold text-dark mb-3">RS Tk. III Baladhika Husada</h2>
                                <p class="text-muted fs-6 mb-4" style="line-height: 1.6;">
                                    Rumah Sakit Umum Kelas C yang melayani masyarakat umum, BPJS, serta TNI/POLRI. Kami siap melayani Anda dengan fasilitas modern dan pelayanan profesional 24 Jam.
                                </p>
                            @endif

                            {{-- TOMBOL AKSI --}}
                            <div class="d-grid gap-2 mt-auto">
                                <a href="{{ route('tidur') }}" class="btn btn-success fw-bold rounded-pill shadow-sm py-2">
                                    <i class="bi bi-door-open me-2"></i> KETERSEDIAAN KAMAR
                                </a>

                                @if(isset($beritas) && count($beritas) > 0)
                                    <a href="{{ $beritas[0]->permalink ?? $beritas[0]->url ?? 'https://www.instagram.com' }}" target="_blank" class="btn btn-outline-danger fw-bold rounded-pill py-2">
                                        <i class="bi bi-instagram me-2"></i> Lihat Info Selengkapnya
                                    </a>
                                @else
                                    <a href="https://www.instagram.com/rstk3baladhikahusada/" target="_blank" class="btn btn-outline-secondary fw-bold rounded-pill py-2">
                                        <i class="bi bi-instagram me-2"></i> Kunjungi Instagram Kami
                                    </a>
                                @endif
                                
                                <button type="button" class="btn btn-outline-dark fw-bold rounded-pill py-2 mt-1" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i> Tutup & Lanjutkan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tampilkan Modal Langsung (Tanpa batasan satu kali per hari untuk mempermudah testing)
    setTimeout(() => { 
        var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
        myModal.show(); 
    }, 500); // 500ms delay agar load smooth
});

// Modal micro-interactions from new design (Bento cards fade in)
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('opacity-100', 'translate-y-0');
            entry.target.classList.remove('opacity-0', 'translate-y-10');
        }
    });
}, observerOptions);

document.querySelectorAll('.bento-card').forEach(el => {
    el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
    observer.observe(el);
});

// Logic for Gallery Slider
let currentSlide = 0;
const totalSlides = 4;
const sliderContainer = document.getElementById('facility-slider-container');

function updateNavStyles() {
    for (let i = 0; i < totalSlides; i++) {
        const textEl = document.getElementById('text-slide-' + i);
        const lineEl = document.getElementById('line-slide-' + i);
        if (i === currentSlide) {
            textEl.style.color = '#F1E4B3'; // gold-light
            lineEl.style.width = '100%';
            lineEl.style.backgroundColor = '#F1E4B3';
        } else {
            textEl.style.color = '#ffffff';
            lineEl.style.width = '0';
            lineEl.style.backgroundColor = 'transparent';
        }
    }
}

window.scrollToSlide = function(index) {
    currentSlide = index;
    const slide = document.getElementById('slide-' + index);
    if (sliderContainer && slide) {
        sliderContainer.scrollLeft = slide.offsetLeft;
    }
    updateNavStyles();
}

window.scrollSlider = function(direction) {
    if (direction === 'left') {
        currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1;
    } else {
        currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0;
    }
    scrollToSlide(currentSlide);
}

// Auto-scroll logic for Testimonials
const testimonialSlider = document.getElementById('testimonial-slider-container');
let autoScrollInterval;

function startTestimonialAutoScroll() {
    if (!testimonialSlider) return;
    autoScrollInterval = setInterval(() => {
        const maxScrollLeft = testimonialSlider.scrollWidth - testimonialSlider.clientWidth;
        // If reached the end, go back to start, else scroll right
        if (testimonialSlider.scrollLeft >= maxScrollLeft - 10) {
            testimonialSlider.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            // Scroll by approximately one card width
            testimonialSlider.scrollBy({ left: 350, behavior: 'smooth' });
        }
    }, 3500); // 3.5 seconds
}

if (testimonialSlider) {
    startTestimonialAutoScroll();
    // Pause auto-scroll when user hovers over the testimonials
    testimonialSlider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
    testimonialSlider.addEventListener('mouseleave', startTestimonialAutoScroll);
    
    // For mobile touch
    testimonialSlider.addEventListener('touchstart', () => clearInterval(autoScrollInterval), {passive: true});
    testimonialSlider.addEventListener('touchend', startTestimonialAutoScroll, {passive: true});
}

// Video Autoplay on Scroll (Intersection Observer)
const videoObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Putar video jika masuk dalam layar
            entry.target.play().catch(e => console.log("Autoplay prevented by browser:", e));
        } else {
            // Pause video jika keluar dari layar untuk menghemat kuota/resource
            entry.target.pause();
        }
    });
}, { threshold: 0.3 }); // Play when 30% of the video is visible

document.querySelectorAll('video.berita-video').forEach(video => {
    videoObserver.observe(video);
});
</script>
@endpush
@endsection