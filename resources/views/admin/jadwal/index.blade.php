{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="mx-auto" style="max-width: 900px;">
        <h2 class="fw-bold text-success mb-4"><i class="bi bi-calendar-week me-2"></i> Kelola Jadwal Dokter</h2>
        <hr>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        {{-- Notifikasi Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Gagal menyimpan!</strong> Mohon periksa kembali input Anda.
            </div>
        @endif

        {{-- Form Edit Jadwal --}}
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Perbarui Gambar Jadwal (Pagi dan Sore)</h5>
            </div>
            <div class="card-body">
                {{-- PENTING: Gunakan enctype="multipart/form-data" untuk upload file --}}
                <form action="{{ route('admin.jadwal.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Input Gambar Pagi --}}
                    <div class="mb-4 p-3 border rounded">
                        <label for="gambar_pagi" class="form-label fw-bold">Jadwal Sesi Pagi</label>
                        
                        {{-- Tampilkan Gambar Saat Ini --}}
                        @if ($jadwal->gambar_pagi)
                            <p class="text-muted small mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $jadwal->gambar_pagi) }}" alt="Jadwal Pagi" class="img-fluid rounded mb-3 shadow-sm" style="max-height: 250px; border: 1px solid #ccc;">
                        @else
                            <div class="alert alert-info py-2">Belum ada gambar Jadwal Pagi diunggah.</div>
                        @endif

                        <input class="form-control @error('gambar_pagi') is-invalid @enderror" type="file" id="gambar_pagi" name="gambar_pagi">
                        @error('gambar_pagi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload gambar baru akan menimpa gambar lama.</div>
                    </div>

                    {{-- Input Gambar Sore --}}
                    <div class="mb-4 p-3 border rounded">
                        <label for="gambar_sore" class="form-label fw-bold">Jadwal Sesi Sore</label>
                        
                        {{-- Tampilkan Gambar Saat Ini --}}
                        @if ($jadwal->gambar_sore)
                            <p class="text-muted small mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $jadwal->gambar_sore) }}" alt="Jadwal Sore" class="img-fluid rounded mb-3 shadow-sm" style="max-height: 250px; border: 1px solid #ccc;">
                        @else
                            <div class="alert alert-info py-2">Belum ada gambar Jadwal Sore diunggah.</div>
                        @endif

                        <input class="form-control @error('gambar_sore') is-invalid @enderror" type="file" id="gambar_sore" name="gambar_sore">
                        @error('gambar_sore')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload gambar baru akan menimpa gambar lama.</div>
                    </div>

                    <div class="d-grid gap-2">
                         <button type="submit" class="btn btn-success btn-lg shadow-sm">
                            <i class="bi bi-cloud-upload me-2"></i> Simpan Perubahan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection