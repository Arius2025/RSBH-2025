@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-success mb-1">Kelola Dokumen PPID</h1>
            <p class="text-muted">Daftar dokumen regulasi, SOP, dan SK PPID.</p>
        </div>
        <a href="{{ route('admin.documents.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Dokumen
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-lg overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small fw-bold">Judul Dokumen</th>
                            <th class="py-3 text-uppercase small fw-bold">Kategori</th>
                            <th class="py-3 text-uppercase small fw-bold">Ukuran</th>
                            <th class="py-3 text-uppercase small fw-bold">Tanggal Upload</th>
                            <th class="px-4 py-3 text-uppercase small fw-bold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $doc)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light p-2 rounded-3 me-3 text-danger">
                                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                                        </div>
                                        <span class="fw-medium text-dark">{{ $doc->title }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    @php
                                        $badgeClass = match($doc->category) {
                                            'regulasi' => 'bg-info',
                                            'sop' => 'bg-warning',
                                            'sk_ppid' => 'bg-primary',
                                            default => 'bg-secondary'
                                        };
                                        $categoryLabel = match($doc->category) {
                                            'regulasi' => 'Regulasi',
                                            'sop' => 'SOP',
                                            'sk_ppid' => 'SK PPID',
                                            default => $doc->category
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $categoryLabel }}</span>
                                </td>
                                <td class="py-3 text-muted small">{{ $doc->file_size }}</td>
                                <td class="py-3 text-muted small">{{ $doc->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-light border-end" title="Lihat">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.documents.edit', $doc) }}" class="btn btn-sm btn-light border-end" title="Edit">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-file-earmark-text fs-1 text-light"></i>
                                        <p class="text-muted mt-2">Belum ada dokumen yang diunggah.</p>
                                        <a href="{{ route('admin.documents.create') }}" class="btn btn-sm btn-outline-success mt-2">Tambah Dokumen Pertama</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
