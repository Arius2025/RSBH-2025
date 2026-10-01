@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="fw-bold text-success mb-1">Kelola Leaflet Informasi Kesehatan</h1>
            <p class="text-muted mb-0">Manajemen leaflet edukasi kesehatan masyarakat, pasien, dan pengunjung.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.leaflets.batch') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-file-earmark-zip me-1"></i> Bulk Multi-PDF (Otomatis)
            </a>
            <a href="{{ route('admin.leaflets.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Manual
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                        <i class="bi bi-journal-medical fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium">Total Leaflet</div>
                        <div class="fs-4 fw-bold text-dark">{{ number_format($stats['total']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                        <i class="bi bi-tags fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium">Kategori Aktif</div>
                        <div class="fs-4 fw-bold text-dark">{{ $stats['categories_count'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                        <i class="bi bi-eye fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium">Total Kali Dibaca</div>
                        <div class="fs-4 fw-bold text-dark">{{ number_format($stats['total_views']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Form --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.leaflets.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control bg-light border-start-0" placeholder="Cari judul leaflet atau topik...">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <select name="category" class="form-select bg-light">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $key => $val)
                            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1">Filter</button>
                    @if(request()->hasAny(['q', 'category']))
                        <a href="{{ route('admin.leaflets.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Leaflet Table --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small fw-bold" style="width: 80px;">Cover</th>
                            <th class="py-3 text-uppercase small fw-bold">Judul Leaflet</th>
                            <th class="py-3 text-uppercase small fw-bold">Kategori</th>
                            <th class="py-3 text-uppercase small fw-bold">Ukuran</th>
                            <th class="py-3 text-uppercase small fw-bold">Dibaca</th>
                            <th class="py-3 text-uppercase small fw-bold">Tanggal</th>
                            <th class="px-4 py-3 text-uppercase small fw-bold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaflets as $leaf)
                            <tr>
                                <td class="px-4 py-3">
                                    @if($leaf->thumbnail_path)
                                        <img src="{{ $leaf->thumbnail_url }}" alt="{{ $leaf->title }}" class="rounded shadow-xs border" style="width: 48px; height: 64px; object-fit: cover;">
                                    @else
                                        <div class="rounded border bg-light d-flex align-items-center justify-content-center text-danger" style="width: 48px; height: 64px;">
                                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="fw-semibold text-dark">{{ $leaf->title }}</div>
                                    <a href="{{ $leaf->pdf_url }}" target="_blank" class="small text-muted text-decoration-none hover-primary">
                                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka File PDF
                                    </a>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                        {{ $leaf->category }}
                                    </span>
                                </td>
                                <td class="py-3 text-muted small">{{ $leaf->file_size ?? '-' }}</td>
                                <td class="py-3">
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-eye me-1 text-primary"></i> {{ number_format($leaf->views_count) }}
                                    </span>
                                </td>
                                <td class="py-3 text-muted small">{{ $leaf->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                        <a href="{{ $leaf->pdf_url }}" target="_blank" class="btn btn-sm btn-light border-end" title="Lihat PDF">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.leaflets.edit', $leaf) }}" class="btn btn-sm btn-light border-end" title="Edit">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.leaflets.destroy', $leaf) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus leaflet ini?')">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-journal-x fs-1 text-muted"></i>
                                        <p class="text-muted mt-2">Belum ada dokumen leaflet kesehatan.</p>
                                        <div class="d-flex justify-content-center gap-2 mt-3">
                                            <a href="{{ route('admin.leaflets.batch') }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-file-earmark-zip me-1"></i> Upload Sekaligus (Bulk)
                                            </a>
                                            <a href="{{ route('admin.leaflets.create') }}" class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-plus-lg me-1"></i> Upload Satu-per-satu
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($leaflets->hasPages())
                <div class="px-4 py-3 border-top d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan {{ $leaflets->firstItem() }} - {{ $leaflets->lastItem() }} dari total {{ $leaflets->total() }} leaflet
                    </div>
                    <div>
                        {{ $leaflets->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
