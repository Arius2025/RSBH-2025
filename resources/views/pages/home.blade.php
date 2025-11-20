{{-- home.blade.php --}}
@extends('layouts.app')

@section('content')

<main class="container py-4"> 
    
    {{-- 1. HERO BANNER (Kesan Formal & Profesional) --}}
    <section class="mb-5 hero-section" data-aos="zoom-in"> 
        {{-- class="hero-section" di-styling di app.blade.php untuk fixed height dan background --}}
        <div class="hero-overlay"></div>
        <div class="hero-content text-white text-center">
            <h1 class="fw-bold display-5 text-shadow" data-aos="fade-down">
                RS Tk. III Baladhika Husada
            </h1>
            <p class="lead mb-0 text-shadow" data-aos="fade-up" data-aos-delay="100">
                Melayani BPJS, Umum, dan Anggota TNI/POLRI dengan sepenuh hati
            </p>
            {{-- Tombol utama untuk aksi --}}
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('jadwal') }}" class="btn btn-warning btn-lg shadow-sm fw-bold transition hover-shadow" data-aos="zoom-in" data-aos-delay="200">
                    <i class="bi bi-calendar-check me-2"></i> CEK JADWAL DOKTER
                </a>
                {{-- Tambahkan tombol konsultasi --}}
                <a href="{{ route('komplain') }}" class="btn btn-outline-light btn-lg shadow-sm fw-bold transition hover-shadow" data-aos="zoom-in" data-aos-delay="250">
                    <i class="bi bi-chat-dots me-2"></i> KONSULTASI SEKARANG
                </a>
            </div>
        </div>
    </section>

    {{-- 2. TENTANG KAMI (Formal, Gambar Fix Ukuran 1:1) --}}
    <section class="bg-white rounded shadow-lg p-4 p-md-5 mb-5" data-aos="fade-up"> 
        <div class="row align-items-center">
            {{-- Kolom Kiri: Foto Karumkit (Fix Aspect Ratio di CSS app.blade.php) --}}
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <div class="karumkit-wrapper mx-auto shadow-lg" data-aos="fade-right">
                    {{-- Ganti URL ini jika nama file Karumkit berbeda --}}
                    <img src="images/Karumkit.png" alt="Kepala Rumah Sakit" loading="lazy" class="w-100 h-100 object-fit-cover">
                </div>
                <h5 class="mt-3 fw-semibold text-success">Letkol CKM dr. Zaltonys Tolombot, Sp.M</h5>
                <p class="text-muted small mb-0">Kepala Rumah Sakit Tk. III</p>
            </div>
            
            {{-- Kolom Kanan: Deskripsi --}}
            <div class="col-md-9" data-aos="fade-left">
                <h2 class="fw-bold text-success mb-3 border-bottom pb-2"><i class="bi bi-hospital me-2"></i> Tentang Kami</h2>
                <p class="lead">RS Tk. III Baladhika Husada Jember berkomitmen memberikan pelayanan kesehatan profesional, cepat, dan berbasis teknologi untuk seluruh lapisan masyarakat.</p>
                <p class="text-muted">Sebagai rumah sakit Tingkat III di bawah naungan TNI, kami melayani pasien BPJS, umum, dan prajurit TNI/POLRI dengan fasilitas modern, didukung oleh tim dokter spesialis yang berpengalaman dan berdedikasi tinggi. Prioritas kami adalah keselamatan dan kenyamanan pasien.</p>
                <a href="{{ route('informasi') }}" class="btn btn-outline-success fw-semibold mt-3 transition hover-shadow">Selengkapnya <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    {{-- 3. GALLERY SECTION (Horizontal Scroll) --}}
    <section class="py-5" data-aos="fade-up">
        <h2 class="fw-bold text-success text-center mb-5"><i class="bi bi-images me-2"></i> Galeri Fasilitas</h2>
        
        {{-- Galeri menggunakan div track untuk horizontal scrolling/slider (CSS di app.blade.php) --}}
        <div class="galeri-carousel shadow-lg rounded"> 
            <div class="galeri-track">
                <img src="images/fasilitas/ambulan.jpeg" alt="Galeri Ambulan" loading="lazy">
                <img src="images/fasilitas/apotek.jpeg" alt="Galeri Apotek" loading="lazy">
                <img src="images/fasilitas/kamar.jpeg" alt="Galeri Kamar Perawatan" loading="lazy">
                <img src="images/fasilitas/lab.jpeg" alt="Galeri Laboratorium" loading="lazy">
                <img src="images/fasilitas/poli1.jpeg" alt="Galeri Poli Spesialis 1" loading="lazy">
                <img src="images/fasilitas/poli2.jpeg" alt="Galeri Poli Spesialis 2" loading="lazy">
                <img src="images/fasilitas/poli3.jpeg" alt="Galeri Poli Spesialis 3" loading="lazy">
                <img src="images/fasilitas/poli4.jpeg" alt="Galeri Poli Spesialis 4" loading="lazy">
                <img src="images/fasilitas/poli5.jpeg" alt="Galeri Poli Spesialis 5" loading="lazy">
                <img src="images/fasilitas/poli6.jpeg" alt="Galeri Poli Spesialis 6" loading="lazy">
                <img src="images/fasilitas/poli7.jpeg" alt="Galeri Poli Spesialis 7" loading="lazy">
            </div>
        </div>
        <p class="text-center text-muted small mt-3">Geser ke kanan/kiri untuk melihat fasilitas lainnya.</p>
    </section>


    {{-- 4. TESTIMONI SECTION (Warna Background di CSS app.blade.php) --}}
    <section class="testimoni-section rounded py-5 my-5" data-aos="fade-up"> 
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-down">
                {{-- Text-white karena latar belakang sudah diganti di CSS --}}
                <h2 class="fw-bold text-white mb-3">💬 Komentar Pengunjung</h2> 
                <p class="lead text-white-50">Apa kata mereka tentang layanan kami.</p>
            </div>
            <div class="testimoni-slider">
                <div class="testimoni-card transition hover-shadow" data-aos="zoom-in" data-aos-delay="50">
                    <p class="quote">“Pelayanannya sangat cepat dan ramah. Dokter dan perawatnya sangat membantu. Sangat direkomendasikan.”</p>
                    <h4 class="name">— Bpk. Agus W.</h4>
                </div>
                <div class="testimoni-card transition hover-shadow" data-aos="zoom-in" data-aos-delay="100">
                    <p class="quote">“Fasilitasnya lengkap dan bersih. Benar-benar merasa nyaman selama perawatan dan petugasnya sigap.”</p>
                    <h4 class="name">— Ibu Rina S.</h4>
                </div>
                <div class="testimoni-card transition hover-shadow d-none d-lg-block" data-aos="zoom-in" data-aos-delay="150">
                    <p class="quote">“Proses administrasi cepat. Stafnya sangat tanggap dan profesional. Pelayanan prima.”</p>
                    <h4 class="name">— Bapak Hari D.</h4>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection