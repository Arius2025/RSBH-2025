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
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden leaflet-card bg-white position-relative d-flex flex-column">
                    
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

                        {{-- Hover Overlay with Action Button --}}
                        <div class="leaflet-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-center">
                            <button type="button" 
                                    class="btn btn-success rounded-pill px-4 py-2 shadow-lg fw-semibold d-inline-flex align-items-center gap-2 mb-2 btn-open-reader"
                                    data-id="{{ $leaf->id }}"
                                    data-title="{{ $leaf->title }}"
                                    data-category="{{ $leaf->category }}"
                                    data-pdf="{{ $leaf->pdf_url }}"
                                    data-size="{{ $leaf->file_size ?? 'PDF' }}">
                                <i class="bi bi-book-half fs-5"></i> Baca Leaflet
                            </button>
                            <span class="text-white-50 small">Klik untuk membuka</span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-3 d-flex flex-column flex-grow-1">
                        <h6 class="card-title fw-bold text-dark mb-2 text-truncate-2" title="{{ $leaf->title }}" style="font-size: 0.95rem; line-height: 1.4;">
                            {{ $leaf->title }}
                        </h6>

                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between text-muted small">
                            <span>
                                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> {{ $leaf->file_size ?? 'PDF' }}
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <i class="bi bi-eye text-primary"></i> <span id="views_{{ $leaf->id }}">{{ number_format($leaf->views_count) }}</span>
                            </span>
                        </div>
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
            {{ $leaflets->links() }}
        </div>
    @endif

</div>

{{-- 3. FULLSCREEN MODAL PDF READER --}}
<div class="modal fade" id="pdfReaderModal" tabindex="-1" aria-labelledby="pdfReaderTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark text-white border-0">
            
            {{-- Reader Header --}}
            <div class="modal-header border-bottom border-secondary bg-black bg-opacity-75 py-2 px-3 px-md-4">
                <div class="d-flex align-items-center gap-2 overflow-hidden me-2" style="max-width: 50%;">
                    <div class="bg-success text-white p-2 rounded-3 d-none d-sm-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-medical fs-5"></i>
                    </div>
                    <div class="text-truncate">
                        <h6 class="modal-title fw-bold text-white mb-0 text-truncate" id="pdfReaderTitle">Judul Leaflet</h6>
                        <span class="badge bg-secondary rounded-pill px-2 py-0.5 small" id="pdfReaderCategory" style="font-size: 0.7rem;">Kategori</span>
                    </div>
                </div>

                {{-- Toolbar: Page Nav & Zoom --}}
                <div class="d-flex align-items-center gap-1 gap-md-2 mx-auto">
                    <div class="btn-group btn-group-sm bg-secondary bg-opacity-25 rounded-pill p-1">
                        <button type="button" class="btn btn-sm btn-outline-light border-0 rounded-pill px-2" id="prevPageBtn" title="Halaman Sebelumnya">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <span class="px-2 py-1 small fw-semibold text-white d-flex align-items-center" id="pageIndicator">
                            Hal <span id="pageNum" class="mx-1">1</span> / <span id="pageTotal" class="ms-1">1</span>
                        </span>
                        <button type="button" class="btn btn-sm btn-outline-light border-0 rounded-pill px-2" id="nextPageBtn" title="Halaman Selanjutnya">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                    <div class="btn-group btn-group-sm bg-secondary bg-opacity-25 rounded-pill p-1 d-none d-md-inline-flex">
                        <button type="button" class="btn btn-sm btn-outline-light border-0 rounded-pill px-2" id="zoomOutBtn" title="Perkecil">
                            <i class="bi bi-zoom-out"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-light border-0 rounded-pill px-2" id="zoomResetBtn" title="Sesuaikan Lebar">
                            <span id="zoomPercent">100%</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-light border-0 rounded-pill px-2" id="zoomInBtn" title="Perbesar">
                            <i class="bi bi-zoom-in"></i>
                        </button>
                    </div>
                </div>

                {{-- Right Actions: Download & Close --}}
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="downloadPdfBtn" download class="btn btn-sm btn-success rounded-pill px-3 fw-medium d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-download"></i> <span class="d-none d-sm-inline">Unduh PDF</span>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-circle p-2 d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Tutup" style="width: 34px; height: 34px;">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            {{-- Reader Canvas Body --}}
            <div class="modal-body p-0 position-relative d-flex flex-column align-items-center justify-content-start overflow-auto" id="pdfScrollContainer" style="background: #0f172a; min-height: 80vh;">
                
                {{-- Loading Spinner --}}
                <div id="pdfLoadingIndicator" class="position-absolute top-50 start-50 translate-middle text-center">
                    <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Memuat PDF...</span>
                    </div>
                    <div class="mt-3 text-white-50 small fw-medium">Menyiapkan halaman dokumen leaflet...</div>
                </div>

                {{-- PDF Viewer Canvas --}}
                <div class="p-3 p-md-4 d-flex justify-content-center w-100">
                    <canvas id="pdfViewerCanvas" class="shadow-lg rounded-2 d-none" style="max-width: 100%; height: auto; background: #fff;"></canvas>
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
</style>

{{-- PDF.js for Client-Side Inline Modal Reader --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    // State
    let currentPdfDoc = null;
    let currentPageNum = 1;
    let totalPdfPages = 1;
    let currentScale = 1.35;
    let currentLeafletId = null;

    const modalEl = document.getElementById('pdfReaderModal');
    const pdfReaderModal = new bootstrap.Modal(modalEl);
    const canvas = document.getElementById('pdfViewerCanvas');
    const ctx = canvas.getContext('2d');
    const loadingIndicator = document.getElementById('pdfLoadingIndicator');
    const pageNumEl = document.getElementById('pageNum');
    const pageTotalEl = document.getElementById('pageTotal');
    const zoomPercentEl = document.getElementById('zoomPercent');
    const downloadBtn = document.getElementById('downloadPdfBtn');
    const pdfTitleEl = document.getElementById('pdfReaderTitle');
    const pdfCatEl = document.getElementById('pdfReaderCategory');
    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    const zoomInBtn = document.getElementById('zoomInBtn');
    const zoomOutBtn = document.getElementById('zoomOutBtn');
    const zoomResetBtn = document.getElementById('zoomResetBtn');

    // Click on Open Reader
    document.querySelectorAll('.btn-open-reader').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            const title = this.dataset.title;
            const cat = this.dataset.category;
            const pdfUrl = this.dataset.pdf;

            openPdfModal(id, title, cat, pdfUrl);
        });
    });

    // Also click on card to open
    document.querySelectorAll('.leaflet-card').forEach(card => {
        card.addEventListener('click', function() {
            const btn = this.querySelector('.btn-open-reader');
            if (btn) btn.click();
        });
    });

    async function openPdfModal(id, title, category, pdfUrl) {
        currentLeafletId = id;
        pdfTitleEl.textContent = title;
        pdfCatEl.textContent = category;
        downloadBtn.href = pdfUrl;
        downloadBtn.setAttribute('download', title.replace(/[^a-zA-Z0-9_\-]/g, '_') + '.pdf');

        // Reset display
        canvas.classList.add('d-none');
        loadingIndicator.classList.remove('d-none');
        currentPageNum = 1;
        currentScale = window.innerWidth < 768 ? 1.0 : 1.35;

        pdfReaderModal.show();

        // Increment view counter via AJAX
        try {
            fetch(`/api/leaflet/${id}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(r => r.json()).then(data => {
                if (data.success) {
                    const counterEl = document.getElementById(`views_${id}`);
                    if (counterEl) counterEl.textContent = data.views_count.toLocaleString();
                }
            }).catch(console.error);
        } catch (e) {
            console.error(e);
        }

        // Load PDF via PDF.js
        try {
            const loadingTask = pdfjsLib.getDocument(pdfUrl);
            currentPdfDoc = await loadingTask.promise;
            totalPdfPages = currentPdfDoc.numPages;
            pageTotalEl.textContent = totalPdfPages;

            renderCurrentPage();
        } catch (err) {
            console.error('Error loading PDF:', err);
            loadingIndicator.innerHTML = `
                <div class="text-danger mb-2"><i class="bi bi-exclamation-triangle-fill fs-2"></i></div>
                <div class="text-white fw-bold mb-2">Gagal membuka file PDF di peramban</div>
                <a href="${pdfUrl}" target="_blank" class="btn btn-sm btn-outline-light rounded-pill">
                    Buka Langsung di Tab Baru
                </a>
            `;
        }
    }

    async function renderCurrentPage() {
        if (!currentPdfDoc) return;

        pageNumEl.textContent = currentPageNum;
        prevBtn.disabled = (currentPageNum <= 1);
        nextBtn.disabled = (currentPageNum >= totalPdfPages);
        zoomPercentEl.textContent = Math.round(currentScale * 100 / 1.35) + '%';

        loadingIndicator.classList.remove('d-none');

        try {
            const page = await currentPdfDoc.getPage(currentPageNum);
            const viewport = page.getViewport({ scale: currentScale });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };

            await page.render(renderContext).promise;

            loadingIndicator.classList.add('d-none');
            canvas.classList.remove('d-none');
        } catch (err) {
            console.error('Page render error:', err);
        }
    }

    // Navigation Controls
    prevBtn.addEventListener('click', () => {
        if (currentPageNum > 1) {
            currentPageNum--;
            renderCurrentPage();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentPageNum < totalPdfPages) {
            currentPageNum++;
            renderCurrentPage();
        }
    });

    // Zoom Controls
    zoomInBtn.addEventListener('click', () => {
        if (currentScale < 3.0) {
            currentScale += 0.2;
            renderCurrentPage();
        }
    });

    zoomOutBtn.addEventListener('click', () => {
        if (currentScale > 0.6) {
            currentScale -= 0.2;
            renderCurrentPage();
        }
    });

    zoomResetBtn.addEventListener('click', () => {
        currentScale = window.innerWidth < 768 ? 1.0 : 1.35;
        renderCurrentPage();
    });

    // Keyboard navigation (Left/Right arrows)
    document.addEventListener('keydown', (e) => {
        if (!modalEl.classList.contains('show')) return;
        if (e.key === 'ArrowLeft') prevBtn.click();
        if (e.key === 'ArrowRight') nextBtn.click();
    });

    // Client-side Instant Filter Search
    const liveSearchInput = document.getElementById('liveSearchInput');
    const leafletGrid = document.getElementById('leafletGrid');
    const visibleCounter = document.getElementById('visibleCounter');
    const noSearchResults = document.getElementById('noSearchResults');
    const items = document.querySelectorAll('.leaflet-item');

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

        visibleCounter.textContent = matchCount;

        if (matchCount === 0 && items.length > 0) {
            noSearchResults.classList.remove('d-none');
        } else {
            noSearchResults.classList.add('d-none');
        }
    });

    window.resetLiveSearch = function() {
        liveSearchInput.value = '';
        liveSearchInput.dispatchEvent(new Event('input'));
    };
</script>
@endsection
