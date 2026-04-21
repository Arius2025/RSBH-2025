@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.documents.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <h1 class="fw-bold text-success">Tambah Dokumen Baru</h1>
        <p class="text-muted">Unggah dokumen regulasi, SOP, atau SK PPID baru.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Judul Dokumen</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Regulasi Keterbukaan Informasi Publik" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-bold">Kategori Dokumen</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="regulasi" {{ old('category') == 'regulasi' ? 'selected' : '' }}>Regulasi</option>
                                <option value="sop" {{ old('category') == 'sop' ? 'selected' : '' }}>SOP</option>
                                <option value="sk_ppid" {{ old('category') == 'sk_ppid' ? 'selected' : '' }}>SK PPID</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">File Dokumen (PDF, Max 10MB)</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf" required>
                                <label class="input-group-text" for="file"><i class="bi bi-upload"></i></label>
                            </div>
                            <div class="form-text small text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i> Pastikan file dalam format PDF untuk memudahkan akses publik.
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm py-3 fw-bold">
                                <i class="bi bi-cloud-upload me-2"></i> Simpan dan Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mt-lg-0 mt-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb text-warning me-2"></i>Tips Menambah Dokumen</h5>
                    <ul class="small text-muted ps-3 mb-0">
                        <li class="mb-2">Gunakan judul yang deskriptif namun ringkas agar mudah dicari oleh masyarakat.</li>
                        <li class="mb-2">Pilih kategori yang sesuai agar dokumen muncul di tab yang tepat pada halaman publik.</li>
                        <li class="mb-2">Disarankan menggunakan format PDF karena sifatnya yang statis dan dapat dibuka di hampir semua perangkat.</li>
                        <li>Pastikan ukuran file tidak melebihi 10MB untuk menghemat ruang penyimpanan server.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
