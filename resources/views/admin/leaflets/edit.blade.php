@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-success mb-1">Edit Leaflet Kesehatan</h1>
            <p class="text-muted">Perbarui data atau ganti berkas PDF leaflet.</p>
        </div>
        <a href="{{ route('admin.leaflets.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('admin.leaflets.update', $leaflet) }}" method="POST" enctype="multipart/form-data" id="editLeafletForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="thumbnail_base64" id="thumbnail_base64">

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Leaflet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $leaflet->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                @foreach($categories as $key => $val)
                                    <option value="{{ $key }}" {{ old('category', $leaflet->category) === $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pdfFile" class="form-label fw-semibold">Ganti File Dokumen PDF (Opsional)</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="pdfFile" name="file" accept="application/pdf">
                            </div>
                            <div class="small text-muted mt-1">
                                File saat ini: <a href="{{ $leaflet->pdf_url }}" target="_blank" class="fw-semibold text-primary"><i class="bi bi-box-arrow-up-right me-1"></i> Buka PDF ({{ $leaflet->file_size ?? 'PDF' }})</a>. Biarkan kosong jika tidak ingin mengganti file.
                            </div>
                            @error('file')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Cover / Thumbnail</label>
                            <div class="d-flex align-items-start gap-3">
                                <div id="thumbPreviewBox" class="rounded border bg-light d-flex align-items-center justify-content-center text-muted" style="width: 120px; height: 160px; overflow: hidden; position: relative;">
                                    @if($leaflet->thumbnail_path)
                                        <img id="currentThumbnail" src="{{ $leaflet->thumbnail_url }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Current Cover">
                                    @else
                                        <span id="thumbPlaceholder"><i class="bi bi-file-earmark-pdf fs-1 text-danger"></i></span>
                                    @endif
                                    <canvas id="pdfCanvasPreview" class="d-none" style="width: 100%; height: 100%; object-fit: cover;"></canvas>
                                    <img id="customImgPreview" class="d-none" style="width: 100%; height: 100%; object-fit: cover;" alt="Preview">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="thumbnail_file" class="btn btn-sm btn-outline-secondary mb-1">
                                        <i class="bi bi-upload me-1"></i> Unggah Gambar Cover Baru
                                    </label>
                                    <input type="file" class="d-none" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                                    <div class="text-muted small mt-1" id="thumbStatusText">
                                        Pilih file PDF baru untuk auto-generate cover lembar pertama, atau unggah cover gambar kustom di atas.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.leaflets.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-3 bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Statistik Dokumen</h5>
                    <div class="mb-2 text-muted small"><strong>ID Leaflet:</strong> #{{ $leaflet->id }}</div>
                    <div class="mb-2 text-muted small"><strong>Slug URL:</strong> <code>{{ $leaflet->slug }}</code></div>
                    <div class="mb-2 text-muted small"><strong>Jumlah Dibaca:</strong> <span class="badge bg-secondary">{{ number_format($leaflet->views_count) }} kali</span></div>
                    <div class="mb-2 text-muted small"><strong>Dibuat Pada:</strong> {{ $leaflet->created_at->format('d F Y, H:i') }} WIB</div>
                    <div class="mb-0 text-muted small"><strong>Terakhir Diperbarui:</strong> {{ $leaflet->updated_at->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PDF.js for Page-1 Thumbnail extraction --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    const pdfInput = document.getElementById('pdfFile');
    const canvas = document.getElementById('pdfCanvasPreview');
    const currentImg = document.getElementById('currentThumbnail');
    const customImg = document.getElementById('customImgPreview');
    const placeholder = document.getElementById('thumbPlaceholder');
    const statusText = document.getElementById('thumbStatusText');
    const base64Input = document.getElementById('thumbnail_base64');
    const customThumbInput = document.getElementById('thumbnail_file');

    pdfInput.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        statusText.innerHTML = '<span class="spinner-border spinner-border-sm text-primary me-1"></span> Merender cover halaman pertama dari PDF baru...';
        
        try {
            const fileReader = new FileReader();
            fileReader.onload = async function() {
                const typedarray = new Uint8Array(this.result);
                const pdf = await pdfjsLib.getDocument(typedarray).promise;
                const page = await pdf.getPage(1);
                
                const viewport = page.getViewport({ scale: 1.2 });
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                
                const renderContext = {
                    canvasContext: canvas.getContext('2d'),
                    viewport: viewport
                };
                await page.render(renderContext).promise;
                
                const dataUrl = canvas.toDataURL('image/webp', 0.85);
                base64Input.value = dataUrl;

                if (currentImg) currentImg.classList.add('d-none');
                if (placeholder) placeholder.classList.add('d-none');
                customImg.classList.add('d-none');
                canvas.classList.remove('d-none');
                statusText.innerHTML = '<span class="text-success"><i class="bi bi-check-circle me-1"></i> Cover halaman pertama berhasil diekstrak dari PDF baru!</span>';
            };
            fileReader.readAsArrayBuffer(file);
        } catch (err) {
            console.error('PDF Thumbnail error:', err);
            statusText.textContent = 'Gagal mengekstrak cover otomatis.';
        }
    });

    customThumbInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(evt) {
            customImg.src = evt.target.result;
            if (currentImg) currentImg.classList.add('d-none');
            if (placeholder) placeholder.classList.add('d-none');
            canvas.classList.add('d-none');
            customImg.classList.remove('d-none');
            statusText.innerHTML = '<span class="text-primary"><i class="bi bi-image me-1"></i> Menggunakan cover gambar kustom baru.</span>';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
