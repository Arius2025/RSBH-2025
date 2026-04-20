@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 bg-white p-5 rounded-4 shadow-sm border border-light">
            
            {{-- Main Title --}}
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary mb-4" style="color: #24468f !important; font-size: 2.5rem;">Informasi Publik</h1>
            </div>

            {{-- Sub-header Bar --}}
            <div class="w-100 py-2 mb-4 text-center rounded-1" style="background-color: #e2e8f0; border-bottom: 2px solid #cbd5e1;">
                <h5 class="mb-0 fw-bold" style="color: #24468f; font-size: 1.1rem; letter-spacing: 0.5px;">
                    Informasi yang dipublikasikan secara berkala meliputi informasi terkait :
                </h5>
            </div>

            {{-- Numbered List --}}
            <div class="px-3">
                <div class="list-container" style="font-size: 1.05rem; line-height: 1.8; color: #334155;">
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">1.</span>
                        <span>Profil satuan</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">2.</span>
                        <span>Ringkasan informasi tentang program dan/atau kegiatan yang sedang dijalankan dalam lingkungan satuan.</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">3.</span>
                        <span>Kinerja dalam lingkup satuan berupa narasi realisasi program dan kegiatan yang telah maupun sedang dijalankan</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">4.</span>
                        <span>Ringkasan akses Informasi Publik</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">5.</span>
                        <span>Ringkasan tentang peraturan, keputusan, dan/atau kebijakan yang mengikat dan/atau berdampak bagi publik yang dikeluarkan oleh satuan</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">6.</span>
                        <span>Hak dan tata cara memperoleh Informasi Publik, serta tata cara pengajuan keberatan serta proses penyelesaian sengketa Informasi Publik berikut pihak-pihak yang bertanggungjawab yang dapat dihubungi</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">7.</span>
                        <span>Tata cara pengaduan penyalahgunaan wewenang atau pelanggaran yang dilakukan baik oleh pejabat satuan maupun pihak yang mendapatkan izin atau perjanjian kerja dari satuan yang bersangkutan</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">8.</span>
                        <span>Pengumuman pengadaan barang dan jasa sesuai dengan peraturan perundang-undangan terkait</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold me-3">9.</span>
                        <span>Prosedur peringatan dini dan prosedur evakuasi keadaan darurat di setiap kantor satuan.</span>
                    </div>
                </div>
            </div>

            {{-- Optional: Download Button or Footer link to match the premium feel --}}
            <div class="mt-5 text-center pt-4 border-top border-light">
                <p class="text-muted small">Untuk informasi lebih lanjut, silakan hubungi unit terkait.</p>
                <a href="{{ route('ppid') }}" class="btn btn-outline-primary rounded-pill px-4">Kembali ke Portal PPID</a>
            </div>

        </div>
    </div>
</div>

<style>
    body { background-color: #f8fafc; }
    .list-container span {
        display: block;
    }
    /* Typography optimization for premium feel */
    h1 { font-family: 'Inter', sans-serif; }
    .list-container { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
</style>
@endsection
