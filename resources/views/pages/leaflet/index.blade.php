@extends('layouts.app')

@section('content')

{{-- Header Halaman Informasi Leaflet --}}
<section class="bg-light border-bottom py-4 py-md-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('informasi') }}" class="text-decoration-none text-muted">Informasi</a></li>
                <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">Leaflet Kesehatan</li>
            </ol>
        </nav>
        
        <div class="row align-items-md-center justify-content-between gy-3">
            <div class="col-lg-8">
                <h1 class="h2 fw-bold text-dark mb-2">Leaflet Informasi Kesehatan</h1>
                <p class="text-secondary mb-0" style="max-width: 720px; font-size: 1rem; line-height: 1.6;">
                    Materi edukasi dan promosi kesehatan resmi dari RS Baladhika Husada (DKT Jember). Anda dapat membaca dokumen secara langsung atau mengunduh berkas PDF untuk panduan kesehatan keluarga.
                </p>
            </div>
            <div class="col-lg-auto">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-2 bg-white border rounded-3 shadow-xs text-muted small">
                    <i class="bi bi-journal-medical text-success fs-5"></i>
                    <span>Tersedia <strong>{{ $totalCount }}</strong> materi publikasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Konten Utama dan Filter Dokumen --}}
<div class="container py-4 py-md-5">
    
    {{-- Bilah Pencarian dan Kategori --}}
    <div class="bg-white border rounded-3 p-3 p-md-4 mb-4 shadow-xs">
        <div class="row g-3 align-items-center justify-content-between">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="liveSearchInput" class="form-control border-start-0 py-2 ps-0" placeholder="Ketik topik atau judul leaflet..." value="{{ request('q') }}" aria-label="Cari judul leaflet">
                </div>
            </div>

            <div class="col-12 col-md-auto text-md-end text-muted small">
                Menampilkan <span class="fw-semibold text-dark" id="visibleCounter">{{ $leaflets->total() }}</span> dari {{ $totalCount }} leaflet
            </div>
        </div>

        {{-- Navigasi Filter Kategori --}}
        <div class="d-flex align-items-center gap-2 overflow-auto pt-3 mt-3 border-top category-scroll-container" style="white-space: nowrap;">
            <a href="{{ route('leaflet.index', ['q' => request('q')]) }}" 
               class="btn btn-sm rounded-2 px-3 py-1.5 {{ !request('kategori') || request('kategori') === 'Semua' ? 'btn-success fw-medium' : 'btn-outline-secondary' }}">
                Semua Kategori <span class="badge {{ !request('kategori') || request('kategori') === 'Semua' ? 'bg-white text-success' : 'bg-light text-dark border' }} ms-1">{{ $totalCount }}</span>
            </a>
            @foreach($categories as $catName => $catCount)
                <a href="{{ route('leaflet.index', ['kategori' => $catName, 'q' => request('q')]) }}" 
                   class="btn btn-sm rounded-2 px-3 py-1.5 {{ request('kategori') === $catName ? 'btn-success fw-medium' : 'btn-outline-secondary' }}">
                    {{ $catName }} <span class="badge {{ request('kategori') === $catName ? 'bg-white text-success' : 'bg-light text-dark border' }} ms-1">{{ $catCount }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Grid Kartu Leaflet --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="leafletGrid">
        @forelse($leaflets as $leaf)
            <div class="col leaflet-item" data-title="{{ strtolower($leaf->title) }}" data-category="{{ strtolower($leaf->category) }}">
                <div class="card h-100 border rounded-3 overflow-hidden leaflet-card bg-white position-relative d-flex flex-column">
                    
                    {{-- Wadah Sampul Dokumen Proporsi Standar 3:4 --}}
                    <div class="position-relative leaflet-cover-container" style="padding-top: 133.33%; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        @if($leaf->thumbnail_path)
                            <img src="{{ $leaf->thumbnail_url }}" alt="{{ $leaf->title }}" class="position-absolute top-0 start-0 w-100 h-100 leaflet-cover-image" loading="lazy">
                        @else
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted p-3 text-center">
                                <i class="bi bi-file-earmark-medical fs-1 text-success opacity-50 mb-2"></i>
                                <span class="small fw-semibold text-truncate w-100">{{ $leaf->title }}</span>
                            </div>
                        @endif

                        {{-- Label Kategori Dokumen --}}
                        <div class="position-absolute top-0 start-0 m-2.5 z-2">
                            <span class="badge bg-white text-dark border shadow-xs rounded-2 px-2.5 py-1 small fw-semibold">
                                {{ $leaf->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Informasi & Tombol Baca --}}
                    <div class="card-body p-3 d-flex flex-column flex-grow-1">
                        <h2 class="card-title h6 fw-semibold text-dark mb-2 text-truncate-2" title="{{ $leaf->title }}" style="font-size: 0.95rem; line-height: 1.45;">
                            {{ $leaf->title }}
                        </h2>

                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between text-muted small mb-3">
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> {{ $leaf->file_size ?? 'PDF' }}
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-eye text-secondary"></i> <span id="views_{{ $leaf->id }}">{{ number_format($leaf->views_count) }}</span> dibaca
                            </span>
                        </div>

                        {{-- Tombol Buka Reader --}}
                        <button type="button" 
                                class="btn btn-outline-success w-100 rounded-2 fw-semibold d-flex align-items-center justify-content-center gap-2 py-2 btn-open-reader"
                                data-id="{{ $leaf->id }}"
                                data-title="{{ $leaf->title }}"
                                data-category="{{ $leaf->category }}"
                                data-stream="{{ route('leaflet.stream', $leaf->id) }}"
                                data-download="{{ route('leaflet.download', $leaf->id) }}">
                            <i class="bi bi-book"></i> <span>Baca Dokumen</span>
                        </button>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 w-100 text-center py-5 my-4" id="emptyStateBox">
                <div class="p-5 bg-white border rounded-3 shadow-xs mx-auto" style="max-width: 480px;">
                    <i class="bi bi-journal-x fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark mb-2">Belum Ada Leaflet Tersedia</h5>
                    <p class="text-muted small mb-3">Materi leaflet untuk kategori atau kata kunci pencarian ini belum ditemukan.</p>
                    <a href="{{ route('leaflet.index') }}" class="btn btn-outline-success btn-sm rounded-2 px-3 py-1.5">
                        Lihat Semua Leaflet
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pesan Hasil Pencarian Kosong --}}
    <div class="text-center py-5 my-4 d-none" id="noSearchResults">
        <div class="p-5 bg-white border rounded-3 shadow-xs mx-auto" style="max-width: 480px;">
            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-bold text-dark mb-2">Tidak Ada Hasil Ditemukan</h5>
            <p class="text-muted small mb-3">Tidak ada dokumen leaflet yang cocok dengan kata kunci pencarian Anda.</p>
            <button type="button" class="btn btn-outline-success btn-sm rounded-2 px-3 py-1.5" onclick="resetLiveSearch()">
                Bersihkan Pencarian
            </button>
        </div>
    </div>

    {{-- Navigasi Halaman (Pagination) --}}
    @if($leaflets->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $leaflets->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

{{-- Modal Pembaca PDF Interaktif --}}
<div class="modal fade" id="pdfReaderModal" tabindex="-1" aria-labelledby="pdfReaderTitle" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark text-white border-0 d-flex flex-column" style="height: 100vh;">
            
            {{-- Header Pembaca --}}
            <div class="modal-header border-bottom border-secondary bg-black py-2.5 px-3 px-md-4 flex-shrink-0">
                <div class="d-flex align-items-center gap-2 overflow-hidden me-auto" style="max-width: 45%;">
                    <div class="bg-success text-white p-2 rounded-2 d-none d-sm-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-medical fs-5"></i>
                    </div>
                    <div class="text-truncate">
                        <h2 class="modal-title h6 fw-bold text-white mb-0 text-truncate" id="pdfReaderTitle">Judul Leaflet</h2>
                        <div class="d-flex align-items-center gap-2 mt-0.5">
                            <span class="badge bg-secondary rounded-2 px-2 py-0.5 small" id="pdfReaderCategory" style="font-size: 0.72rem;">Kategori</span>
                            <span class="badge bg-dark border border-secondary text-white-50 rounded-2 px-2 py-0.5 small d-none" id="pdfPageCountBadge" style="font-size: 0.72rem;">0 Halaman</span>
                        </div>
                    </div>
                </div>

                {{-- Kontrol Zoom Dokumen --}}
                <div class="d-none d-md-flex align-items-center gap-1 mx-2" id="pdfZoomToolbar">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnZoomOut" title="Perkecil">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                    <span class="text-white-50 small px-2 font-monospace" id="zoomPercent" style="min-width: 48px; text-align: center;">100%</span>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnZoomIn" title="Perbesar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-2 px-2 py-1" id="btnFitWidth" title="Sesuaikan Lebar Layar">
                        <i class="bi bi-arrows-expand"></i>
                    </button>
                </div>

                {{-- Aksi Unduh, Tab Baru, dan Tombol Tutup --}}
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <a href="#" id="openTabBtn" target="_blank" class="btn btn-sm btn-outline-light rounded-2 px-2.5 py-1.5 d-inline-flex align-items-center gap-1" title="Buka berkas di tab baru">
                        <i class="bi bi-box-arrow-up-right"></i> <span class="d-none d-sm-inline">Tab Baru</span>
                    </a>
                    <a href="#" id="downloadPdfBtn" download class="btn btn-sm btn-success rounded-2 px-2.5 py-1.5 fw-medium d-inline-flex align-items-center gap-1" title="Unduh berkas PDF">
                        <i class="bi bi-download"></i> <span class="d-none d-md-inline">Unduh</span>
                    </a>
                    
                    {{-- Tombol Tutup Utama yang Jelas dan Kontras Tinggi --}}
                    <button type="button" 
                            class="btn btn-danger btn-sm rounded-2 px-3 py-1.5 fw-semibold d-inline-flex align-items-center gap-1.5 shadow-sm" 
                            data-bs-dismiss="modal" 
                            aria-label="Tutup penampil dokumen">
                        <i class="bi bi-x-lg"></i> <span>Tutup</span>
                    </button>
                </div>
            </div>

            {{-- Area Pembaca Dokumen --}}
            <div class="modal-body p-0 position-relative flex-grow-1 d-flex flex-column overflow-hidden" style="background: #0f172a;">
                
                {{-- Indikator Memuat Dokumen --}}
                <div id="pdfLoadingIndicator" class="position-absolute top-50 start-50 translate-middle text-center" style="z-index: 20;">
                    <div class="spinner-border text-success" style="width: 2.75rem; height: 2.75rem;" role="status">
                        <span class="visually-hidden">Memuat dokumen...</span>
                    </div>
                    <div class="mt-3 text-white-50 small fw-medium" id="pdfLoadingText">Menyiapkan dokumen leaflet...</div>
                </div>

                {{-- Tampilan Saat Dokumen Gagal Dirender --}}
                <div id="pdfErrorState" class="position-absolute top-50 start-50 translate-middle text-center p-4 rounded-3 bg-dark border border-secondary shadow-lg d-none" style="z-index: 15; max-width: 440px; width: 90%;">
                    <i class="bi bi-file-earmark-pdf fs-1 text-warning mb-3 d-block"></i>
                    <h3 class="h6 fw-bold text-white mb-2">Penampil Dokumen</h3>
                    <p class="text-white-50 small mb-4">Dokumen dapat dibuka secara langsung di tab browser atau diunduh ke perangkat Anda.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" id="fallbackOpenTabBtn" target="_blank" class="btn btn-outline-light btn-sm rounded-2 px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Tab Baru
                        </a>
                        <a href="#" id="fallbackDownloadBtn" download class="btn btn-success btn-sm rounded-2 px-3">
                            <i class="bi bi-download me-1"></i> Unduh PDF
                        </a>
                    </div>
                </div>

                {{-- Wadah Gulir Halaman PDF --}}
                <div id="pdfCanvasContainer" class="w-100 h-100 overflow-auto p-2 p-md-4 d-flex flex-column align-items-center" style="scroll-behavior: smooth;">
                    {{-- Halaman kanvas dirender secara dinamis oleh PDF.js --}}
                </div>

                {{-- Tombol Tutup Melayang di Bawah Layar untuk Kenyamanan Membaca di HP & Desktop --}}
                <button type="button" 
                        class="btn btn-dark border border-secondary shadow-lg rounded-pill px-4 py-2 text-white fw-semibold position-fixed bottom-0 start-50 translate-middle-x mb-4 z-3 d-flex align-items-center gap-2"
                        data-bs-dismiss="modal" 
                        aria-label="Tutup dokumen">
                    <i class="bi bi-x-circle-fill text-danger fs-5"></i> <span>Tutup Dokumen</span>
                </button>

            </div>

        </div>
    </div>
</div>

<style>
    .category-scroll-container::-webkit-scrollbar {
        height: 4px;
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
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        border-color: #cbd5e1;
    }
    .leaflet-cover-image {
        object-fit: cover;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .pdf-page-card {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
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
        const pageCountBadge = document.getElementById('pdfPageCountBadge');
        const zoomPercent = document.getElementById('zoomPercent');
        const btnZoomIn = document.getElementById('btnZoomIn');
        const btnZoomOut = document.getElementById('btnZoomOut');
        const btnFitWidth = document.getElementById('btnFitWidth');

        let currentPdfDoc = null;
        let currentScale = 1.0;
        let baseFitScale = 1.0;

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

            canvasContainer.innerHTML = '';
            errorState.classList.add('d-none');
            loadingIndicator.classList.remove('d-none');
            loadingText.textContent = 'Menyiapkan dokumen leaflet...';
            pageCountBadge.classList.add('d-none');

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

                pageCountBadge.textContent = `${currentPdfDoc.numPages} Halaman`;
                pageCountBadge.classList.remove('d-none');

                const firstPage = await currentPdfDoc.getPage(1);
                const unscaledViewport = firstPage.getViewport({ scale: 1.0 });
                const availableWidth = Math.max(280, (canvasContainer.clientWidth || window.innerWidth) - 48);
                
                baseFitScale = Math.min(availableWidth / unscaledViewport.width, 1.4);
                currentScale = baseFitScale;
                updateZoomBadge();

                await renderAllPages();
                loadingIndicator.classList.add('d-none');
            } catch (err) {
                console.warn('PDF.js rendering error:', err);
                loadingIndicator.classList.add('d-none');
                errorState.classList.remove('d-none');
            }
        }

        async function renderAllPages() {
            if (!currentPdfDoc) return;
            canvasContainer.innerHTML = '';
            const numPages = currentPdfDoc.numPages;

            for (let i = 1; i <= numPages; i++) {
                const page = await currentPdfDoc.getPage(i);
                const viewport = page.getViewport({ scale: currentScale });
                const outputScale = window.devicePixelRatio || 1;

                const pageWrapper = document.createElement('div');
                pageWrapper.className = 'pdf-page-card position-relative mb-4 rounded-2 overflow-hidden bg-white';
                pageWrapper.style.maxWidth = '100%';

                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                canvas.width = Math.floor(viewport.width * outputScale);
                canvas.height = Math.floor(viewport.height * outputScale);
                canvas.style.width = Math.floor(viewport.width) + 'px';
                canvas.style.height = Math.floor(viewport.height) + 'px';
                canvas.style.display = 'block';

                const transform = outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] : null;

                const pageNumTag = document.createElement('span');
                pageNumTag.className = 'badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-2 rounded-2 px-2.5 py-1 small font-monospace';
                pageNumTag.style.fontSize = '0.72rem';
                pageNumTag.textContent = `${i} / ${numPages}`;

                pageWrapper.appendChild(canvas);
                pageWrapper.appendChild(pageNumTag);
                canvasContainer.appendChild(pageWrapper);

                await page.render({
                    canvasContext: ctx,
                    transform: transform,
                    viewport: viewport
                }).promise;
            }
        }

        function updateZoomBadge() {
            if (zoomPercent) {
                zoomPercent.textContent = Math.round((currentScale / baseFitScale) * 100) + '%';
            }
        }

        if (btnZoomIn) {
            btnZoomIn.addEventListener('click', async function() {
                if (!currentPdfDoc || currentScale >= 3.0) return;
                currentScale = +(currentScale * 1.25).toFixed(2);
                updateZoomBadge();
                loadingIndicator.classList.remove('d-none');
                loadingText.textContent = 'Memperbesar tampilan...';
                await renderAllPages();
                loadingIndicator.classList.add('d-none');
            });
        }

        if (btnZoomOut) {
            btnZoomOut.addEventListener('click', async function() {
                if (!currentPdfDoc || currentScale <= 0.4) return;
                currentScale = +(currentScale / 1.25).toFixed(2);
                updateZoomBadge();
                loadingIndicator.classList.remove('d-none');
                loadingText.textContent = 'Memperkecil tampilan...';
                await renderAllPages();
                loadingIndicator.classList.add('d-none');
            });
        }

        if (btnFitWidth) {
            btnFitWidth.addEventListener('click', async function() {
                if (!currentPdfDoc) return;
                const firstPage = await currentPdfDoc.getPage(1);
                const unscaled = firstPage.getViewport({ scale: 1.0 });
                const availableWidth = Math.max(280, (canvasContainer.clientWidth || window.innerWidth) - 48);
                baseFitScale = Math.min(availableWidth / unscaled.width, 1.4);
                currentScale = baseFitScale;
                updateZoomBadge();
                loadingIndicator.classList.remove('d-none');
                loadingText.textContent = 'Menyesuaikan layar...';
                await renderAllPages();
                loadingIndicator.classList.add('d-none');
            });
        }

        // Bersihkan objek saat modal ditutup
        modalEl.addEventListener('hidden.bs.modal', function() {
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
