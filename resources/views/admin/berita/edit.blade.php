@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold text-warning mb-4"><i class="bi bi-pencil-square me-2"></i> Edit Berita</h1>
    <p class="lead text-muted">Perbarui informasi berita: <span class="fw-bold">{{ $berita->judul }}</span></p>
    <hr>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark fw-bold">
            Formulir Perubahan Berita
        </div>
        <div class="card-body">
            
            {{-- Form untuk UPDATE (PUT/PATCH method) --}}
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Input Judul --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $berita->judul) }}"
                           placeholder="Masukkan judul berita yang menarik" 
                           required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Isi Berita --}}
                <div class="mb-4">
                    <label for="isi" class="form-label fw-semibold">Isi Berita <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                              id="isi" 
                              name="isi" 
                              rows="10"
                              placeholder="Tulis konten berita secara lengkap di sini" 
                              required>{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Gambar Utama --}}
                <div class="mb-4">
                    <label for="gambar" class="form-label fw-semibold">Ganti Gambar Utama</label>
                    
                    {{-- Tampilkan Gambar Lama --}}
                    @if ($berita->gambar)
                        <div class="mb-2">
                            <p class="mb-1 small text-muted">Gambar saat ini:</p>
                            {{-- Asumsi gambar disimpan di storage/app/public/berita/ --}}
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-thumbnail" style="max-width: 200px; height: auto;">
                        </div>
                    @else
                         <p class="mb-1 small text-muted">Belum ada gambar yang diupload.</p>
                    @endif

                    <input class="form-control @error('gambar') is-invalid @enderror" 
                           type="file" 
                           id="gambar" 
                           name="gambar"
                           accept="image/*">
                    <div class="form-text">Kosongkan jika tidak ingin mengganti gambar. Maksimal 2MB (JPG, JPEG, PNG).</div>
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
                    <button type="submit" class="btn btn-warning btn-lg text-dark transition hover-shadow">
                        <i class="bi bi-arrow-clockwise me-1"></i> Perbarui Berita
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection