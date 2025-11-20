@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold text-success mb-4"><i class="bi bi-newspaper me-2"></i> Kelola Berita</h1>
    <p class="lead text-muted">Tambahkan, edit, atau hapus berita yang akan ditampilkan di situs publik.</p>
    <hr>

    {{-- Pesan Sukses (Success Message) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.berita.create') }}" class="btn btn-success transition hover-shadow">
            <i class="bi bi-plus-circle me-1"></i> Tambah Berita Baru
        </a>
    </div>

    {{-- Check apakah ada berita --}}
    @if ($beritas->isEmpty())
        <div class="alert alert-warning text-center py-4">
            <i class="bi bi-info-circle me-2"></i> Belum ada berita yang ditambahkan.
        </div>
    @else
        
        {{-- TAMPILAN DESKTOP: TABLE (d-none di bawah breakpoint lg) --}}
        <div class="card shadow-sm border-0 d-none d-lg-block">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-success text-white">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Gambar</th>
                                <th style="width: 40%;">Judul</th>
                                <th style="width: 20%;">Tanggal</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $berita)
                                <tr class="transition hover-shadow-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($berita->gambar)
                                            {{-- Menampilkan thumbnail gambar dari storage --}}
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted small">Tanpa Gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($berita->judul, 60) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-warning text-dark" title="Edit">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita: {{ $berita->judul }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TAMPILAN MOBILE: CARD LIST (d-lg-none) --}}
        <div class="d-lg-none">
            @foreach ($beritas as $berita)
                <div class="card shadow-sm mb-3 border-start border-success border-4 transition hover-shadow">
                    <div class="row g-0">
                        <div class="col-4">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $berita->judul }}">
                            @else
                                <div class="h-100 bg-light d-flex align-items-center justify-content-center text-muted small p-2">
                                    Tanpa Gambar
                                </div>
                            @endif
                        </div>
                        <div class="col-8">
                            <div class="card-body p-3">
                                <h6 class="card-title fw-bold text-success mb-1">{{ Str::limit($berita->judul, 40) }}</h6>
                                <p class="card-text small text-muted mb-2">
                                    <i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                                </p>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-warning text-dark" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Hapus berita: {{ $berita->judul }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination untuk kedua tampilan --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $beritas->links('pagination::bootstrap-5') }}
        </div>
        
    @endif
</div>
@endsection