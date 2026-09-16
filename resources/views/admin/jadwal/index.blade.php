@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="mx-auto" style="max-width: 1000px;">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h2 class="fw-bold text-success mb-1"><i class="bi bi-calendar-week me-2"></i> Kelola Jadwal Dokter</h2>
                <p class="text-muted small mb-0">Kelola foto jadwal dokter (Bisa 1 foto sampai maksimal 5 foto)</p>
            </div>
            <a href="{{ route('dokter') }}" target="_blank" class="btn btn-outline-success btn-sm">
                <i class="bi bi-box-arrow-up-right me-1"></i> Pratinjau Halaman Publik
            </a>
        </div>
        <hr>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Notifikasi Error Validasi --}}
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-octagon-fill me-1"></i> Gagal memproses data:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Bagian 1: Daftar Foto Aktif --}}
        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fs-6 fw-bold"><i class="bi bi-images me-2"></i> Foto Jadwal Aktif Saat Ini</h5>
                <span class="badge bg-white text-success rounded-pill px-3 py-1 fw-bold">
                    {{ count($fotoList) }} / 5 Foto Terpasang
                </span>
            </div>
            <div class="card-body p-4">
                @if(count($fotoList) > 0)
                    <div class="row g-4">
                        @foreach($fotoList as $index => $fotoPath)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border shadow-none bg-light rounded-3 overflow-hidden">
                                    <div class="bg-white border-bottom px-3 py-2 d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark small"><i class="bi bi-image me-1"></i> Foto #{{ $index + 1 }}</span>
                                        <span class="badge bg-success-subtle text-success">Bagian {{ $index + 1 }}</span>
                                    </div>
                                    <div class="p-3 text-center bg-white">
                                        <a href="{{ Storage::url($fotoPath) }}" target="_blank" class="d-block" title="Klik untuk memperbesar">
                                            <img src="{{ Storage::url($fotoPath) }}" alt="Jadwal {{ $index + 1 }}" 
                                                 class="img-fluid rounded border shadow-sm" 
                                                 style="max-height: 180px; width: auto; object-fit: contain;">
                                        </a>
                                    </div>
                                    <div class="card-body p-3 bg-light d-flex flex-column justify-content-end gap-2">
                                        {{-- Form Ganti Foto --}}
                                        <form action="{{ route('admin.jadwal.update') }}" method="POST" enctype="multipart/form-data" class="mb-1">
                                            @csrf
                                            <label class="form-label small fw-semibold text-secondary mb-1">Ganti Foto Ini:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="file" name="replace_foto[{{ $index }}]" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                                                <button type="submit" class="btn btn-outline-primary" title="Unggah pengganti">
                                                    <i class="bi bi-arrow-repeat"></i> Ganti
                                                </button>
                                            </div>
                                        </form>

                                        {{-- Form Hapus Foto --}}
                                        <form action="{{ route('admin.jadwal.delete_foto', $index) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus Foto #{{ $index + 1 }} ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                <i class="bi bi-trash3-fill me-1"></i> Hapus Foto Ini
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2 mb-0">Belum ada foto jadwal dokter yang diunggah. Silakan gunakan formulir di bawah ini untuk mengunggah.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bagian 2: Unggah Foto Baru --}}
        @if(count($fotoList) < 5)
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fs-6 fw-bold text-success"><i class="bi bi-cloud-arrow-up-fill me-2"></i> Tambah Foto Jadwal Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.jadwal.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tambah_foto" class="form-label fw-bold">
                                Pilih Foto Jadwal Dokter 
                                <span class="text-muted fw-normal">(Tersedia {{ 5 - count($fotoList) }} slot foto lagi)</span>
                            </label>
                            <input class="form-control form-control-lg @error('tambah_foto') is-invalid @enderror" 
                                   type="file" id="tambah_foto" name="tambah_foto[]" multiple accept="image/jpeg,image/png,image/webp" required>
                            <div class="form-text mt-2 text-muted">
                                <i class="bi bi-info-circle me-1"></i> Anda dapat memilih <strong>1 foto saja</strong> atau <strong>sampai {{ 5 - count($fotoList) }} foto sekaligus</strong>. Format didukung: JPG, PNG, WEBP (Maks. 10MB per foto).
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="bi bi-cloud-upload me-2"></i> Unggah & Simpan Foto Jadwal
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning d-flex align-items-center mb-0" role="alert">
                <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                <div>
                    <strong>Batas Maksimal Tercapai:</strong> Jumlah foto jadwal sudah mencapai batas maksimal 5 foto. Jika ingin menambahkan foto baru, silakan hapus salah satu foto lama di atas terlebih dahulu.
                </div>
            </div>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm me-2">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
            </a>
            <a href="{{ route('dokter') }}" target="_blank" class="btn btn-outline-success btn-sm">
                <i class="bi bi-eye me-1"></i> Lihat Tampilan Dokter
            </a>
        </div>
    </div>
</div>
@endsection