@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.documents.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <h1 class="fw-bold text-success">Edit Dokumen</h1>
        <p class="text-muted">Perbarui informasi atau ganti file dokumen yang sudah ada.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Judul Dokumen</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $document->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-bold">Kategori Dokumen</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="regulasi" {{ old('category', $document->category) == 'regulasi' ? 'selected' : '' }}>Regulasi</option>
                                <option value="sop" {{ old('category', $document->category) == 'sop' ? 'selected' : '' }}>SOP</option>
                                <option value="sk_ppid" {{ old('category', $document->category) == 'sk_ppid' ? 'selected' : '' }}>SK PPID</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">Ganti File (Kosongkan jika tidak ingin mengganti)</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf">
                                <label class="input-group-text" for="file"><i class="bi bi-upload"></i></label>
                            </div>
                            <div class="mt-2 p-2 bg-light rounded-3 d-flex align-items-center">
                                <i class="bi bi-file-earmark-check text-success me-2 fs-5"></i>
                                <div class="small">
                                    <span class="text-muted">File saat ini:</span> 
                                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-primary fw-medium text-decoration-none">{{ basename($document->file_path) }}</a>
                                    <span class="text-muted ms-1">({{ $document->file_size }})</span>
                                </div>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm py-3 fw-bold">
                                <i class="bi bi-check-circle me-2"></i> Perbarui Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
