@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold text-success mb-1"><i class="bi bi-shield-lock me-2"></i>Area Rahasia Pengelola Jadwal</h2>
            <p class="text-muted">Halaman ini digunakan untuk mengunggah foto atau video jadwal dokter harian.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('jadwal') }}" class="btn btn-outline-success rounded-pill">
                <i class="bi bi-eye me-1"></i> Lihat Tampilan Publik
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger shadow-sm pb-0">
            <ul class="mb-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <!-- Form Upload -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg" style="border-radius: 16px;">
                <div class="card-header bg-success text-white py-3 border-0" style="border-radius: 16px 16px 0 0;">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-cloud-arrow-up me-2"></i>Upload File Baru</h5>
                </div>
                <div class="card-body p-4 bg-light" style="border-radius: 0 0 16px 16px;">
                    <form action="{{ route('jadwal-harian.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Tanggal Jadwal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Foto Jadwal <span class="text-muted">(Opsional)</span></label>
                            <input type="file" name="foto" class="form-control bg-white" accept="image/*">
                            <div class="form-text mt-1"><i class="bi bi-info-circle me-1"></i>Akan selalu tampil di atas video.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Video Jadwal <span class="text-muted">(Opsional)</span></label>
                            <input type="file" name="video" class="form-control bg-white" accept="video/*">
                            <div class="form-text mt-1"><i class="bi bi-info-circle me-1"></i>Max ukuran: 250MB. (Format: MP4, AVI, dll)</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Keterangan Tambahan <span class="text-muted">(Opsional)</span></label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Jadwal Spesialis Pagi..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success fw-bold w-100 py-2 shadow-sm rounded-pill">
                            <i class="bi bi-upload me-2"></i> Unggah Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar File 30 Terbaru -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center" style="border-radius: 16px 16px 0 0;">
                    <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-clock-history me-2 text-success"></i>Riwayat Upload (30 Terakhir)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Preview</th>
                                    <th>Info File</th>
                                    <th>Tanggal Berlaku</th>
                                    <th class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <!-- PREVIEW -->
                                        <td class="ps-4" style="width: 120px;">
                                            @if($item->type === 'video')
                                                <div class="bg-dark rounded text-center d-flex align-items-center justify-content-center border" style="width: 80px; height: 60px;">
                                                    <i class="bi bi-play-circle text-white fs-3"></i>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $item->file_path) }}" class="rounded border object-fit-cover" style="width: 80px; height: 60px;" alt="preview">
                                            @endif
                                        </td>
                                        
                                        <!-- INFO FILE -->
                                        <td>
                                            <div class="fw-bold text-dark text-truncate" style="max-width: 200px;">
                                                {{ $item->original_name }}
                                            </div>
                                            <span class="badge bg-{{ $item->type === 'video' ? 'primary' : 'success' }} px-2 py-1 mt-1">
                                                <i class="bi bi-{{ $item->type === 'video' ? 'camera-video' : 'image' }} me-1"></i>
                                                {{ strtoupper($item->type) }}
                                            </span>
                                            @if($item->keterangan)
                                                <div class="small text-muted mt-1 text-truncate" style="max-width: 200px;">
                                                    {{ $item->keterangan }}
                                                </div>
                                            @endif
                                        </td>
                                                
                                        <!-- TANGGAL -->
                                        <td>
                                            <span class="fw-medium text-dark">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                            <br>
                                            <small class="text-muted">Diunggah: {{ $item->created_at->diffForHumans() }}</small>
                                        </td>
                                            
                                        <!-- AKSI -->
                                        <td class="text-center pe-4" style="width: 100px;">
                                            <form action="{{ route('jadwal-harian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" title="Hapus Permanen">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                            Belum ada data jadwal yang diunggah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-warning mt-4 shadow-sm border-warning border-start border-4 border-end-0 border-top-0 border-bottom-0">
                <i class="bi bi-exclamation-triangle-fill me-2 text-warning fs-5"></i>
                <strong>Perhatian:</strong> Halaman ini bersifat rahasia (tidak dipublish di mana pun) dan menjadi jalan pintas admin untuk mengunggah cepat. URL ini tidak terproteksi sandi. Jangan bagikan link <code>/update-jadwal-rahasia-x912</code> kepada pihak yang tidak berkepentingan.
            </div>
            
        </div>
    </div>
</div>
@endsection
