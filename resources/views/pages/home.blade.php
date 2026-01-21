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


    {{-- 4. TESTIMONI SECTION (Google Maps Style) --}}
<section class="py-5 my-5" data-aos="fade-up" style="background: #f8f9fa;"> 
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-success mb-2">💬 Ulasan Pengunjung</h2> 
            <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                <img src="https://cdn.worldvectorlogo.com/logos/google-maps-2020-icon.svg" width="20" alt="Google">
                <span class="fw-bold">4.6 / 5.0</span>
                <div class="text-warning">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                </div>
            </div>
            <p class="text-muted">Berdasarkan ulasan terbaru di Google Maps</p>
        </div>

        <div class="row g-4">
            {{-- Testimoni 1 --}}
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="50">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 45px; height: 45px;">A</div>
                        <div>
                            <h6 class="fw-bold mb-0">Agus Wijaya</h6>
                            <small class="text-muted">Local Guide • 2 minggu lalu</small>
                        </div>
                    </div>
                    <div class="text-warning mb-2 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small italic">"Pelayanan di RS DKT Jember sangat cepat dan ramah. Dokter spesialisnya sangat membantu dan penjelasannya mudah dimengerti."</p>
                </div>
            </div>

            {{-- Testimoni 2 --}}
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 45px; height: 45px;">R</div>
                        <div>
                            <h6 class="fw-bold mb-0">Rina Septi</h6>
                            <small class="text-muted">Pengunjung • 1 bulan lalu</small>
                        </div>
                    </div>
                    <div class="text-warning mb-2 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small">"Fasilitas kamarnya bersih dan nyaman. Perawat sigap saat dibutuhkan. Terima kasih RS Baladhika Husada."</p>
                </div>
            </div>

            {{-- Testimoni 3 --}}
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 45px; height: 45px;">H</div>
                        <div>
                            <h6 class="fw-bold mb-0">Hari Darmawan</h6>
                            <small class="text-muted">Local Guide • 3 bulan lalu</small>
                        </div>
                    </div>
                    <div class="text-warning mb-2 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted small">"Proses administrasi BPJS lancar dan tidak ribet. Sangat membantu masyarakat Jember."</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="https://www.google.com/maps/place/Rumah+Sakit+Baladhika+Husada+(RS+DKT)+Jember/@-8.1639433,113.7035974,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd6943bb3448627:0x4568cb1a5d56572d!8m2!3d-8.1639486!4d113.7061723!16s%2Fg%2F1pzx5ytnd?entry=ttu&g_ep=EgoyMDI2MDEwNC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                Lihat Semua Ulasan di Google Maps
            </a>
        </div>
    </div>
</section>
</main>
<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Ukuran LG lebih pas untuk laptop & tablet --}}
        <div class="modal-content modal-compact shadow-lg">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-block">
                        @if($beritas->count() > 0)
                            <img src="{{ $beritas[0]->img }}" class="news-side-img w-100" alt="News Image">
                        @else
                            <div class="h-100 bg-success d-flex align-items-center justify-content-center">
                                <i class="bi bi-hospital text-white display-4"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-7">
                        <div class="news-body h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="news-tag"><i class="bi bi-info-circle-fill me-1"></i> Update Terbaru</span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            @if($beritas->count() > 0)
                                <h2 class="news-title-sm">{{ $beritas[0]->judul }}</h2>
                                <p class="news-text-sm">
                                    {{ Str::limit($beritas[0]->isi, 150) }}
                                </p>
                            @endif

                            <div class="d-grid gap-2">
                                <a href="{{ route('tidur') }}" class="btn btn-rs-primary text-decoration-none text-center">
                                    <i class="bi bi-door-open me-2"></i> Ketersediaan Kamar
                                </a>
                                @if($beritas->count() > 0)
                                <a href="{{ $beritas[0]->url }}" target="_blank" class="btn btn-rs-ig text-decoration-none text-center">
                                    <i class="bi bi-instagram me-2"></i> Baca di Instagram
                                </a>
                                @endif
                            </div>

                            <div class="mt-3 pt-2 border-top">
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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const dontShow = localStorage.getItem('hideInfoModalToday');
    const today = new Date().toDateString();

    if (dontShow !== today) {
        var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
        setTimeout(() => { myModal.show(); }, 1500);
    }

    document.getElementById('dontShowAgain').addEventListener('change', function() {
        if(this.checked) { localStorage.setItem('hideInfoModalToday', today); }
        else { localStorage.removeItem('hideInfoModalToday'); }
    });
});
</script>
<style>
    /* Ukuran Modal Custom */
.modal-compact {
    border: none;
    border-radius: 20px;
    overflow: hidden;
}

/* Sisi Kiri: Foto yang Presisi */
.news-side-img {
    height: 100%;
    min-height: 320px; /* Ukuran tidak terlalu tinggi */
    object-fit: cover;
}

/* Sisi Kanan: Tipografi Bersih */
.news-body {
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.news-tag {
    font-size: 0.7rem;
    font-weight: 700;
    color: #157347;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.news-title-sm {
    font-size: 1.25rem;
    font-weight: 800;
    color: #2d3419;
    margin: 8px 0;
    line-height: 1.3;
}

.news-text-sm {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.5;
    margin-bottom: 20px;
}

/* Button Styling */
.btn-rs-primary {
    background: #157347;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px;
    border: none;
    transition: 0.3s;
}

.btn-rs-primary:hover {
    background: #115c39;
    color: white;
}

.btn-rs-ig {
    background: white;
    color: #bc1888;
    border: 1px solid #bc1888;
    font-weight: 600;
    border-radius: 10px;
    padding: 8px;
    font-size: 0.85rem;
}
</style>
@endsection