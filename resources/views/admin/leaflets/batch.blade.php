@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="fw-bold text-success mb-1">Bulk Upload Leaflet (Multi-PDF Otomatis)</h1>
            <p class="text-muted mb-0">Tarik & lepas puluhan file PDF sekaligus. Judul dibersihkan otomatis & cover lembar pertama diekstrak instan.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.leaflets.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Drag & Drop Area --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <div id="dropZone" class="border-2 border-dashed rounded-4 p-5 text-center bg-light transition-all" style="cursor: pointer; border-color: #198754 !important;">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 76px; height: 76px;">
                        <i class="bi bi-cloud-arrow-up-fill fs-1"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2">Tarik & Letakkan File PDF di Sini</h4>
                <p class="text-muted mb-3">Mendukung puluhan berkas PDF sekaligus. Cover lembar ke-1 diekstrak otomatis.</p>
                <button type="button" class="btn btn-success px-4 py-2 shadow-sm rounded-pill" onclick="document.getElementById('multiFileInput').click()">
                    <i class="bi bi-folder2-open me-2"></i> Pilih Berkas dari Komputer
                </button>
                <input type="file" id="multiFileInput" accept="application/pdf" multiple class="d-none">
            </div>
        </div>
    </div>

    {{-- Review & Batch Queue Section (Hidden until files selected) --}}
    <div id="queueSection" class="d-none">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 p-4 pb-0">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">
                            <i class="bi bi-card-checklist text-success me-2"></i>Review Antrean Dokumen (<span id="totalQueueCount">0</span> File)
                        </h4>
                        <p class="text-muted small mb-0">Periksa judul otomatis & tentukan kategori sebelum menyimpan.</p>
                    </div>

                    {{-- Mass Category Assign & Mass Actions --}}
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: auto;">
                            <label class="input-group-text bg-light text-muted small">Set Kategori Semua:</label>
                            <select id="globalCategorySelect" class="form-select form-select-sm bg-light">
                                <option value="" selected>Pilih Kategori...</option>
                                @foreach($categories as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-success btn-sm" id="applyGlobalCategoryBtn">
                                Terapkan
                            </button>
                        </div>
                        <button type="button" class="btn btn-outline-danger btn-sm" id="clearQueueBtn">
                            <i class="bi bi-trash me-1"></i> Bersihkan Semua
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                {{-- Overall Progress Bar --}}
                <div id="overallProgressWrapper" class="d-none mb-4 p-3 bg-light rounded-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold text-dark small" id="progressStatusText">Mengunggah antrean...</span>
                        <span class="fw-bold text-success small" id="progressPercentText">0%</span>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div id="overallProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%"></div>
                    </div>
                </div>

                {{-- Table of items --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="queueTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 70px;">Cover</th>
                                <th style="min-width: 280px;">Judul Dokumen (Dapat Diedit)</th>
                                <th style="width: 220px;">Kategori</th>
                                <th style="width: 100px;">Ukuran</th>
                                <th style="width: 130px;">Status</th>
                                <th style="width: 60px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="queueTableBody">
                            {{-- Dynamically populated --}}
                        </tbody>
                    </table>
                </div>

                {{-- Action Footer --}}
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mt-4 pt-3 border-top">
                    <div class="text-muted small">
                        Pastikan koneksi internet stabil saat proses simpan berlangsung.
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light px-4" id="cancelUploadBtn" onclick="location.reload()">Batal</button>
                        <button type="button" class="btn btn-success px-5 py-2 fw-semibold shadow" id="startBatchUploadBtn">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Simpan Semua Sekaligus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Success Modal --}}
<div class="modal fade" id="successBatchModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 text-center p-4">
            <div class="modal-body">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-check-lg fs-1"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">Unggah Bulk Berhasil!</h4>
                <p class="text-muted mb-4" id="successModalMessage">Semua leaflet PDF berhasil diproses dan disimpan ke database.</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.leaflets.index') }}" class="btn btn-success px-4 rounded-pill">
                        <i class="bi bi-list-ul me-1"></i> Lihat Daftar Leaflet
                    </a>
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" onclick="location.reload()">
                        Unggah File Lain
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PDF.js Library for Client-side Rendering --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    const categoriesList = @json($categories);
    const dropZone = document.getElementById('dropZone');
    const multiFileInput = document.getElementById('multiFileInput');
    const queueSection = document.getElementById('queueSection');
    const queueTableBody = document.getElementById('queueTableBody');
    const totalQueueCount = document.getElementById('totalQueueCount');
    const globalCategorySelect = document.getElementById('globalCategorySelect');
    const applyGlobalCategoryBtn = document.getElementById('applyGlobalCategoryBtn');
    const clearQueueBtn = document.getElementById('clearQueueBtn');
    const startBatchUploadBtn = document.getElementById('startBatchUploadBtn');
    const overallProgressWrapper = document.getElementById('overallProgressWrapper');
    const overallProgressBar = document.getElementById('overallProgressBar');
    const progressStatusText = document.getElementById('progressStatusText');
    const progressPercentText = document.getElementById('progressPercentText');

    let queueItems = []; // Array of { id, file, title, category, thumbnailDataUrl, sizeFormatted, status: 'ready'|'uploading'|'done'|'error', errorMsg }
    let isUploading = false;

    // Helper: Clean filename into nice Title
    function cleanFileName(filename) {
        let name = filename.replace(/\.pdf$/i, '');
        // Remove leading numbers, dates, prefixes like 01_, 01., 2026-
        name = name.replace(/^[\d\s_\.\-]+/, '');
        // Replace dashes and underscores with spaces
        name = name.replace(/[_\-]+/g, ' ');
        // Title case
        name = name.replace(/\b\w/g, l => l.toUpperCase()).trim();
        return name || 'Leaflet Kesehatan';
    }

    // Helper: Format bytes
    function formatBytes(bytes) {
        if (!bytes) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Drag & Drop event handlers
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.add('bg-success', 'bg-opacity-10');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('bg-success', 'bg-opacity-10');
        }, false);
    });

    dropZone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    multiFileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    // Process dropped/selected files
    async function handleFiles(files) {
        const pdfFiles = Array.from(files).filter(f => f.name.toLowerCase().endsWith('.pdf') || f.type === 'application/pdf');
        
        if (pdfFiles.length === 0) {
            alert('Silakan pilih berkas dokumen berformat PDF.');
            return;
        }

        queueSection.classList.remove('d-none');

        for (const file of pdfFiles) {
            const itemId = 'item_' + Date.now() + '_' + Math.random().toString(36).substr(2, 6);
            const title = cleanFileName(file.name);
            const sizeFormatted = formatBytes(file.size);

            const item = {
                id: itemId,
                file: file,
                title: title,
                category: 'Umum',
                thumbnailDataUrl: null,
                sizeFormatted: sizeFormatted,
                status: 'extracting', // extracting page 1
                errorMsg: null
            };

            queueItems.push(item);
            renderTableRow(item);
            updateTotalCount();

            // Extract page 1 thumbnail asynchronously
            extractPdfThumbnail(item);
        }
    }

    // Extract Page-1 Thumbnail using PDF.js
    async function extractPdfThumbnail(item) {
        try {
            const arrayBuffer = await item.file.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            const page = await pdf.getPage(1);
            
            const viewport = page.getViewport({ scale: 0.8 });
            const canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            const ctx = canvas.getContext('2d');
            
            await page.render({ canvasContext: ctx, viewport: viewport }).promise;
            
            item.thumbnailDataUrl = canvas.toDataURL('image/webp', 0.8);
            item.status = 'ready';
            
            updateTableRowUI(item);
        } catch (err) {
            console.warn('Gagal ekstrak thumbnail untuk ' + item.file.name, err);
            item.status = 'ready'; // Still ready to upload without thumbnail
            updateTableRowUI(item);
        }
    }

    // Render table row
    function renderTableRow(item) {
        const tr = document.createElement('tr');
        tr.id = 'row_' + item.id;
        tr.className = 'queue-row';

        let categoryOptions = '';
        for (const [key, val] of Object.entries(categoriesList)) {
            categoryOptions += `<option value="${key}" ${item.category === key ? 'selected' : ''}>${val}</option>`;
        }

        tr.innerHTML = `
            <td class="text-muted small row-number fw-medium"></td>
            <td>
                <div class="thumb-cell rounded border bg-light d-flex align-items-center justify-content-center overflow-hidden" style="width: 44px; height: 58px;">
                    <span class="spinner-border spinner-border-sm text-secondary" id="spinner_${item.id}"></span>
                    <img id="thumb_${item.id}" class="d-none w-100 h-100" style="object-fit: cover;">
                </div>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm title-input" id="title_${item.id}" value="${escapeHtml(item.title)}">
                <div class="small text-muted mt-1 text-truncate" style="max-width: 320px;">
                    <i class="bi bi-file-earmark-text me-1"></i>${escapeHtml(item.file.name)}
                </div>
            </td>
            <td>
                <select class="form-select form-select-sm category-select" id="cat_${item.id}">
                    ${categoryOptions}
                </select>
            </td>
            <td class="text-muted small">${item.sizeFormatted}</td>
            <td id="status_${item.id}">
                <span class="badge bg-warning bg-opacity-20 text-dark">
                    <i class="bi bi-hourglass-split me-1"></i> Baca Dokumen
                </span>
            </td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-outline-danger border-0 remove-btn" onclick="removeQueueItem('${item.id}')">
                    <i class="bi bi-x-lg"></i>
                </button>
            </td>
        `;

        queueTableBody.appendChild(tr);

        // Listen for input changes
        document.getElementById(`title_${item.id}`).addEventListener('input', (e) => {
            item.title = e.target.value;
        });

        document.getElementById(`cat_${item.id}`).addEventListener('change', (e) => {
            item.category = e.target.value;
        });

        reindexRows();
    }

    // Update row when thumbnail is ready or status changes
    function updateTableRowUI(item) {
        const spinner = document.getElementById(`spinner_${item.id}`);
        const thumbImg = document.getElementById(`thumb_${item.id}`);
        const statusEl = document.getElementById(`status_${item.id}`);

        if (spinner && thumbImg) {
            if (item.thumbnailDataUrl) {
                spinner.classList.add('d-none');
                thumbImg.src = item.thumbnailDataUrl;
                thumbImg.classList.remove('d-none');
            } else {
                spinner.classList.add('d-none');
                thumbImg.parentElement.innerHTML = '<i class="bi bi-file-earmark-pdf fs-4 text-danger"></i>';
            }
        }

        if (statusEl) {
            if (item.status === 'ready') {
                statusEl.innerHTML = '<span class="badge bg-secondary bg-opacity-10 text-secondary border"><i class="bi bi-check2 me-1"></i> Siap Upload</span>';
            } else if (item.status === 'uploading') {
                statusEl.innerHTML = '<span class="badge bg-primary bg-opacity-20 text-primary border border-primary"><span class="spinner-border spinner-border-sm me-1"></span> Mengunggah</span>';
            } else if (item.status === 'done') {
                statusEl.innerHTML = '<span class="badge bg-success bg-opacity-20 text-success border border-success"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>';
            } else if (item.status === 'error') {
                statusEl.innerHTML = `<span class="badge bg-danger bg-opacity-20 text-danger border border-danger" title="${escapeHtml(item.errorMsg || 'Gagal')}"><i class="bi bi-exclamation-triangle-fill me-1"></i> Gagal</span>`;
            }
        }
    }

    // Remove single item
    window.removeQueueItem = function(id) {
        if (isUploading) return;
        queueItems = queueItems.filter(item => item.id !== id);
        const row = document.getElementById('row_' + id);
        if (row) row.remove();
        updateTotalCount();
        reindexRows();
        if (queueItems.length === 0) {
            queueSection.classList.add('d-none');
        }
    };

    // Reindex rows #
    function reindexRows() {
        const rows = queueTableBody.querySelectorAll('.row-number');
        rows.forEach((td, idx) => {
            td.textContent = idx + 1;
        });
    }

    function updateTotalCount() {
        totalQueueCount.textContent = queueItems.length;
    }

    // Apply global category
    applyGlobalCategoryBtn.addEventListener('click', () => {
        const cat = globalCategorySelect.value;
        if (!cat) return;
        queueItems.forEach(item => {
            item.category = cat;
            const sel = document.getElementById(`cat_${item.id}`);
            if (sel) sel.value = cat;
        });
    });

    // Clear all
    clearQueueBtn.addEventListener('click', () => {
        if (isUploading) return;
        if (confirm('Hapus semua antrean upload?')) {
            queueItems = [];
            queueTableBody.innerHTML = '';
            updateTotalCount();
            queueSection.classList.add('d-none');
        }
    });

    // Batch Upload Execution
    startBatchUploadBtn.addEventListener('click', async () => {
        if (isUploading) return;
        if (queueItems.length === 0) {
            alert('Tidak ada berkas dalam antrean.');
            return;
        }

        // Validate all titles
        for (const item of queueItems) {
            if (!item.title.trim()) {
                alert(`Judul untuk berkas ${item.file.name} tidak boleh kosong!`);
                const input = document.getElementById(`title_${item.id}`);
                if (input) input.focus();
                return;
            }
        }

        isUploading = true;
        startBatchUploadBtn.disabled = true;
        clearQueueBtn.disabled = true;
        document.querySelectorAll('.remove-btn').forEach(b => b.disabled = true);
        document.querySelectorAll('.title-input').forEach(b => b.disabled = true);
        document.querySelectorAll('.category-select').forEach(b => b.disabled = true);

        overallProgressWrapper.classList.remove('d-none');

        let successCount = 0;
        let failCount = 0;
        const total = queueItems.length;

        for (let i = 0; i < total; i++) {
            const item = queueItems[i];
            
            // Skip already done items
            if (item.status === 'done') {
                successCount++;
                continue;
            }

            item.status = 'uploading';
            updateTableRowUI(item);

            const percent = Math.round(((i) / total) * 100);
            overallProgressBar.style.width = percent + '%';
            progressPercentText.textContent = percent + '%';
            progressStatusText.textContent = `Mengunggah (${i + 1}/${total}): ${item.title}...`;

            try {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('title', item.title);
                formData.append('category', item.category);
                formData.append('file', item.file);
                if (item.thumbnailDataUrl) {
                    formData.append('thumbnail_base64', item.thumbnailDataUrl);
                }

                const response = await fetch("{{ route('admin.leaflets.batch_upload') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const resJson = await response.json();

                if (response.ok && resJson.success) {
                    item.status = 'done';
                    successCount++;
                } else {
                    item.status = 'error';
                    item.errorMsg = resJson.message || 'Gagal diunggah';
                    failCount++;
                }
            } catch (err) {
                console.error(err);
                item.status = 'error';
                item.errorMsg = 'Kesalahan jaringan';
                failCount++;
            }

            updateTableRowUI(item);
        }

        overallProgressBar.style.width = '100%';
        progressPercentText.textContent = '100%';
        progressStatusText.textContent = `Proses selesai: ${successCount} berhasil, ${failCount} gagal.`;

        isUploading = false;
        startBatchUploadBtn.disabled = false;
        clearQueueBtn.disabled = false;
        document.querySelectorAll('.remove-btn').forEach(b => b.disabled = false);

        if (failCount === 0) {
            const modal = new bootstrap.Modal(document.getElementById('successBatchModal'));
            document.getElementById('successModalMessage').textContent = `Total ${successCount} dokumen leaflet kesehatan berhasil diunggah dan disimpan.`;
            modal.show();
        } else {
            alert(`Selesai diunggah: ${successCount} berhasil, ${failCount} gagal. Anda dapat memeriksa baris yang bertanda merah dan mencoba lagi.`);
        }
    });

    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/&/g, "&amp;")
                   .replace(/</g, "&lt;")
                   .replace(/>/g, "&gt;")
                   .replace(/"/g, "&quot;")
                   .replace(/'/g, "&#039;");
    }
</script>
@endsection
