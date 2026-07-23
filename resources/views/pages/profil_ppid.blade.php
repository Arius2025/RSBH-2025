@extends('layouts.app')

@section('content')


<section class="py-5 bg-gradient-success text-white text-center position-relative overflow-hidden mb-4">
    <div class="container py-3 position-relative z-1">
        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">Profil Resmi</span>
        <h1 class="display-5 fw-bold mb-2" style="letter-spacing: -1px;">Profil PPID</h1>
        <p class="lead opacity-90 mb-0 mx-auto" style="max-width: 600px;">Struktur Organisasi, Visi, Misi, Tugas & Maklumat Pelayanan PPID</p>
    </div>
</section>

<section class="py-4 bg-light">
    <div class="container">
        <!-- Apple Segmented Control Tab Navigation -->
        <div class="apple-tab-container p-2 mb-5 mx-auto overflow-auto">
            <ul class="nav nav-pills nav-fill apple-segmented-control flex-nowrap" id="profilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill py-2.5 px-4 fw-bold" id="struktur-tab" data-bs-toggle="tab" data-bs-target="#struktur" type="button" role="tab">Struktur Organisasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill py-2.5 px-4 fw-bold" id="visimisi-tab" data-bs-toggle="tab" data-bs-target="#visimisi" type="button" role="tab">Visi & Misi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill py-2.5 px-4 fw-bold" id="tugas-tab" data-bs-toggle="tab" data-bs-target="#tugas" type="button" role="tab">Tugas & Wewenang</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill py-2.5 px-4 fw-bold" id="maklumat-tab" data-bs-toggle="tab" data-bs-target="#maklumat" type="button" role="tab">Maklumat</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="profilTabsContent">
            <!-- Struktur Tab -->
            <div class="tab-pane fade show active" id="struktur" role="tabpanel">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h4 class="fw-bold text-success mb-4">Struktur Organisasi PPID RS Tk. III Baladhika Husada</h4>
                        <div class="bg-light rounded-4 p-2 p-md-3 mb-4">
                            <!-- Placeholder for Organization Chart -->
                            <img src="{{ asset('images/PPID/STRUKTUR ORGANISASI.png') }}" class="img-fluid rounded-3 shadow-sm mb-4 ppid-info-img" alt="Struktur Organisasi PPID" onerror="this.src='https://placehold.co/1200x600/f8f9fa/198754?text=Struktur+Organisasi+PPID'">
                            <img src="{{ asset('images/PPID/ANGGOTA.png') }}" class="img-fluid rounded-3 shadow-sm ppid-info-img" alt="Anggota PPID" onerror="this.src='https://placehold.co/1200x800/f8f9fa/198754?text=Anggota+PPID'">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi Misi Tab -->
            <div class="tab-pane fade" id="visimisi" role="tabpanel">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h4 class="fw-bold text-success mb-4">Visi Misi PPID RS Tk. III Baladhika Husada</h4>
                        <div class="bg-light rounded-4 p-2 p-md-3 mb-4">
                            <!-- Placeholder for Visi Misi -->
                            <img src="{{ asset('images/PPID/visi_misi.jpeg') }}" class="img-fluid rounded-3 shadow-sm ppid-info-img" alt="Visi Misi PPID" onerror="this.src='https://placehold.co/1200x600/f8f9fa/198754?text=Visi+Misi+PPID'">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas & Fungsi Tab -->
            <div class="tab-pane fade" id="tugas" role="tabpanel">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                        
                        <table class="table table-hover table-rounded table-striped border gy-2 gs-2 bg-light-success">
                            <thead class="text-center align-middle">
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <th style="width:40%;">PPID RS Baladhika Husada Jember</th>
                                    <th style="width:30%;">Tugas</th>
                                    <th style="width:30%;">Wewenang</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                                <tr>
                                    <td class="text-start">PPID pada RS Baladhika Husada Jember merupakan PPID Pelaksana yang
                                        bertanggungjawab dalam membantu PPID Utama dalam pelaksanaan layanan Informasi
                                        Publik yang meliputi proses penyimpanan, pendokumentasian, penyediaan dan pelayanan
                                        Informasi Publik di RS Baladhika Husada Jember.</td>
                                    <td class="text-start">
                                        <ul style="text-align: justify; text-justify: inter-word;">
                                            <li>Membantu PPID melaksanakan tanggungjawab, tugas, dan kewenangannya</li>
                                            <li>Melaksanakan kebijakan teknis layanan Informasi Publik yang telah ditetapkan
                                                PPID</li>
                                            <li>Mengonsolidasikan proses penyimpanan, pendokumentasian, penyediaan dan
                                                pelayanan Informasi Publik</li>
                                            <li>Mengumpulkan dokumen Informasi Publik dari Petugas Pelayanan Informasi di
                                                Badan Publik</li>
                                            <li>Membantu PPID melakukan verifikasi dokumen Informasi Publik</li>
                                            <li>Membantu membuat, mengelola, memelihara, dan memutakhirkan Daftar Informasi
                                                Publik</li>
                                            <li>Menjamin ketersediaan dan akselerasi layanan Informasi Publik agar mudah
                                                diakses oleh publik</li>
                                        </ul>
                                    </td>
                                    <td class="text-start">
                                        <ul style="text-align: justify; text-justify: inter-word;">
                                            <li>Meminta dokumen Informasi Publik dari Petugas Pelayanan Informasi di Badan
                                                Publik</li>
                                            <li>Meminta klarifikasi kepada Petugas Pelayanan Informasi di Badan Publik dalam
                                                melaksanakan pelayanan Informasi Publik.</li>
                                            <li>Menugaskan Petugas Pelayanan Informasi untuk menyiapkan dokumen untuk
                                                membantu PPID dalam melaksanakan pengujian konsekuensi atas Informasi Publik
                                                yang akan dikecualikan atau pembuatan pertimbangan tertulis dalam hal suatu
                                                Informasi Publik dikecualikan atau Permintaan Informasi Publik ditolak</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maklumat Tab -->
            <div class="tab-pane fade" id="maklumat" role="tabpanel">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h4 class="fw-bold text-success mb-4">Maklumat PPID RS Tk. III Baladhika Husada</h4>
                        <div class="bg-light rounded-4 p-2 p-md-3 mb-4">
                            <!-- Placeholder for Maklumat -->
                            <img src="{{ asset('images/PPID/maklumat.jpeg') }}" class="img-fluid rounded-3 shadow-sm ppid-info-img" alt="Maklumat PPID" onerror="this.src='https://placehold.co/1200x600/f8f9fa/198754?text=Maklumat+PPID'">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ route('ppid') }}" class="btn btn-outline-success px-5 rounded-pill shadow-sm py-2">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Menu Utama PPID
            </a>
        </div>
    </div>
</section>

<style>
.ppid-info-img {
    width: 100%;
    height: auto;
    max-height: 70vh;
    object-fit: contain;
    background-color: #f8f9fa;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #198754 0%, #115c39 100%);
}

.apple-tab-container {
    background: rgba(220, 225, 230, 0.6);
    backdrop-filter: blur(20px);
    border-radius: 9999px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    max-width: 800px;
}

.apple-segmented-control .nav-link {
    color: #495057;
    font-size: 0.85rem;
    letter-spacing: 0.3px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    white-space: nowrap;
}

.apple-segmented-control .nav-link.active {
    background-color: #ffffff;
    color: #198754;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

.ppid-info-img {
    width: 100%;
    height: auto;
    max-height: 70vh;
    object-fit: contain;
    background-color: #f8f9fa;
}

@media (max-width: 768px) {
    .ppid-info-img {
        max-height: 50vh;
    }
}
.italic { font-style: italic; }
</style>
@endsection
