@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold text-success mb-4"><i class="bi bi-plus-circle me-2"></i> Tambah Berita Baru</h1>
    <p class="lead text-muted">Isi formulir di bawah ini untuk mempublikasikan berita baru.</p>
    <hr>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white fw-bold">
            Formulir Berita
        </div>
        <div class="card-body">
            
            {{-- Form untuk CREATE (POST method) --}}
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Input Judul --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul berita yang menarik" 
                           required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Isi Berita --}}
                <div class="mb-4">
                    <label for="isi" class="form-label fw-semibold">Isi Berita <span class="text-danger">*</span></label>
                    {{-- Ganti dengan Rich Text Editor seperti TinyMCE atau CKEditor untuk produksi --}}
                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                              id="isi" 
                              name="isi" 
                              rows="10"
                              placeholder="Tulis konten berita secara lengkap di sini" 
                              required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Gambar Utama --}}
                <div class="mb-4">
                    <label for="gambar" class="form-label fw-semibold">Gambar Utama</label>
                    <input class="form-control @error('gambar') is-invalid @enderror" 
                           type="file" 
                           id="gambar" 
                           name="gambar"
                           accept="image/*">
                    <div class="form-text">Maksimal 2MB (JPG, JPEG, PNG).</div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary transition hover-shadow">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success btn-lg transition hover-shadow">
                        <i class="bi bi-save me-1"></i> Simpan Berita
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection