@extends('layouts.app')

@section('content')


<section class="py-5 bg-white">
    <div class="container">
        <!-- Tab Navigation -->
        <div class="mb-5 overflow-auto">
            <ul class="nav nav-pills ppid-profil-tabs flex-nowrap border-bottom pb-2" id="profilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4 py-3" id="struktur-tab" data-bs-toggle="tab" data-bs-target="#struktur" type="button" role="tab">Struktur Organisasi PPID</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3" id="visimisi-tab" data-bs-toggle="tab" data-bs-target="#visimisi" type="button" role="tab">Visi dan Misi PPID</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3" id="tugas-tab" data-bs-toggle="tab" data-bs-target="#tugas" type="button" role="tab">Uraian Tugas dan Wewenang PPID</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3" id="maklumat-tab" data-bs-toggle="tab" data-bs-target="#maklumat" type="button" role="tab">Maklumat</button>
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

@media (max-width: 768px) {
    .ppid-info-img {
        max-height: 50vh;
    }
}

.ppid-profil-tabs .nav-link {
    color: #6c757d;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    border-radius: 0;
    white-space: nowrap;
    transition: all 0.3s ease;
}
.ppid-profil-tabs .nav-link:hover {
    color: #198754;
}
.ppid-profil-tabs .nav-link.active {
    color: #198754;
    border-bottom-color: #198754;
    background: none;
}
.italic { font-style: italic; }
</style>
@endsection
