@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-0">Kelola Permohonan Informasi Publik</h2>
            <p class="text-muted">Daftar permohonan informasi yang masuk dari masyarakat melalui website.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Jenis Permohonan</th>
                            <th class="px-4 py-3">Pesan</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $item)
                        <tr>
                            <td class="px-4 py-3 text-nowrap">{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 fw-bold">{{ $item->nama_lengkap }}</td>
                            <td class="px-4 py-3">
                                <div><a href="mailto:{{ $item->email }}" class="text-decoration-none">{{ $item->email }}</a></div>
                                <small class="text-muted text-wrap" style="max-width: 200px; display: inline-block;">{{ $item->alamat }}</small>
                            </td>
                            <td class="px-4 py-3"><span class="badge bg-secondary">{{ $item->jenis_permohonan }}</span></td>
                            <td class="px-4 py-3">
                                <button type="button" class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#pesanModal{{ $item->id }}">
                                    Lihat Pesan
                                </button>
                                
                                <!-- Modal Pesan -->
                                <div class="modal fade" id="pesanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-bottom-0 pb-0">
                                                <h5 class="modal-title fw-bold">Detail Pesan Permohonan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="bg-light p-3 rounded-3 mb-3">
                                                    <strong>Dari:</strong> {{ $item->nama_lengkap }} ({{ $item->email }})<br>
                                                    <strong>Jenis:</strong> {{ $item->jenis_permohonan }}
                                                </div>
                                                <p style="white-space: pre-wrap;">{{ $item->pesan }}</p>
                                            </div>
                                            <div class="modal-footer border-top-0 pt-0">
                                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($item->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge bg-info text-dark">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('admin.permohonan.status', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto rounded-3" onchange="this.form.submit()">
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada data permohonan informasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($permohonan->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $permohonan->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
