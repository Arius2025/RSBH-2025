@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="hero-section position-relative d-flex align-items-center justify-content-center overflow-hidden" 
    style="min-height: 38vh; background: linear-gradient(135deg, rgba(20, 108, 67, 0.95), rgba(25, 135, 84, 0.88)), url('{{ asset('images/hero-rs.jpg') }}') center/cover no-repeat;">
    <div class="container text-center text-white position-relative z-2 py-4">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm text-uppercase" style="letter-spacing: 1px; font-size: 0.78rem;">
            <i class="bi bi-file-earmark-medical me-1"></i> EDUKASI & PROMKES RS
        </span>
        <h1 class="fw-bold display-5 mb-2">Leaflet Informasi Kesehatan</h1>
        <p class="lead opacity-90 mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
            Materi edukasi kesehatan, tips pencegahan penyakit, dan informasi medis terpercaya dari tenaga kesehatan RS Baladhika Husada.
        </p>
    </div>
</section>

{{-- 2. MAIN CONTENT --}}
<div class="container py-4 py-md-5" style="margin-top: -45px; position: relative; z-index: 3;">
    
    {{-- Search & Filter Controls --}}
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 mb-4 bg-white">
        <div class="row g-3 align-items-center justify-content-between">
            {{-- Instant Search Bar --}}
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-success rounded-start-pill ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="liveSearchInput" class="form-control bg-light border-start-0 rounded-end-pill py-2" placeholder="Cari topik atau judul leaflet..." value="{{ request('q') }}">
                </div>
            </div>

            {{-- Stat counter --}}
            <div class="col-12 col-md-auto text-md-end text-muted small">
                Total <span class="fw-bold text-success fs-6" id="visibleCounter">{{ $leaflets->total() }}</span> materi leaflet tersedia
            </div>
        </div>

        {{-- Category Filter Pills --}}
        <div class="d-flex align-items-center gap-2 overflow-auto pt-3 mt-2 border-top no-scrollbar" style="white-space: nowrap;">
            <a href="{{ route('leaflet.index', ['q' => request('q')]) }}" 
               class="btn btn-sm rounded-pill px-3 py-1.5 category-chip {{ !request('kategori') || request('kategori') === 'Semua' ? 'btn-success fw-semibold shadow-sm' : 'btn-light text-secondary border' }}">
                Semua <span class="badge {{ !request('kategori') || request('kategori') === 'Semua' ? 'bg-white text-success' : 'bg-secondary bg-opacity-25 text-dark' }} ms-1">{{ $totalCount }}</span>
            </a>
            @foreach($categories as $catName => $catCount)
                <a href="{{ route('leaflet.index', ['kategori' => $catName, 'q' => request('q')]) }}" 
                   class="btn btn-sm rounded-pill px-3 py-1.5 category-chip {{ request('kategori') === $catName ? 'btn-success fw-semibold shadow-sm' : 'btn-light text-secondary border' }}">
                    {{ $catName }} <span class="badge {{ request('kategori') === $catName ? 'bg-white text-success' : 'bg-secondary bg-opacity-25 text-dark' }} ms-1">{{ $catCount }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Leaflet Cards Grid --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="leafletGrid">
        @forelse($leaflets as $leaf)
            <div class="col leaflet-item" data-title="{{ strtolower($leaf->title) }}" data-category="{{ strtolower($leaf->category) }}">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden leaflet-card bg-white position-relative d-flex flex-column" style="cursor: pointer;">
                    
                    {{-- Cover Aspect Ratio Container (Portrait 3:4) --}}
                    <div class="position-relative leaflet-cover-wrap overflow-hidden" style="padding-top: 133.33%; background: #f1f5f9;">
                        @if($leaf->thumbnail_path)
                            <img src="{{ $leaf->thumbnail_url }}" alt="{{ $leaf->title }}" class="position-absolute top-0 start-0 w-100 h-100 leaflet-cover-img" loading="lazy">
                        @else
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted p-3 text-center">
                                <i class="bi bi-file-earmark-medical fs-1 text-success opacity-50 mb-2"></i>
                                <span class="small fw-semibold text-truncate w-100">{{ $leaf->title }}</span>
                            </div>
                        @endif

                        {{-- Category Badge on Top-Left of Cover --}}
                        <div class="position-absolute top-0 start-0 m-3 z-2">
                            <span class="badge bg-dark bg-opacity-75 backdrop-blur text-white rounded-pill px-2.5 py-1 small fw-medium">
                                {{ $leaf->category }}
                            </span>
                        </div>

                        {{-- Hover Overlay for Desktop --}}
                        <div class="leaflet-overlay position-absolute top-0 start-0 w-100 h-100 d-none d-md-flex flex-column align-items-center justify-content-center p-3 text-center">
                            <div class="btn btn-success rounded-pill px-4 py-2 shadow-lg fw-semibold d-inline-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-book-half fs-5"></i> Baca Leaflet
                            </div>
                            <span class="text-white-50 small">Klik untuk membuka</span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-3 d-flex flex-column flex-grow-1">
                        <h6 class="card-title fw-bold text-dark mb-2 text-truncate-2" title="{{ $leaf->title }}" style="font-size: 0.95rem; line-height: 1.4;">
                            {{ $leaf->title }}
                        </h6>

                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between text-muted small mb-3">
                            <span>
                                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> {{ $leaf->file_size ?? 'PDF' }}
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-eye text-primary"></i> <span id="views_{{ $leaf->id }}">{{ number_format($leaf->views_count) }}</span>
                            </span>
                        </div>

                        {{-- Direct Read Button --}}
                        <button type="button" 
                                class="btn btn-sm btn-success w-100 rounded-pill fw-semibold d-flex align-items-center justify-content-center gap-2 btn-open-reader"
                                data-id="{{ $leaf->id }}"
                                data-title="{{ $leaf->title }}"
                                data-category="{{ $leaf->category }}"
                                data-stream="{{ route('leaflet.stream', $leaf->id) }}"
                                data-download="{{ route('leaflet.download', $leaf->id) }}">
                            <i class="bi bi-book-half"></i> Baca Dokumen
                        </button>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 w-100 text-center py-5 my-4" id="emptyStateBox">
                <div class="p-5 bg-white rounded-4 shadow-sm mx-auto" style="max-width: 480px;">
                    <i class="bi bi-journal-x fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark mb-2">Belum Ada Leaflet Tersedia</h5>
                    <p class="text-muted small mb-3">Materi leaflet untuk kategori atau pencarian ini belum ditemukan.</p>
                    <a href="{{ route('leaflet.index') }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
                        Lihat Semua Leaflet
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Dynamic Search No Results State (Hidden by default) --}}
    <div class="text-center py-5 my-4 d-none" id="noSearchResults">
        <div class="p-5 bg-white rounded-4 shadow-sm mx-auto" style="max-width: 480px;">
            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-bold text-dark mb-2">Tidak Ada Hasil Ditemukan</h5>
            <p class="text-muted small mb-3">Tidak ada leaflet yang cocok dengan kata kunci pencarian Anda.</p>
            <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-4" onclick="resetLiveSearch()">
                Bersihkan Pencarian
            </button>
        </div>
    </div>

    {{-- Pagination --}}
    @if($leaflets->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $leaflets->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

{{-- 3. FULLSCREEN MODAL PDF READER --}}
<div class="modal fade" id="pdfReaderModal" tabindex="-1" aria-labelledby="pdfReaderTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark text-white border-0 d-flex flex-column" style="height: 100vh;">
            
            {{-- Reader Header --}}
            <div class="modal-header border-bottom border-secondary bg-black bg-opacity-80 py-2.5 px-3 px-md-4 flex-shrink-0">
                <div class="d-flex align-items-center gap-2 overflow-hidden me-auto" style="max-width: 50%;">
                    <div class="bg-success text-white p-2 rounded-3 d-none d-sm-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-medical fs-5"></i>
                    </div>
                    <div class="text-truncate">
                        <h6 class="modal-title fw-bold text-white mb-0 text-truncate" id="pdfReaderTitle">Judul Leaflet</h6>
                        <div class="d-flex align-items-center gap-2 mt-0.5">
                            <span class="badge bg-secondary rounded-pill px-2 py-0.5 small" id="pdfReaderCategory" style="font-size: 0.72rem;">Kategori</span>
                            <span class="badge bg-dark border border-secondary text-white-50 rounded-pill px-2 py-0.5 small d-none" id="pdfPageCountBadge" style="font-size: 0.72rem;">0 Halaman</span>
                        </div>
                    </div>
                </div>

                {{-- Center / Toolbar: Zoom Controls --}}
                <div class="d-none d-md-flex align-items-center gap-1 mx-2" id="pdfZoomToolbar">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-1" id="btnZoomOut" title="Perkecil">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                    <span class="text-white-50 small px-2 font-monospace" id="zoomPercent" style="min-width: 50px; text-align: center;">100%</span>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-1" id="btnZoomIn" title="Perbesar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-1" id="btnFitWidth" title="Sesuaikan Lebar Layar">
                        <i class="bi bi-arrows-expand"></i>
                    </button>
                </div>

                {{-- Right Actions: Open in Tab, Download, Close --}}
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <a href="#" id="openTabBtn" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3 d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-box-arrow-up-right"></i> <span class="d-none d-sm-inline">Tab Baru</span>
                    </a>
                    <a href="#" id="downloadPdfBtn" download class="btn btn-sm btn-success rounded-pill px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-download"></i> <span class="d-none d-md-inline">Unduh PDF</span>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Tutup" style="width: 36px; height: 36px;">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            {{-- Reader Body: High-Performance Universal PDF Viewer --}}
            <div class="modal-body p-0 position-relative flex-grow-1 d-flex flex-column overflow-hidden" style="background: #0f172a;">
                
                {{-- Loading Spinner --}}
                <div id="pdfLoadingIndicator" class="position-absolute top-50 start-50 translate-middle text-center" style="z-index: 20;">
                    <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Memuat Dokumen...</span>
                    </div>
                    <div class="mt-3 text-white-50 small fw-medium" id="pdfLoadingText">Menyiapkan dokumen leaflet...</div>
                </div>

                {{-- Fallback Error Box (Hidden by default) --}}
                <div id="pdfErrorState" class="position-absolute top-50 start-50 translate-middle text-center p-4 rounded-4 bg-dark border border-secondary shadow-lg d-none" style="z-index: 15; max-width: 440px; width: 90%;">
                    <i class="bi bi-file-earmark-pdf fs-1 text-warning mb-3 d-block"></i>
                    <h6 class="fw-bold text-white mb-2">Penampil Dokumen</h6>
                    <p class="text-white-50 small mb-4">Dokumen dapat dibuka secara langsung atau diunduh untuk kenyamanan membaca di perangkat Anda.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" id="fallbackOpenTabBtn" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Tab Baru
                        </a>
                        <a href="#" id="fallbackDownloadBtn" download class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="bi bi-download me-1"></i> Unduh PDF
                        </a>
                    </div>
                </div>

                {{-- Scrollable Canvas Container for PDF.js --}}
                <div id="pdfCanvasContainer" class="w-100 h-100 overflow-auto p-2 p-md-4 d-flex flex-column align-items-center" style="scroll-behavior: smooth;">
                    {{-- Dynamic PDF canvas cards --}}
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    /* Leaflet Card Styling */
    .leaflet-card {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .leaflet-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 32px rgba(25, 135, 84, 0.15) !important;
    }
    .leaflet-cover-img {
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .leaflet-card:hover .leaflet-cover-img {
        transform: scale(1.04);
    }
    .leaflet-overlay {
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(3px);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 5;
    }
    .leaflet-card:hover .leaflet-overlay {
        opacity: 1;
    }
    .backdrop-blur {
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .category-chip {
        transition: all 0.2s ease;
    }
    .category-chip:hover {
        transform: translateY(-2px);
    }
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    /* Clean Antislop Pagination */
    .pagination {
        gap: 6px;
        margin-bottom: 0;
    }
    .pagination .page-item .page-link {
        color: #198754;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.875rem;
        background: #ffffff;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        transition: all 0.2s ease;
    }
    .pagination .page-item .page-link:hover {
        background: #e8f5e9;
        color: #115c39;
        border-color: #198754;
    }
    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.25);
    }
    .pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }
    .pagination svg {
        width: 1rem !important;
        height: 1rem !important;
    }
    .pdf-page-card {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
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

        // Open Reader Buttons
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

        // Click anywhere on Card
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

            // Reset modal state
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

            // Increment views count asynchronously
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

            // Render PDF with PDF.js
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

                // Determine scale to fit container width nicely
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
                pageWrapper.className = 'pdf-page-card position-relative mb-4 rounded-3 overflow-hidden bg-white';
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
                pageNumTag.className = 'badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-2 rounded-pill px-2.5 py-1 small font-monospace';
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
                loadingText.textContent = 'Memperbesar...';
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
                loadingText.textContent = 'Memperkecil...';
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

        // Clean up when modal closed
        modalEl.addEventListener('hidden.bs.modal', function() {
            canvasContainer.innerHTML = '';
            currentPdfDoc = null;
        });

        // Client-side Instant Filter Search
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
