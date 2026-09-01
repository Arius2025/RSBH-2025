{{-- informasi.blade.php --}}
@extends('layouts.app')

@section('title', 'Informasi & Profil Rumah Sakit')
@section('meta_description', 'Profil lengkap RS Tk. III Baladhika Husada Jember (RS DKT). Visi, Misi, Motto P.E.D.U.L.I, Falsafah, Tujuan, Nilai-Nilai Kerja, Sejarah, dan Pimpinan Rumah Sakit.')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="hero-section position-relative d-flex align-items-center justify-content-center overflow-hidden" 
    style="min-height: 42vh; background: linear-gradient(rgba(25, 135, 84, 0.88), rgba(15, 35, 24, 0.92)), url('{{ asset('images/hero-rs.jpg') }}') center/cover no-repeat;" 
    data-aos="fade-down">
    <div class="container text-center text-white position-relative z-2">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-white bg-opacity-15 backdrop-blur text-warning mb-3 border border-white border-opacity-20 shadow-sm">
            <i class="bi bi-hospital text-warning"></i>
            <span class="small fw-bold text-uppercase" style="letter-spacing: 1px;">Detasemen Kesehatan Wilayah Malang</span>
        </div>
        <h1 class="fw-extrabold display-4 mb-2">Profil & Informasi Rumah Sakit</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 680px;">
            Mengenal lebih dekat Visi, Misi, Nilai Kerja, serta dedikasi pengabdian RS Tk. III Baladhika Husada Jember.
        </p>
    </div>
</section>

{{-- 2. SMART STICKY NAVIGATION --}}
<div class="smart-sticky bg-white shadow-sm border-bottom z-3">
    <div class="container py-2 px-0 px-md-3"> 
        <ul class="nav nav-pills justify-content-start justify-content-lg-center flex-nowrap overflow-auto no-scrollbar px-3 px-md-0" id="infoNav">
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold active" href="#visi-misi">Visi & Misi</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#motto-falsafah">Motto & Falsafah</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#tujuan-nilai">Tujuan & Nilai Kerja</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#sejarah">Sejarah</a></li>
            <li class="nav-item"><a class="nav-link nav-scroll text-success fw-bold" href="#karumkit">Pimpinan</a></li>
        </ul>
    </div>
</div>

<div class="container py-4 py-md-5">
    
    {{-- 3. VISI & MISI --}}
    <section id="visi-misi" class="info-section mb-5 pt-3">
        <div class="row g-4 align-items-stretch">
            {{-- VISI CARD --}}
            <div class="col-lg-5" data-aos="fade-right">
                <div class="card h-100 border-0 shadow-lg bg-success text-white rounded-4 overflow-hidden position-relative hover-scale" style="background: linear-gradient(145deg, #198754, #145a38) !important;">
                    <div class="card-body p-4 p-md-5 d-flex flex-column justify-content-center text-center">
                        <div class="mb-3 display-3 opacity-25"><i class="bi bi-eye-fill"></i></div>
                        <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mx-auto mb-3 font-monospace">VISI UTAMA</span>
                        <h2 class="fw-extrabold mb-3 text-white">VISI</h2>
                        <p class="fs-5 lh-base text-white text-opacity-95 font-sans">
                            "Menjadi Rumah Sakit kepercayaan dan kebanggaan Prajurit, PNS, dan keluarganya serta masyarakat umum di wilayah Jember dan sekitarnya."
                        </p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10 p-3">
                        <i class="bi bi-quote display-1"></i>
                    </div>
                </div>
            </div>

            {{-- MISI CARD --}}
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card h-100 border-0 shadow-sm rounded-4 bg-white">
                    <div class="card-body p-4 p-md-5">
                        <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold mb-2 font-monospace">KOMITMEN LAYANAN</span>
                        <h3 class="fw-bold text-success mb-4 d-flex align-items-center">
                            <i class="bi bi-bullseye me-3 fs-2 text-success"></i> MISI RUMAH SAKIT
                        </h3>
                        
                        {{-- Misi 1 --}}
                        <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3 bg-light bg-opacity-60 border-start border-4 border-success">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow-xs" style="width: 36px; height: 36px;">1</div>
                            <div class="fw-semibold text-dark mb-0">
                                Menyelenggarakan dukungan kesehatan yang handal.
                            </div>
                        </div>

                        {{-- Misi 2 --}}
                        <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3 bg-light bg-opacity-60 border-start border-4 border-success">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow-xs" style="width: 36px; height: 36px;">2</div>
                            <div class="fw-semibold text-dark mb-0">
                                Memberikan pelayanan kesehatan yang prima.
                            </div>
                        </div>

                        {{-- Misi 3 --}}
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light bg-opacity-60 border-start border-4 border-success">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow-xs" style="width: 36px; height: 36px;">3</div>
                            <div class="fw-semibold text-dark mb-0">
                                Meningkatkan kualitas sumberdaya yang dimiliki melalui pendidikan dan pelatihan yang berkelanjutan sesuai bidang dan profesinya.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. MOTTO P.E.D.U.L.I & FALSAFAH --}}
    <section id="motto-falsafah" class="info-section mb-5 pt-4">
        <div class="row g-4">
            {{-- MOTTO PEDULI --}}
            <div class="col-lg-7" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="text-center mb-4">
                        <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mb-2 font-monospace">MOTTO PELAYANAN</span>
                        <h3 class="fw-extrabold text-success mb-0 letter-spacing-1">P . E . D . U . L . I</h3>
                    </div>

                    <div class="row g-3">
                        {{-- P --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-award-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Profesional</h6>
                                <small class="text-muted font-monospace fw-semibold">"P"</small>
                            </div>
                        </div>

                        {{-- E --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-heart-pulse-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Empati</h6>
                                <small class="text-muted font-monospace fw-semibold">"E"</small>
                            </div>
                        </div>

                        {{-- D --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-patch-check-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Dedikasi</h6>
                                <small class="text-muted font-monospace fw-semibold">"D"</small>
                            </div>
                        </div>

                        {{-- U --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-globe-americas fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Universal</h6>
                                <small class="text-muted font-monospace fw-semibold">"U"</small>
                            </div>
                        </div>

                        {{-- L --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-shield-fill-check fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Loyal</h6>
                                <small class="text-muted font-monospace fw-semibold">"L"</small>
                            </div>
                        </div>

                        {{-- I --}}
                        <div class="col-6 col-md-4">
                            <div class="p-3 text-center rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-2 shadow-xs" style="width: 44px; height: 44px;">
                                    <i class="bi bi-lightbulb-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Inisiatif</h6>
                                <small class="text-muted font-monospace fw-semibold">"I"</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FALSAFAH --}}
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white position-relative overflow-hidden" style="border-left: 6px solid #d4af37 !important;">
                    <span class="badge bg-warning-subtle text-dark px-3 py-1.5 rounded-pill fw-bold mb-2 font-monospace">PANDUAN NILAI</span>
                    <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-compass-fill text-warning"></i> FALSAFAH
                    </h3>

                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 rounded-3 bg-light border-start border-3 border-secondary">
                            <div class="d-flex align-items-center gap-2 text-dark fw-bold">
                                <i class="bi bi-dash-circle text-muted"></i>
                                <span>Visi tanpa aksi hanya mimpi</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-3 bg-light border-start border-3 border-danger">
                            <div class="d-flex align-items-center gap-2 text-dark fw-bold">
                                <i class="bi bi-exclamation-circle text-danger"></i>
                                <span>Aksi tanpa visi buang waktu</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-3 bg-success-subtle border-start border-3 border-success">
                            <div class="d-flex align-items-center gap-2 text-success fw-extrabold">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Visi dengan aksi bangun perubahan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. TUJUAN & NILAI-NILAI KERJA --}}
    <section id="tujuan-nilai" class="info-section mb-5 pt-4">
        {{-- TUJUAN RUMAH SAKIT --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4" data-aos="fade-up">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                    <i class="bi bi-flag-fill fs-4"></i>
                </div>
                <div>
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold font-monospace">ORIENTASI INSTITUSI</span>
                    <h3 class="fw-bold text-dark mb-0">TUJUAN RUMAH SAKIT</h3>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 d-flex flex-column">
                        <span class="badge bg-success text-white rounded-circle p-2 mb-3 fw-bold font-monospace align-self-start">01</span>
                        <p class="text-dark fw-semibold mb-0">Meningkatkan derajat kesehatan Prajurit, PNS dan keluarganya dalam rangka mendukung tugas pokok TNI.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 d-flex flex-column">
                        <span class="badge bg-success text-white rounded-circle p-2 mb-3 fw-bold font-monospace align-self-start">02</span>
                        <p class="text-dark fw-semibold mb-0">Meningkatkan derajat kesehatan secara optimal kepada masyarakat umum di wilayah Jember dan sekitarnya.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light border h-100 d-flex flex-column">
                        <span class="badge bg-success text-white rounded-circle p-2 mb-3 fw-bold font-monospace align-self-start">03</span>
                        <p class="text-dark fw-semibold mb-0">Meningkatkan kemampuan rumah sakit secara terencana dan berkesinambungan dalam upaya mencapai pelayanan kesehatan yang prima.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- NILAI-NILAI KERJA --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" data-aos="fade-up">
            <div class="text-center mb-4">
                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mb-2 font-monospace">BUDAYA KERJA</span>
                <h3 class="fw-bold text-success mb-1">NILAI - NILAI KERJA</h3>
                <p class="text-muted small">5 Nilai utama yang menjiwai etos kerja seluruh staf dan tenaga medis</p>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 text-center justify-content-center">
                {{-- 1. Kebersamaan --}}
                <div class="col">
                    <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">KEBERSAMAAN</h6>
                    </div>
                </div>

                {{-- 2. Profesional --}}
                <div class="col">
                    <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-award-fill fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">PROFESIONAL</h6>
                    </div>
                </div>

                {{-- 3. Kejujuran --}}
                <div class="col">
                    <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-hand-thumbs-up-fill fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">KEJUJURAN</h6>
                    </div>
                </div>

                {{-- 4. Keterbukaan --}}
                <div class="col">
                    <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-unlock-fill fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">KETERBUKAAN</h6>
                    </div>
                </div>

                {{-- 5. Disiplin --}}
                <div class="col">
                    <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100 transition-all hover-shadow">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-clipboard-check-fill fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">DISIPLIN</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. SEJARAH --}}
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

    {{-- 7. RIWAYAT KARUMKIT --}}
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
                ['Letkol dr. Soebandi', '1946 - 1949', null, '00 LETKOL dr. SOEBANDI.jpg'], 
                ['Mayor Cdm dr. Soedjono', '1959 - 1962', null, '01 MAYOR CDM dr. SOEDJONO.jpg'],
                ['Mayor Cdm dr. Karno Supojo', '1966 - 1969', null, '02 MAYOR CDM dr. KARNO SUPOJO.jpg'], 
                ['Kapten Cdm dr. Samuel Pakpahan', '1969 - 1972', null, '03 KAPTEN CDM dr. SAMUEL.jpg'],
                ['Kapten Cdm dr. Soedomo Pradono', '1972 - 1973', null, '04 KAPTEN CDM dr. SOEDOMO PRADONO.jpg'], 
                ['Mayor Cdm dr. Tom Uripan', '1973 - 1976', null, '05 MAYOR CDM dr. TOM URIPAN.jpg'],
                ['Mayor Cdm dr. Suryono', '1977 - 1983', null, '06 MAYOR CDM dr. SURYONO.jpg'], 
                ['Letkol Ckm dr. Koesnan D', '1983 - 1990', null, '07 LETKOL CKM dr. KOESNAN D.jpg'],
                ['Mayor Ckm dr. Budiharto', 'Januari 1991  - April 1991', null, '08 LETKOL CKM dr. BUDIARTO.jpg'], 
                ['Mayor Ckm dr. H. Zularnain Pohan', '91 Januari 1991 - 01 Juli 1995', null, '09 MAYOR CKM dr. H. ZULARNAIN POHAN.jpg'],
                ['Letkol Ckm Drs. Basuki, MS', '1997 - 2001', null, '10 LETKOL CKM Drs. BASUKI, MS.jpg'], 
                ['Letkol Ckm dr. Bambang Haryatno,Sp. S', '02 Agustus 2001 - 13 Agustus 2004', null, '11 LETKOL CKM dr. BAMBANG HARYATNO, Sp. S.jpg'], 
                ['Letkol Ckm dr. Muhammad Ilyas, Sp.An', '13 Agustus 2004 - 24 Maret 2006', null, '12 LETKOL CKM dr. MUHAMMAD ILYAS, Sp. An.jpg'], 
                ['Letkol Ckm dr. Agus Sunandar,Sp.An', '2006 - 2009', null, '13 LETKOL CKM dr. AGUS SUNANDAR, Sp. An.jpg'], 
                ['Letkol Ckm dr. Trio Tangkas W.M,Sp.PD', '2009 - 2013', null, '14 LETKOL CKM dr. TRIO TANGKAS W.M, Sp. PD.jpg'], 
                ['Letkol Ckm (K) dr. Dwi Ana Wahyuningrum', 'Februari 2013 - Desember 2013', null, '15 LETKOL CKM (K) dr. DWI ANA WAHYUNINGRUM.jpg'], 
                ['Letkol Ckm dr. A Rusli Budi Ansyah, Sp. B., MARS', '01 Maret 2013 - 31 Maret 2016', null, '16 LETKOL CKM dr. A. RUSLI BUDI ANSYAH, Sp. B., MARS.jpg'], 
                ['Letkol Ckm dr. Masri Sihombing, Sp.OT (K).,M.Kes', '01 April 2016 - 31 Agustus 2018', null, '17 LETKOL CKM dr. MASRI SIHOMBING, Sp.OT (K)., M.Kes.jpg'], 
                ['Letkol Ckm dr. Maksum Pandelima,Sp.OT', '01 September 2018 - 04 Januari 2021', null, '18 LETKOL CKM dr. MAKSUM PANDELIMA, Sp.OT.jpg'], 
                ['Letkol Ckm dr. MahyudimSp.M., M.Kes', '04 Januari 2021 - 25 Mei 2023', null, '19 LETKOL CKM dr. MAHYUDI, Sp.M., M.Kes.jpg'], 
                ['Letkol Ckm dr. Arif Puguh Santoso, Sp.PD., M.Kes', '25 Mei 2023 - 26 Juni 2025', null, '20 LETKOL CKM dr. ARIF PUGUH SANTOSO, Sp.PD., M.Kes.jpg'], 
                ['Letkol Ckm dr. Zaltonys Tolombot,Sp.M.', '01 September 2025 - Sekarang', 'active', '21 LETKOL CKM dr. ZALTONYS TOLOMBOT, Sp.M..jpg']
            ] as $pimpinan)
            <div class="col" data-aos="fade-up" data-aos-delay="50">
                <div class="card h-100 border-0 shadow-sm hover-shadow rounded-3 {{ isset($pimpinan[2]) ? 'bg-success text-white' : 'bg-white' }}">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            @if(isset($pimpinan[3]) && $pimpinan[3] !== '')
                                <img src="{{ asset('images/Ka_terdahulu/' . $pimpinan[3]) }}" alt="{{ $pimpinan[0] }}" class="rounded-3 shadow-sm border {{ isset($pimpinan[2]) ? 'border-white' : 'border-light' }}" style="width: 70px; height: 90px; object-fit: cover; object-position: top;" loading="lazy" decoding="async">
                            @else
                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold fs-3 {{ isset($pimpinan[2]) ? 'bg-white text-success' : 'bg-light text-secondary' }} shadow-sm" style="width: 70px; height: 90px;">
                                    {{ substr($pimpinan[0], 0, 1) }}
                                </div>
                            @endif
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

    @media (max-width: 992px) {
        .smart-sticky {
            top: 0; 
            padding-top: 10px;
        }
    }

    /* 2. NAV PILLS STYLING */
    .nav-pills { gap: 5px; }

    .nav-pills .nav-link { 
        border-radius: 50px; 
        padding: 8px 20px; 
        color: #198754; 
        transition: all 0.3s; 
        border: 1px solid transparent;
        white-space: nowrap;
        font-size: 0.95rem;
    }

    .nav-pills .nav-link:hover {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .nav-pills .nav-link.active {
        background-color: #198754; 
        color: white !important; 
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
    }

    /* 3. SCROLL & UTILITY */
    .info-section { scroll-margin-top: 160px; }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    .hover-scale { transition: transform 0.2s ease; }
    .hover-scale:hover { transform: translateY(-3px); }

    .hover-shadow { transition: all 0.25s ease; }
    .hover-shadow:hover { box-shadow: 0 10px 25px rgba(0,0,0,0.08); transform: translateY(-2px); }

    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.06); }

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
        // JS SCROLLSPY
        const sections = document.querySelectorAll('.info-section');
        const navLinks = document.querySelectorAll('.nav-scroll');

        function onScroll() {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                    
                    const menuContainer = document.getElementById('infoNav');
                    if(menuContainer && window.innerWidth < 992) {
                        const activeLinkLeft = link.offsetLeft;
                        const containerWidth = menuContainer.clientWidth;
                        menuContainer.scrollLeft = activeLinkLeft - (containerWidth / 2) + (link.clientWidth / 2);
                    }
                }
            });
        }

        window.addEventListener('scroll', onScroll);

        // SMOOTH SCROLL CLICK
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