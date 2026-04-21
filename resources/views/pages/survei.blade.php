@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-success display-6">Layanan PPID Online</h2>
            <p class="lead text-muted mx-auto" style="max-width: 800px;">
                Kemudahan akses informasi publik dan pengaduan layanan melalui platform digital kami yang terintegrasi.
            </p>
            <hr class="w-25 mx-auto border-success border-3">
        </div>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="fade-up">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 g-xl-5 justify-content-center">
                    <!-- Pengaduan Layanan Publik -->
                    <div class="col-md-4">
                        <div class="h-100 text-center service-card transition p-4 rounded-4 bg-light shadow-sm">
                            <a href="https://forms.gle/jkMU1VD2uoB2tn7R7" target="_blank" class="text-decoration-none d-block">
                                <div class="icon-wrapper mb-4 mx-auto d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                                    <img src="{{ asset('images/PPID/survey.png') }}" class="img-fluid p-3" alt="Pengaduan Layanan Publik">
                                </div>
                                <h5 class="fw-bold text-success mb-3">Survey Kepuasan Pasien</h5>
                                <p class="small text-muted mb-0">Isi survey kepuasan pasien untuk meningkatkan kualitas layanan kami.</p>
                            </a>
                        </div>
                    </div>

                    <!-- Permohonan Informasi -->
                    <div class="col-md-4">
                        <div class="h-100 text-center service-card transition p-4 rounded-4 bg-light shadow-sm">
                            <a href="https://forms.gle/dyT994Rm7HanWv1D6" target="_blank" class="text-decoration-none d-block">
                                <div class="icon-wrapper mb-4 mx-auto d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                                    <img src="{{ asset('images/PPID/survey.png') }}" class="img-fluid p-3" alt="Permohonan Informasi">
                                </div>
                                <h5 class="fw-bold text-success mb-3">Form Permohonan informasi</h5>
                                <p class="small text-muted mb-0">Isi form permohonan informasi untuk mendapatkan informasi yang Anda butuhkan.</p>
                            </a>
                        </div>
                    </div>

                    <!-- Keberatan Atas Permohonan Informasi -->
                    <div class="col-md-4">
                        <div class="h-100 text-center service-card transition p-4 rounded-4 bg-light shadow-sm">
                            <a href="https://forms.gle/BMCfGHeFUL8hfXbb6" target="_blank" class="text-decoration-none d-block">
                                <div class="icon-wrapper mb-4 mx-auto d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                                    <img src="{{ asset('images/PPID/survey.png') }}" class="img-fluid p-3" alt="Keberatan Informasi">
                                </div>
                                <h5 class="fw-bold text-success mb-3">Form Keberatan informasi</h5>
                                <p class="small text-muted mb-0">Layanan pengajuan keberatan jika permohonan informasi Anda ditolak atau tidak puas.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ route('ppid') }}" class="btn btn-outline-success px-5 rounded-pill shadow-sm py-2">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke PPID
            </a>
        </div>
    </div>
</section>

<style>
.service-card {
    border: 1px solid rgba(25, 135, 84, 0.1);
}
.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
    background-color: #f0fdf4 !important; /* light green tint */
}
.icon-wrapper img {
    transition: transform 0.5s ease;
}
.service-card:hover .icon-wrapper img {
    transform: scale(1.1) rotate(5deg);
}
</style>
@endsection
