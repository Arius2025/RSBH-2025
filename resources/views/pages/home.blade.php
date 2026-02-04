{{-- home.blade.php --}}
@extends('layouts.app')

@section('content')

<main>
    {{-- 1. HERO SECTION --}}
    <section class="hero-section position-relative d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 85vh;" data-aos="zoom-in"> 
        <div class="hero-bg" style="background: url('images/hero-rs.jpg') center/cover no-repeat; position: absolute; top:0; left:0; width:100%; height:100%; animation: slowZoom 20s infinite alternate;"></div>
        <div class="hero-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, rgba(25, 135, 84, 0.8) 100%); position: absolute; top:0; left:0; width:100%; height:100%; z-index: 1;"></div>
        
        <div class="container position-relative text-white text-center" style="z-index: 2;">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold shadow-sm" data-aos="fade-down">
                <i class="bi bi-star-fill me-1"></i> Terakreditasi Paripurna
            </span>
            <h1 class="fw-extrabold display-4 text-shadow mb-3" data-aos="fade-up">
                RS Tk. III Baladhika Husada
            </h1>
            <p class="lead mb-5 text-shadow-sm opacity-90 mx-auto fs-5" style="max-width: 750px;" data-aos="fade-up" data-aos-delay="100">
                Rumah Sakit Umum Kelas C yang melayani masyarakat umum, BPJS, serta TNI/POLRI dengan sepenuh hati.
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                <a href="{{ route('jadwal') }}" class="btn btn-light text-success btn-lg shadow fw-bold px-4 py-3 rounded-pill transition-all hover-lift" data-aos="zoom-in" data-aos-delay="200">
                    <i class="bi bi-calendar-check me-2"></i> JADWAL DOKTER
                </a>
                <a href="{{ route('siterbat') }}" class="btn btn-outline-light btn-lg shadow fw-bold px-4 py-3 rounded-pill transition-all hover-lift" data-aos="zoom-in" data-aos-delay="250">
                    <i class="bi bi-truck me-2"></i> PESAN OBAT DIANTAR
                </a>
            </div>
        </div>
    </section>

    {{-- 2. TENTANG KAMI --}}
    <section class="container py-5">
        <div class="bg-white rounded-5 shadow-lg p-4 p-md-5 position-relative border-top border-5 border-success" style="margin-top: -60px; z-index: 3;" data-aos="fade-up"> 
            <div class="row align-items-center g-5">
                {{-- Profil Karumkit --}}
                <div class="col-md-4 col-lg-3 text-center">
    {{-- Wrapper untuk mengatur lebar maksimal agar tidak terlalu besar di desktop --}}
    <div class="d-inline-block mx-auto" style="max-width: 280px;">
        
        {{-- Bingkai Foto Persegi Panjang dengan Sudut Tumpul --}}
        <div class="p-2 border border-3 border-success rounded-4 shadow-sm bg-white">
            {{-- 
                 Catatan: Pastikan foto yang digunakan berorientasi PORTRAIT (tegak) 
                 agar hasilnya maksimal dengan img-fluid.
                 max-height diatur agar foto tidak terlalu tinggi di layar besar.
            --}}
            <img src="images/Karumkit (2).png" alt="Kepala Rumah Sakit" class="img-fluid rounded-3 shadow-sm object-fit-cover" style="max-height: 350px; width: 100%;">
        </div>

        {{-- Badge Jabatan Dipindah ke Bawah Foto --}}
        <div class="mt-3 d-inline-block">
            <span class="bg-success text-white px-4 py-2 rounded-pill small fw-bold shadow-sm text-uppercase" style="letter-spacing: 1px;">
                Kepala Rumah Sakit
            </span>
        </div>

        {{-- Nama Pejabat --}}
        <h5 class="mt-4 fw-bold text-dark mb-1">Letkol CKM dr. Zaltonys Tolombot, Sp.M</h5>
    </div>
</div>
                
                {{-- Deskripsi Rumah Sakit --}}
                <div class="col-md-8 col-lg-9" data-aos="fade-left">
                    <h2 class="fw-bold mb-3 display-6 text-success">Profil Rumah Sakit</h2>
                    <p class="text-dark fs-5 mb-4" style="line-height: 1.8; text-align: justify;">
                        Rumkit Tk.III Baladhika Husada Jember adalah <strong>Rumah Sakit Umum kelas C</strong> yang melayani masyarakat umum, peserta BPJS, serta anggota dan keluarga TNI/POLRI. 
                    </p>
                    <p class="text-muted mb-4" style="text-align: justify;">
                        Rumah Sakit ini menyediakan layanan kesehatan <strong>Rawat Jalan, Rawat Inap, dan Gawat Darurat 24 Jam</strong> dengan dukungan tenaga medis profesional dan fasilitas penunjang medis yang memadai, demi menjamin keselamatan dan kenyamanan pasien.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-3">
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-check-circle-fill text-success me-1"></i> RSU Kelas C</span>
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-check-circle-fill text-success me-1"></i> BPJS Kesehatan</span>
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-check-circle-fill text-success me-1"></i> Layanan TNI/POLRI</span>
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-check-circle-fill text-success me-1"></i> IGD 24 Jam</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. BANNER SITERBAT --}}
    <section class="py-5 bg-light">
        <div class="container" data-aos="zoom-in">
            <div class="bg-success rounded-4 p-4 p-md-5 text-white position-relative overflow-hidden shadow-lg">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-n5 mb-n5">
                    <i class="bi bi-truck" style="font-size: 15rem;"></i>
                </div>
                <div class="row align-items-center position-relative z-1">
                    <div class="col-lg-8">
                        <h2 class="fw-bold display-6">Malas Antri Obat?</h2>
                        <p class="fs-5 mb-4">Gunakan layanan <strong>SITERBAT (Siap Antar Obat)</strong>. Obat diantar langsung ke rumah Anda dengan aman dan cepat.</p>
                        <a href="{{ route('siterbat') }}" class="btn btn-warning btn-lg fw-bold rounded-pill shadow hover-lift px-5">
                            <i class="bi bi-cursor-fill me-2"></i> COBA SITERBAT SEKARANG
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. GALERI MARQUEE (Jalan Otomatis) --}}
    <section class="py-5 bg-white overflow-hidden">
        <div class="container mb-4 text-center">
            <h2 class="fw-bold text-success"><i class="bi bi-images me-2"></i> Galeri Fasilitas</h2>
            <p class="text-muted">Fasilitas penunjang medis yang modern dan nyaman</p>
        </div>

        <div class="marquee-wrapper">
            <div class="marquee-content">
                @for($i = 0; $i < 2; $i++) 
                    @foreach(['ambulan', 'apotek', 'kamar', 'lab', 'poli1', 'poli2', 'poli3', 'poli4'] as $img)
                    <div class="marquee-item">
                        <img src="images/fasilitas/{{ $img }}.jpeg" alt="Fasilitas {{ $img }}">
                        <div class="marquee-overlay">
                            <span>{{ strtoupper($img) }}</span>
                        </div>
                    </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    {{-- 5. TESTIMONI --}}
    <section class="py-5 bg-light"> 
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-down">
                <h2 class="fw-bold text-dark mb-2">Apa Kata Mereka?</h2> 
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <i class="bi bi-google text-primary"></i>
                    <span class="fw-bold">4.6 / 5.0</span>
                    <small class="text-muted">(Ulasan Google Maps)</small>
                </div>
            </div>
            <div class="row g-4">
                @foreach([
                    ['name' => 'Agus Wijaya', 'text' => 'Pelayanan cepat dan ramah.'],
                    ['name' => 'Rina Septi', 'text' => 'Kamar bersih, perawat sigap.'],
                    ['name' => 'Hari Darmawan', 'text' => 'Administrasi BPJS sangat mudah.']
                ] as $idx => $testi)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift">
                        <div class="text-warning mb-2">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-muted small fst-italic mb-3">"{{ $testi['text'] }}"</p>
                        <h6 class="fw-bold mb-0 text-success">{{ $testi['name'] }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

{{-- 6. MODAL PENGUMUMAN --}}
<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-compact shadow-lg border-0 rounded-4">
            <div class="modal-body p-0">
                <div class="row g-0">
                    
                    {{-- BAGIAN KIRI: GAMBAR --}}
                    <div class="col-md-5 d-none d-md-block position-relative">
                        @if(isset($beritas) && count($beritas) > 0)
                            {{-- SKENARIO 1: Cache Instagram Ada --}}
                            {{-- Menggunakan -> (tanda panah) karena datanya Object --}}
                            <img src="{{ $beritas[0]->media_url ?? $beritas[0]->img ?? asset('images/hero-rs.jpg') }}" 
                                 class="news-side-img w-100 h-100 object-fit-cover" 
                                 alt="Instagram Update">
                            <div class="position-absolute top-0 start-0 m-3 badge bg-danger shadow-sm">
                                <i class="bi bi-instagram me-1"></i> UPDATE TERBARU
                            </div>
                        @else
                            {{-- SKENARIO 2: Cache Instagram Kosong (Fallback) --}}
                            <img src="{{ asset('images/hero-rs.jpg') }}" class="news-side-img w-100 h-100 object-fit-cover" style="filter: brightness(0.9);" alt="Welcome Image">
                            <div class="position-absolute top-0 start-0 m-3 badge bg-success shadow-sm">
                                <i class="bi bi-hospital me-1"></i> SELAMAT DATANG
                            </div>
                        @endif
                    </div>

                    {{-- BAGIAN KANAN: KONTEN --}}
                    <div class="col-md-7">
                        <div class="news-body p-4 p-lg-5 h-100 d-flex flex-column justify-content-center">
                            
                            {{-- Header Modal --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="news-tag text-success fw-bold small text-uppercase">
                                    <i class="bi bi-info-circle-fill me-1"></i> Informasi
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            {{-- LOGIKA KONTEN TEKS --}}
                            @if(isset($beritas) && count($beritas) > 0)
                                {{-- Jika Data Ada --}}
                                <h4 class="fw-bold text-dark mb-3">Update Kegiatan RS</h4>
                                <p class="text-muted small mb-4">
                                    {{-- Menggunakan ->caption --}}
                                    {{ Str::limit($beritas[0]->caption ?? $beritas[0]->isi ?? 'Silakan cek update terbaru di Instagram kami.', 150) }}
                                </p>
                            @else
                                {{-- Jika Data Kosong --}}
                                <h3 class="fw-bold text-dark mb-3">RS Tk. III Baladhika Husada</h3>
                                <p class="text-muted small mb-4">
                                    Rumah Sakit Umum Kelas C yang melayani masyarakat umum, BPJS, serta TNI/POLRI. Kami siap melayani Anda dengan fasilitas modern dan pelayanan profesional 24 Jam.
                                </p>
                            @endif

                            {{-- TOMBOL AKSI --}}
                            <div class="d-grid gap-2">
                                <a href="{{ route('tidur') }}" class="btn btn-success btn-lg fw-bold rounded-3 shadow-sm hover-lift">
                                    <i class="bi bi-door-open me-2"></i> CEK KETERSEDIAAN KAMAR
                                </a>

                                @if(isset($beritas) && count($beritas) > 0)
                                    {{-- Menggunakan ->permalink --}}
                                    <a href="{{ $beritas[0]->permalink ?? $beritas[0]->url ?? 'https://www.instagram.com' }}" target="_blank" class="btn btn-outline-danger fw-bold rounded-3">
                                        <i class="bi bi-instagram me-2"></i> Lihat di Instagram
                                    </a>
                                @else
                                    <a href="https://www.instagram.com/rstk3baladhikahusada/" target="_blank" class="btn btn-outline-secondary fw-bold rounded-3">
                                        <i class="bi bi-instagram me-2"></i> Kunjungi Instagram Kami
                                    </a>
                                @endif
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="form-check form-switch small">
                                    <input class="form-check-input" type="checkbox" id="dontShowAgain">
                                    <label class="form-check-label text-muted" for="dontShowAgain">Jangan tampilkan hari ini</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animasi & Utility */
    @keyframes slowZoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    
    .text-shadow { text-shadow: 2px 2px 8px rgba(0,0,0,0.6); }
    .hover-lift { transition: transform 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); }
    .hover-scale:hover { transform: scale(1.05); }

    /* MARQUEE GALERI */
    .marquee-wrapper { width: 100%; overflow: hidden; position: relative; padding-bottom: 20px; background: #fff; }
    .marquee-content { display: flex; gap: 20px; width: max-content; animation: scrollGallery 40s linear infinite; }
    .marquee-content:hover { animation-play-state: paused; }
    .marquee-item { position: relative; width: 300px; height: 200px; flex-shrink: 0; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .marquee-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .marquee-item:hover img { transform: scale(1.1); }
    .marquee-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); color: white; text-align: center; padding: 5px; transform: translateY(100%); transition: transform 0.3s; }
    .marquee-item:hover .marquee-overlay { transform: translateY(0); }
    
    @keyframes scrollGallery {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dontShow = localStorage.getItem('hideInfoModalToday');
    const today = new Date().toDateString();

    if (dontShow !== today) {
        setTimeout(() => { 
            var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
            myModal.show(); 
        }, 1500);
    }

    const checkBtn = document.getElementById('dontShowAgain');
    if(checkBtn){
        checkBtn.addEventListener('change', function() {
            if(this.checked) { localStorage.setItem('hideInfoModalToday', today); }
            else { localStorage.removeItem('hideInfoModalToday'); }
        });
    }
});
</script>

@endsection