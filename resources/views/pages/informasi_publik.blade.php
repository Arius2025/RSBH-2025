@extends('layouts.app')

@section('content')
<section class="py-5 bg-gradient-success text-white text-center position-relative overflow-hidden mb-4">
    <div class="container py-3 position-relative z-1">
        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">Keterbukaan Informasi</span>
        <h1 class="display-5 fw-bold mb-2" style="letter-spacing: -1px;">Informasi Publik</h1>
        <p class="lead opacity-90 mb-0 mx-auto" style="max-width: 600px;">Daftar Informasi Berkala yang Dipublikasikan Resmi oleh RS Tk. III Baladhika Husada</p>
    </div>
</section>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="apple-glass-card p-4 p-md-5 rounded-5">
                
                {{-- Sub-header Bar --}}
                <div class="w-100 p-3 mb-4 text-center rounded-4 border border-success border-opacity-10 bg-success bg-opacity-10">
                    <h5 class="mb-0 fw-bold text-success" style="font-size: 1.05rem; letter-spacing: -0.3px;">
                        <i class="bi bi-info-circle-fill me-2"></i>Informasi yang Dipublikasikan Secara Berkala Meliputi:
                    </h5>
                </div>

                {{-- Numbered List in Apple Cards --}}
                <div class="row g-3">
                    @php
                        $items = [
                            'Profil satuan',
                            'Ringkasan informasi tentang program dan/atau kegiatan yang sedang dijalankan dalam lingkungan satuan.',
                            'Kinerja dalam lingkup satuan berupa narasi realisasi program dan kegiatan yang telah maupun sedang dijalankan.',
                            'Ringkasan akses Informasi Publik.',
                            'Ringkasan tentang peraturan, keputusan, dan/atau kebijakan yang mengikat dan/atau berdampak bagi publik yang dikeluarkan oleh satuan.',
                            'Hak dan tata cara memperoleh Informasi Publik, serta tata cara pengajuan keberatan serta proses penyelesaian sengketa Informasi Publik berikut pihak-pihak yang bertanggung jawab.',
                            'Tata cara pengaduan penyalahgunaan wewenang atau pelanggaran yang dilakukan baik oleh pejabat satuan maupun pihak yang mendapatkan izin.',
                            'Pengumuman pengadaan barang dan jasa sesuai dengan peraturan perundang-undangan terkait.',
                            'Prosedur peringatan dini dan prosedur evakuasi keadaan darurat di setiap kantor satuan.'
                        ];
                    @endphp

                    @foreach($items as $index => $item)
                    <div class="col-12">
                        <div class="apple-list-item p-3.5 px-4 rounded-4 d-flex align-items-start gap-3">
                            <span class="apple-number-badge shrink-0 fw-bold">{{ $index + 1 }}</span>
                            <span class="text-dark fs-6 lh-base pt-1">{{ $item }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Footer Link --}}
                <div class="mt-5 text-center pt-4 border-top border-light">
                    <p class="text-muted small">Untuk permohonan informasi lebih lanjut, silakan hubungi unit PPID terkait.</p>
                    <a href="{{ route('ppid') }}" class="btn btn-outline-success rounded-pill px-4 py-2.5 fw-bold shadow-sm hover-lift">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Portal PPID
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #198754 0%, #115c39 100%);
}

.apple-glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    border-radius: 28px;
}

.apple-list-item {
    background: rgba(248, 249, 250, 0.9);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.25s ease;
}

.apple-list-item:hover {
    background: #ffffff;
    border-color: rgba(25, 135, 84, 0.3);
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.08);
    transform: translateX(4px);
}

.apple-number-badge {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #198754 0%, #115c39 100%);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    box-shadow: 0 4px 10px rgba(25, 135, 84, 0.25);
}
</style>
@endsection
