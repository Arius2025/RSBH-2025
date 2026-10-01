@extends('layouts.app')

@section('content')

{{-- Header Halaman Informasi Leaflet --}}
<section class="bg-light border-bottom py-3 py-md-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 mb-md-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('informasi') }}" class="text-decoration-none text-muted">Informasi</a></li>
                <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">Leaflet Kesehatan</li>
            </ol>
        </nav>
        
        <div class="row align-items-md-center justify-content-between gy-2">
            <div class="col-lg-8">
                <h1 class="h4 fw-bold text-dark mb-1">Leaflet Informasi Kesehatan</h1>
                <p class="text-secondary small mb-0" style="max-width: 680px; line-height: 1.5;">
                    Materi edukasi dan promosi kesehatan resmi dari RS Baladhika Husada (DKT Jember). Anda dapat membaca langsung atau mengunduh berkas PDF untuk panduan kesehatan.
                </p>
            </div>
            <div class="col-lg-auto d-none d-md-block">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-2 bg-white border rounded-3 shadow-xs text-muted small">
                    <i class="bi bi-journal-medical text-success fs-5"></i>
                    <span>Tersedia <strong>{{ $totalCount }}</strong> materi publikasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Konten Utama dan Filter Dokumen --}}
<div class="container py-3 py-md-4">
    
    {{-- Bilah Pencarian dan Kategori --}}
    <div class="bg-white border rounded-3 p-2.5 p-md-3 mb-3 shadow-xs">
        <div class="row g-2 align-items-center justify-content-between">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-2.5">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="liveSearchInput" class="form-control border-start-0 py-2 ps-1" placeholder="Cari topik atau judul leaflet..." value="{{ request('q') }}" aria-label="Cari judul leaflet">
                </div>
            </div>

            <div class="col-12 col-md-auto text-muted small d-flex align-items-center justify-content-between justify-content-md-end">
                <span>Menampilkan <strong class="text-dark" id="visibleCounter">{{ $leaflets->total() }}</strong> dari {{ $totalCount }} leaflet</span>
            </div>
        </div>

        {{-- Navigasi Filter Kategori --}}
        <div class="d-flex align-items-center gap-1.5 overflow-auto pt-2 mt-2 border-top category-scroll-container" style="white-space: nowrap;">
            <a href="{{ route('leaflet.index', ['q' => request('q')]) }}" 
               class="btn btn-sm rounded-2 px-2.5 py-1 {{ !request('kategori') || request('kategori') === 'Semua' ? 'btn-success fw-medium' : 'btn-outline-secondary' }}" style="font-size: 0.82rem;">
                Semua <span class="badge {{ !request('kategori') || request('kategori') === 'Semua' ? 'bg-white text-success' : 'bg-light text-dark border' }} ms-1">{{ $totalCount }}</span>
            </a>
            @foreach($categories as $catName => $catCount)
                <a href="{{ route('leaflet.index', ['kategori' => $catName, 'q' => request('q')]) }}" 
                   class="btn btn-sm rounded-2 px-2.5 py-1 {{ request('kategori') === $catName ? 'btn-success fw-medium' : 'btn-outline-secondary' }}" style="font-size: 0.82rem;">
                    {{ $catName }} <span class="badge {{ request('kategori') === $catName ? 'bg-white text-success' : 'bg-light text-dark border' }} ms-1">{{ $catCount }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Grid Kartu Leaflet: 2 Kolom di Layar HP agar Tidak Terlalu Banyak Scroll --}}
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-sm-3 g-lg-4" id="leafletGrid">
        @forelse($leaflets as $leaf)
            <div class="col leaflet-item" data-title="{{ strtolower($leaf->title) }}" data-category="{{ strtolower($leaf->category) }}">
                <div class="card h-100 border rounded-3 overflow-hidden leaflet-card bg-white position-relative d-flex flex-column">
                    
                    {{-- Wadah Sampul Dokumen Proporsi Brosur Lanskap --}}
                    <div class="position-relative leaflet-cover-container" style="padding-top: 68%; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        @if($leaf->thumbnail_path)
                            <img src="{{ $leaf->thumbnail_url }}" alt="{{ $leaf->title }}" class="position-absolute top-0 start-0 w-100 h-100 leaflet-cover-image" loading="lazy">
                        @else
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted p-2 text-center">
                                <i class="bi bi-file-earmark-medical fs-2 text-success opacity-50 mb-1"></i>
                                <span class="small fw-semibold text-truncate w-100" style="font-size: 0.75rem;">{{ $leaf->title }}</span>
                            </div>
                        @endif

                        {{-- Label Kategori Dokumen --}}
                        <div class="position-absolute top-0 start-0 m-1.5 m-sm-2 z-2">
                            <span class="badge bg-white text-dark border shadow-xs rounded-1 px-1.5 px-sm-2 py-0.5 small fw-semibold" style="font-size: 0.68rem;">
                                {{ $leaf->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Informasi & Tombol Baca --}}
                    <div class="card-body p-2 p-sm-3 d-flex flex-column flex-grow-1">
                        <h2 class="card-title fw-semibold text-dark mb-1 mb-sm-2 text-truncate-2" title="{{ $leaf->title }}" style="font-size: 0.85rem; line-height: 1.35; min-height: 2.3em;">
                            {{ $leaf->title }}
                        </h2>

                        <div class="mt-auto pt-1.5 border-top d-flex align-items-center justify-content-between text-muted small mb-2 mb-sm-2.5" style="font-size: 0.72rem;">
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> {{ $leaf->file_size ?? 'PDF' }}
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-eye text-secondary"></i> <span id="views_{{ $leaf->id }}">{{ number_format($leaf->views_count) }}</span>
                            </span>
                        </div>

                        {{-- Tombol Buka Reader --}}
                        <button type="button" 
                                class="btn btn-outline-success w-100 rounded-2 fw-semibold d-flex align-items-center justify-content-center gap-1 py-1.5 py-sm-2 btn-open-reader"
                                style="font-size: 0.82rem;"
                                data-id="{{ $leaf->id }}"
                                data-title="{{ $leaf->title }}"
                                data-category="{{ $leaf->category }}"
                                data-stream="{{ route('leaflet.stream', $leaf->id) }}"
                                data-download="{{ route('leaflet.download', $leaf->id) }}">
                            <i class="bi bi-book"></i> <span>Baca</span>
                        </button>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 w-100 text-center py-4 my-3" id="emptyStateBox">
                <div class="p-4 bg-white border rounded-3 shadow-xs mx-auto" style="max-width: 440px;">
                    <i class="bi bi-journal-x fs-1 text-muted mb-2 d-block"></i>
                    <h5 class="fw-bold text-dark mb-1">Belum Ada Leaflet Tersedia</h5>
                    <p class="text-muted small mb-3">Materi leaflet untuk kategori atau kata kunci pencarian ini belum ditemukan.</p>
                    <a href="{{ route('leaflet.index') }}" class="btn btn-outline-success btn-sm rounded-2 px-3 py-1.5">
                        Lihat Semua Leaflet
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pesan Hasil Pencarian Kosong --}}
    <div class="text-center py-4 my-3 d-none" id="noSearchResults">
        <div class="p-4 bg-white border rounded-3 shadow-xs mx-auto" style="max-width: 440px;">
            <i class="bi bi-search fs-1 text-muted mb-2 d-block"></i>
            <h5 class="fw-bold text-dark mb-1">Tidak Ada Hasil Ditemukan</h5>
            <p class="text-muted small mb-3">Tidak ada dokumen leaflet yang cocok dengan kata kunci pencarian Anda.</p>
            <button type="button" class="btn btn-outline-success btn-sm rounded-2 px-3 py-1.5" onclick="resetLiveSearch()">
                Bersihkan Pencarian
            </button>
        </div>
    </div>

    {{-- Navigasi Halaman (Pagination) --}}
    @if($leaflets->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $leaflets->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

{{-- Modal Pembaca PDF Interaktif --}}
<div class="modal fade" id="pdfReaderModal" tabindex="-1" aria-labelledby="pdfReaderTitle" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark text-white border-0 d-flex flex-column" style="height: 100vh;">
            
            {{-- Header Pembaca --}}
            <div class="modal-header border-bottom border-secondary bg-black py-2 px-2.5 px-md-3 flex-shrink-0">
                <div class="d-flex align-items-center gap-1.5 overflow-hidden me-auto" style="max-width: 55%;">
                    <div class="bg-success text-white p-1.5 rounded-2 d-none d-sm-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-medical fs-6"></i>
                    </div>
                    <div class="text-truncate">
                        <h2 class="modal-title h6 fw-bold text-white mb-0 text-truncate" id="pdfReaderTitle" style="font-size: 0.9rem;">Judul Leaflet</h2>
                        <div class="d-flex align-items-center gap-1.5 mt-0.5">
                            <span class="badge bg-secondary rounded-1 px-1.5 py-0.5 small" id="pdfReaderCategory" style="font-size: 0.68rem;">Kategori</span>
                        </div>
                    </div>
                </div>

                {{-- Toolbar Zoom & Fit (Desktop & Tablet) --}}
                <div class="d-none d-md-flex align-items-center gap-1 mx-2" id="pdfZoomToolbar">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnZoomOut" title="Perkecil">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                    <span class="text-white-50 small px-1.5 font-monospace" id="zoomPercent" style="min-width: 44px; text-align: center;">100%</span>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnZoomIn" title="Perbesar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnFitWidth" title="Sesuaikan Lebar Layar">
                        <i class="bi bi-arrows-expand"></i>
                    </button>
                </div>

                {{-- Aksi Unduh, Tab Baru, dan Tombol Tutup --}}
                <div class="d-flex align-items-center gap-1.5 ms-auto">
                    <a href="#" id="openTabBtn" target="_blank" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1 d-none d-sm-inline-flex align-items-center gap-1" title="Buka berkas di tab baru">
                        <i class="bi bi-box-arrow-up-right"></i> <span class="d-none d-md-inline">Tab Baru</span>
                    </a>
                    <a href="#" id="downloadPdfBtn" download class="btn btn-sm btn-success rounded-2 px-2 py-1 fw-medium d-inline-flex align-items-center gap-1" title="Unduh berkas PDF">
                        <i class="bi bi-download"></i> <span class="d-none d-md-inline">Unduh</span>
                    </a>
                    
                    {{-- Tombol Tutup Header --}}
                    <button type="button" 
                            class="btn btn-danger btn-sm rounded-2 px-2.5 py-1 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm" 
                            data-bs-dismiss="modal" 
                            aria-label="Tutup penampil dokumen">
                        <i class="bi bi-x-lg"></i> <span class="d-none d-sm-inline">Tutup</span>
                    </button>
                </div>
            </div>

            {{-- Bilah Navigasi Halaman Dokumen (Sub-header: Selalu terlihat di HP & Desktop tanpa terhalang dock bawah) --}}
            <div class="bg-black bg-opacity-95 border-bottom border-secondary py-1.5 px-2 px-md-3 d-flex align-items-center justify-content-between flex-shrink-0" id="pdfPageNavBar" style="z-index: 10;">
                <div class="d-flex align-items-center gap-1.5">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2.5 py-1.5 d-inline-flex align-items-center justify-content-center" id="btnPrevPage" title="Halaman Sebelumnya" style="min-height: 38px; min-width: 38px;">
                        <i class="bi bi-chevron-left"></i> <span class="d-none d-sm-inline ms-1">Sebelumnya</span>
                    </button>
                    
                    {{-- Tombol Pemilih Halaman Cepat (Sisi 1 / Sisi 2) --}}
                    <div class="d-inline-flex gap-1" id="pagePillsContainer">
                        {{-- Tombol Halaman 1 & Halaman 2 dinamis --}}
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2.5 py-1.5 d-inline-flex align-items-center justify-content-center" id="btnNextPage" title="Halaman Selanjutnya" style="min-height: 38px; min-width: 38px;">
                        <span class="d-none d-sm-inline me-1">Selanjutnya</span> <i class="bi bi-chevron-right"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-1.5 gap-md-2">
                    <span class="badge bg-secondary bg-opacity-75 text-white rounded-2 px-2 py-1.5 small font-monospace" id="pageRatioText">Hal 1 dari 2</span>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1.5 d-inline-flex align-items-center gap-1" id="btnToggleAllPages" title="Tampilkan Semua Halaman Sekaligus" style="min-height: 38px;">
                        <i class="bi bi-layers"></i> <span class="small d-none d-sm-inline" id="btnToggleAllText">Semua</span>
                    </button>
                </div>
            </div>

            {{-- Area Pembaca Dokumen --}}
            <div class="modal-body p-0 position-relative flex-grow-1 d-flex flex-column overflow-hidden" style="background: #0f172a;">
                
                {{-- Indikator Memuat Dokumen --}}
                <div id="pdfLoadingIndicator" class="position-absolute top-50 start-50 translate-middle text-center" style="z-index: 20;">
                    <div class="spinner-border text-success" style="width: 2.5rem; height: 2.5rem;" role="status">
                        <span class="visually-hidden">Memuat dokumen...</span>
                    </div>
                    <div class="mt-2 text-white-50 small fw-medium" id="pdfLoadingText">Menyiapkan dokumen leaflet...</div>
                </div>

                {{-- Tampilan Saat Dokumen Gagal Dirender --}}
                <div id="pdfErrorState" class="position-absolute top-50 start-50 translate-middle text-center p-3 rounded-3 bg-dark border border-secondary shadow-lg d-none" style="z-index: 15; max-width: 400px; width: 90%;">
                    <i class="bi bi-file-earmark-pdf fs-1 text-warning mb-2 d-block"></i>
                    <h3 class="h6 fw-bold text-white mb-1">Penampil Dokumen</h3>
                    <p class="text-white-50 small mb-3">Dokumen dapat dibuka secara langsung di tab browser atau diunduh ke perangkat Anda.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" id="fallbackOpenTabBtn" target="_blank" class="btn btn-outline-light btn-sm rounded-2 px-2.5">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Tab Baru
                        </a>
                        <a href="#" id="fallbackDownloadBtn" download class="btn btn-success btn-sm rounded-2 px-2.5">
                            <i class="bi bi-download me-1"></i> Unduh PDF
                        </a>
                    </div>
                </div>

                {{-- Wadah Tampilan Halaman Dokumen --}}
                <div id="pdfCanvasContainer" class="w-100 h-100 overflow-auto p-2 p-md-3 d-flex flex-column align-items-center justify-content-start" style="scroll-behavior: smooth;">
                    {{-- Halaman kanvas dirender di sini --}}
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    .category-scroll-container::-webkit-scrollbar {
        height: 3px;
    }
    .category-scroll-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .leaflet-card {
        border-color: #e2e8f0;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .leaflet-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border-color: #cbd5e1;
    }
    .leaflet-cover-image {
        object-fit: contain;
        background-color: #f8fafc;
        padding: 2px;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    #pdfCanvasContainer {
        width: 100%;
        height: 100%;
        overflow-y: auto;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-sizing: border-box;
        -webkit-overflow-scrolling: touch;
    }
    .pdf-page-card {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        margin: auto;
        overflow: visible;
        box-sizing: border-box;
    }
    .pdf-page-card canvas {
        display: block;
        border-radius: 6px;
    }
    #pdfReaderModal {
        z-index: 1250 !important;
    }
    .modal-backdrop.show {
        z-index: 1240 !important;
    }
    #pdfPageNavBar {
        position: sticky;
        top: 0;
        z-index: 20;
    }
    #pdfPageNavBar button {
        touch-action: manipulation;
    }
    .btn-open-reader:focus-visible,
    .btn:focus-visible {
        outline: 2px solid #198754;
        outline-offset: 2px;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    if (typeof pdfjsLib !== 'undefined') {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('pdfReaderModal');
        if (!modalEl) return;

        let pdfReaderModal = null;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            pdfReaderModal = new bootstrap.Modal(modalEl);
        }

        const loadingIndicator = document.getElementById('pdfLoadingIndicator');
        const loadingText = document.getElementById('pdfLoadingText');
        const errorState = document.getElementById('pdfErrorState');
        const canvasContainer = document.getElementById('pdfCanvasContainer');
        const downloadBtn = document.getElementById('downloadPdfBtn');
        const openTabBtn = document.getElementById('openTabBtn');
        const fallbackOpenTabBtn = document.getElementById('fallbackOpenTabBtn');
        const fallbackDownloadBtn = document.getElementById('fallbackDownloadBtn');
        const pdfTitleEl = document.getElementById('pdfReaderTitle');
        const pdfCatEl = document.getElementById('pdfReaderCategory');
        const zoomPercent = document.getElementById('zoomPercent');
        const btnZoomIn = document.getElementById('btnZoomIn');
        const btnZoomOut = document.getElementById('btnZoomOut');
        const btnFitWidth = document.getElementById('btnFitWidth');
        const btnPrevPage = document.getElementById('btnPrevPage');
        const btnNextPage = document.getElementById('btnNextPage');
        const pagePillsContainer = document.getElementById('pagePillsContainer');
        const pageRatioText = document.getElementById('pageRatioText');
        const btnToggleAllPages = document.getElementById('btnToggleAllPages');
        const btnToggleAllText = document.getElementById('btnToggleAllText');

        let currentPdfDoc = null;
        let currentPageIndex = 1;
        let currentScale = 1.0;
        let viewMode = 'single'; // 'single' atau 'all'
        let currentRenderTask = null;

        // Tombol Buka Reader
        document.querySelectorAll('.btn-open-reader').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                openPdfModal(
                    this.dataset.id,
                    this.dataset.title,
                    this.dataset.category,
                    this.dataset.stream,
                    this.dataset.download
                );
            });
        });

        // Klik pada Kartu Leaflet
        document.querySelectorAll('.leaflet-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.btn-open-reader')) return;
                const btn = this.querySelector('.btn-open-reader');
                if (btn) btn.click();
            });
        });

        async function openPdfModal(id, title, category, streamUrl, downloadUrl) {
            pdfTitleEl.textContent = title;
            pdfCatEl.textContent = category;
            downloadBtn.href = downloadUrl;
            openTabBtn.href = streamUrl;
            if (fallbackDownloadBtn) fallbackDownloadBtn.href = downloadUrl;
            if (fallbackOpenTabBtn) fallbackOpenTabBtn.href = streamUrl;

            // Batalkan render aktif sebelumnya jika ada
            if (currentRenderTask) {
                try { currentRenderTask.cancel(); } catch (e) {}
                currentRenderTask = null;
            }

            canvasContainer.innerHTML = '';
            pagePillsContainer.innerHTML = '';
            errorState.classList.add('d-none');
            loadingIndicator.classList.remove('d-none');
            loadingText.textContent = 'Menyiapkan dokumen leaflet...';
            currentPageIndex = 1;
            currentScale = 1.0;
            viewMode = 'single';
            updateViewModeButton();

            if (!pdfReaderModal && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                pdfReaderModal = new bootstrap.Modal(modalEl);
            }
            if (pdfReaderModal) {
                pdfReaderModal.show();
            }

            // Catat jumlah tayangan dokumen
            fetch(`/api/leaflet/${id}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(r => r.json()).then(data => {
                if (data.success) {
                    const counterEl = document.getElementById(`views_${id}`);
                    if (counterEl) counterEl.textContent = Number(data.views_count).toLocaleString();
                }
            }).catch(console.error);

            // Render dokumen dengan PDF.js
            try {
                if (typeof pdfjsLib === 'undefined') {
                    throw new Error('PDF.js tidak tersedia');
                }

                loadingText.textContent = 'Mengunduh data dokumen...';
                const loadingTask = pdfjsLib.getDocument({
                    url: streamUrl,
                    cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                    cMapPacked: true
                });

                currentPdfDoc = await loadingTask.promise;

                buildPageNavigation();
                updateZoomBadge();

                await renderCurrentView();
                loadingIndicator.classList.add('d-none');
            } catch (err) {
                console.warn('PDF.js rendering error:', err);
                loadingIndicator.classList.add('d-none');
                errorState.classList.remove('d-none');
            }
        }

        // Buat Tombol Halaman Cepat (Pills)
        function buildPageNavigation() {
            if (!currentPdfDoc) return;
            pagePillsContainer.innerHTML = '';
            const total = currentPdfDoc.numPages;

            for (let i = 1; i <= total; i++) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `btn btn-sm py-1.5 px-2.5 rounded-2 ${i === currentPageIndex && viewMode === 'single' ? 'btn-success fw-bold' : 'btn-outline-secondary text-white'}`;
                btn.style.fontSize = '0.82rem';
                btn.style.minHeight = '38px';
                btn.style.minWidth = '42px';
                
                // Beri label Sisi 1 / Sisi 2 jika brosur 2 halaman
                if (total === 2) {
                    btn.textContent = i === 1 ? 'Sisi 1' : 'Sisi 2';
                    btn.title = i === 1 ? 'Sisi Luar Leaflet' : 'Sisi Dalam Leaflet';
                } else {
                    btn.textContent = `Hal ${i}`;
                    btn.title = `Halaman ${i}`;
                }

                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (viewMode !== 'single' || currentPageIndex !== i) {
                        viewMode = 'single';
                        currentPageIndex = i;
                        updateViewModeButton();
                        renderCurrentView();
                    }
                });
                pagePillsContainer.appendChild(btn);
            }

            updateNavButtonsState();
        }

        function updateNavButtonsState() {
            if (!currentPdfDoc) return;
            const total = currentPdfDoc.numPages;

            if (btnPrevPage) btnPrevPage.disabled = (viewMode === 'all' || currentPageIndex <= 1);
            if (btnNextPage) btnNextPage.disabled = (viewMode === 'all' || currentPageIndex >= total);

            if (pageRatioText) {
                if (viewMode === 'all') {
                    pageRatioText.textContent = `Semua (${total} Hal)`;
                } else {
                    pageRatioText.textContent = total === 2 
                        ? (currentPageIndex === 1 ? 'Sisi 1 (Luar)' : 'Sisi 2 (Dalam)')
                        : `Hal ${currentPageIndex} dari ${total}`;
                }
            }

            // Perbarui status aktif pada tombol pills
            const buttons = pagePillsContainer.querySelectorAll('button');
            buttons.forEach((btn, idx) => {
                const pageNum = idx + 1;
                if (viewMode === 'single' && pageNum === currentPageIndex) {
                    btn.className = 'btn btn-sm py-1.5 px-2.5 rounded-2 btn-success fw-bold';
                } else {
                    btn.className = 'btn btn-sm py-1.5 px-2.5 rounded-2 btn-outline-secondary text-white';
                }
            });
        }

        function updateViewModeButton() {
            if (!btnToggleAllPages) return;
            if (viewMode === 'all') {
                btnToggleAllPages.className = 'btn btn-sm btn-success rounded-2 px-2.5 py-1.5 d-inline-flex align-items-center gap-1';
                if (btnToggleAllText) btnToggleAllText.textContent = '1 Hal';
                btnToggleAllPages.title = 'Beralih ke tampilan per halaman';
            } else {
                btnToggleAllPages.className = 'btn btn-sm btn-outline-light rounded-2 px-2.5 py-1.5 d-inline-flex align-items-center gap-1';
                if (btnToggleAllText) btnToggleAllText.textContent = 'Semua';
                btnToggleAllPages.title = 'Tampilkan semua halaman berurutan';
            }
        }

        if (btnToggleAllPages) {
            btnToggleAllPages.addEventListener('click', (e) => {
                e.preventDefault();
                if (!currentPdfDoc) return;
                viewMode = (viewMode === 'all') ? 'single' : 'all';
                updateViewModeButton();
                renderCurrentView();
            });
        }

        // Fungsi pusat untuk merender tampilan aktif
        async function renderCurrentView() {
            if (!currentPdfDoc) return;
            updateNavButtonsState();

            if (viewMode === 'all') {
                await renderAllPagesVertically();
            } else {
                await renderSinglePage(currentPageIndex);
            }
        }

        // Render Halaman Tunggal yang Dipilih
        async function renderSinglePage(pageNum) {
            if (!currentPdfDoc) return;

            // Batalkan render yang sedang berlangsung agar tidak collision di PDF.js
            if (currentRenderTask) {
                try { currentRenderTask.cancel(); } catch (e) {}
                currentRenderTask = null;
            }

            canvasContainer.innerHTML = '';
            canvasContainer.scrollTop = 0;

            const containerWidth = canvasContainer.clientWidth || window.innerWidth;
            const padding = window.innerWidth < 768 ? 16 : 40;
            const availableWidth = Math.max(260, containerWidth - padding);

            try {
                const page = await currentPdfDoc.getPage(pageNum);
                const unscaledViewport = page.getViewport({ scale: 1.0 });

                const fitScale = availableWidth / unscaledViewport.width;
                const effectiveScale = fitScale * currentScale;
                const pixelRatio = Math.min(window.devicePixelRatio || 1, 2);
                const renderViewport = page.getViewport({ scale: effectiveScale * pixelRatio });

                const pageWrapper = document.createElement('div');
                pageWrapper.className = 'pdf-page-card position-relative bg-white rounded-2 my-auto';
                
                if (currentScale <= 1.0) {
                    pageWrapper.style.maxWidth = '100%';
                    pageWrapper.style.width = 'fit-content';
                } else {
                    pageWrapper.style.maxWidth = 'none';
                    pageWrapper.style.width = Math.floor(unscaledViewport.width * effectiveScale) + 'px';
                }

                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                canvas.width = Math.floor(renderViewport.width);
                canvas.height = Math.floor(renderViewport.height);

                const displayWidth = Math.floor(unscaledViewport.width * effectiveScale);
                const displayHeight = Math.floor(unscaledViewport.height * effectiveScale);

                if (currentScale <= 1.0) {
                    canvas.style.maxWidth = '100%';
                    canvas.style.height = 'auto';
                    canvas.style.width = '100%';
                } else {
                    canvas.style.maxWidth = 'none';
                    canvas.style.width = displayWidth + 'px';
                    canvas.style.height = displayHeight + 'px';
                }
                canvas.style.display = 'block';

                pageWrapper.appendChild(canvas);
                canvasContainer.appendChild(pageWrapper);

                currentRenderTask = page.render({
                    canvasContext: ctx,
                    viewport: renderViewport
                });
                await currentRenderTask.promise;
            } catch (err) {
                if (err && err.name === 'RenderingCancelledException') {
                    return;
                }
                console.warn('Render single page error:', err);
            } finally {
                currentRenderTask = null;
            }
        }

        // Render Semua Halaman Bertumpuk Vertikal
        async function renderAllPagesVertically() {
            if (!currentPdfDoc) return;

            if (currentRenderTask) {
                try { currentRenderTask.cancel(); } catch (e) {}
                currentRenderTask = null;
            }

            canvasContainer.innerHTML = '';
            canvasContainer.scrollTop = 0;

            const total = currentPdfDoc.numPages;
            const containerWidth = canvasContainer.clientWidth || window.innerWidth;
            const padding = window.innerWidth < 768 ? 16 : 40;
            const availableWidth = Math.max(260, containerWidth - padding);

            for (let i = 1; i <= total; i++) {
                try {
                    const page = await currentPdfDoc.getPage(i);
                    const unscaledViewport = page.getViewport({ scale: 1.0 });
                    const fitScale = availableWidth / unscaledViewport.width;
                    const effectiveScale = fitScale * currentScale;
                    const pixelRatio = Math.min(window.devicePixelRatio || 1, 2);
                    const renderViewport = page.getViewport({ scale: effectiveScale * pixelRatio });

                    const pageWrapper = document.createElement('div');
                    pageWrapper.className = 'pdf-page-card position-relative bg-white rounded-2 mb-3';
                    
                    const label = document.createElement('div');
                    label.className = 'bg-secondary bg-opacity-75 text-white small px-2 py-0.5 rounded-top text-center font-monospace';
                    label.textContent = total === 2 ? (i === 1 ? 'Sisi 1 (Luar)' : 'Sisi 2 (Dalam)') : `Halaman ${i}`;
                    pageWrapper.appendChild(label);

                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = Math.floor(renderViewport.width);
                    canvas.height = Math.floor(renderViewport.height);

                    const displayWidth = Math.floor(unscaledViewport.width * effectiveScale);
                    const displayHeight = Math.floor(unscaledViewport.height * effectiveScale);

                    if (currentScale <= 1.0) {
                        canvas.style.maxWidth = '100%';
                        canvas.style.height = 'auto';
                        canvas.style.width = '100%';
                    } else {
                        canvas.style.maxWidth = 'none';
                        canvas.style.width = displayWidth + 'px';
                        canvas.style.height = displayHeight + 'px';
                    }
                    canvas.style.display = 'block';

                    pageWrapper.appendChild(canvas);
                    canvasContainer.appendChild(pageWrapper);

                    currentRenderTask = page.render({
                        canvasContext: ctx,
                        viewport: renderViewport
                    });
                    await currentRenderTask.promise;
                } catch (err) {
                    if (err && err.name === 'RenderingCancelledException') {
                        return;
                    }
                    console.warn('Render page in vertical stack error:', err);
                }
            }
            currentRenderTask = null;
        }

        function updateZoomBadge() {
            if (zoomPercent) {
                zoomPercent.textContent = Math.round(currentScale * 100) + '%';
            }
        }

        // Navigasi Tombol Sebelumnya / Selanjutnya
        if (btnPrevPage) {
            btnPrevPage.addEventListener('click', (e) => {
                e.preventDefault();
                if (viewMode === 'all') {
                    viewMode = 'single';
                    updateViewModeButton();
                }
                if (currentPageIndex > 1) {
                    currentPageIndex--;
                    renderCurrentView();
                }
            });
        }

        if (btnNextPage) {
            btnNextPage.addEventListener('click', (e) => {
                e.preventDefault();
                if (viewMode === 'all') {
                    viewMode = 'single';
                    updateViewModeButton();
                }
                if (currentPdfDoc && currentPageIndex < currentPdfDoc.numPages) {
                    currentPageIndex++;
                    renderCurrentView();
                }
            });
        }

        // Kontrol Zoom
        if (btnZoomIn) {
            btnZoomIn.addEventListener('click', async function() {
                if (!currentPdfDoc || currentScale >= 3.0) return;
                currentScale = +(currentScale * 1.25).toFixed(2);
                updateZoomBadge();
                await renderCurrentView();
            });
        }

        if (btnZoomOut) {
            btnZoomOut.addEventListener('click', async function() {
                if (!currentPdfDoc || currentScale <= 0.4) return;
                currentScale = +(currentScale / 1.25).toFixed(2);
                updateZoomBadge();
                await renderCurrentView();
            });
        }

        if (btnFitWidth) {
            btnFitWidth.addEventListener('click', async function() {
                if (!currentPdfDoc) return;
                currentScale = 1.0;
                updateZoomBadge();
                await renderCurrentView();
            });
        }

        // Dukungan Usap Jari (Touch Swipe) di Layar HP
        let touchStartX = 0;
        let touchStartY = 0;
        let touchEndX = 0;
        let touchEndY = 0;

        canvasContainer.addEventListener('touchstart', e => {
            if (e.changedTouches.length > 0) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }
        }, { passive: true });

        canvasContainer.addEventListener('touchend', e => {
            if (viewMode === 'all' || currentScale > 1.05) return;
            if (e.changedTouches.length > 0) {
                touchEndX = e.changedTouches[0].screenX;
                touchEndY = e.changedTouches[0].screenY;
                const diffX = touchEndX - touchStartX;
                const diffY = touchEndY - touchStartY;

                // Hanya ganti halaman jika swipe horizontal signifikan dan dominan dibanding vertikal
                if (Math.abs(diffX) > 65 && Math.abs(diffX) > Math.abs(diffY) * 1.5) {
                    if (diffX > 0 && currentPageIndex > 1) {
                        currentPageIndex--;
                        renderCurrentView();
                    } else if (diffX < 0 && currentPdfDoc && currentPageIndex < currentPdfDoc.numPages) {
                        currentPageIndex++;
                        renderCurrentView();
                    }
                }
            }
        }, { passive: true });

        // Bersihkan objek saat modal ditutup
        modalEl.addEventListener('hidden.bs.modal', function() {
            if (currentRenderTask) {
                try { currentRenderTask.cancel(); } catch (e) {}
                currentRenderTask = null;
            }
            canvasContainer.innerHTML = '';
            currentPdfDoc = null;
        });

        // Filter Pencarian di Sisi Klien
        const liveSearchInput = document.getElementById('liveSearchInput');
        const visibleCounter = document.getElementById('visibleCounter');
        const noSearchResults = document.getElementById('noSearchResults');
        const items = document.querySelectorAll('.leaflet-item');

        if (liveSearchInput) {
            liveSearchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                let matchCount = 0;

                items.forEach(el => {
                    const title = el.dataset.title || '';
                    const cat = el.dataset.category || '';
                    const matches = title.includes(query) || cat.includes(query);

                    if (matches) {
                        el.classList.remove('d-none');
                        matchCount++;
                    } else {
                        el.classList.add('d-none');
                    }
                });

                if (visibleCounter) visibleCounter.textContent = matchCount;

                if (matchCount === 0 && items.length > 0) {
                    if (noSearchResults) noSearchResults.classList.remove('d-none');
                } else {
                    if (noSearchResults) noSearchResults.classList.add('d-none');
                }
            });

            window.resetLiveSearch = function() {
                liveSearchInput.value = '';
                liveSearchInput.dispatchEvent(new Event('input'));
            };
        }
    });
</script>
@endpush
