{{-- resources/views/admin/tarif/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="fw-bold text-success mb-2">Tarif Produk RSDKT</h1>
            <p class="text-muted mb-0">Kelola dan integrasi data tarif dari API RSDKT.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <form method="GET" action="{{ route('admin.tarif.index') }}" class="d-flex justify-content-md-end">
                <div class="input-group" style="max-width: 350px;">
                    <select name="group" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Bagian (Group) --</option>
                        @foreach($groups as $grp)
                            <option value="{{ $grp }}" {{ $group == $grp ? 'selected' : '' }}>{{ $grp }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success" type="submit">Filter</button>
                    <a href="{{ route('admin.tarif.print', ['group' => $group]) }}" target="_blank" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Cetak
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tarifTable" class="table table-hover table-striped align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3" width="5%">#</th>
                            <th class="px-4 py-3" width="15%">Kode Tarif</th>
                            <th class="px-4 py-3" width="15%">Kode Internal</th>
                            <th class="px-4 py-3" width="35%">Nama Produk</th>
                            <th class="px-4 py-3 text-end" width="15%">Harga</th>
                            <th class="px-4 py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3"><span class="badge bg-primary">{{ $item['code_tariff'] ?? '-' }}</span></td>
                            <td class="px-4 py-3"><span class="badge bg-secondary">{{ $item['code'] ?? '-' }}</span></td>
                            <td class="px-4 py-3 fw-medium">{{ $item['name'] ?? '-' }}</td>
                            <td class="px-4 py-3 text-end">
                                Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button type="button" class="btn btn-sm btn-outline-info btn-detail" 
                                    data-name="{{ $item['name'] }}"
                                    data-detail="{{ json_encode($item['detail'] ?? []) }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-bold" id="detailModalLabel"><i class="bi bi-info-circle me-2"></i>Detail Layanan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="fw-bold mb-3 text-secondary text-uppercase" style="font-size: 0.85rem;">Daftar Pemeriksaan / Item:</p>
        <ul id="detailList" class="list-group list-group-flush mb-0 border rounded">
            <!-- Item disuntik via JS -->
        </ul>
        <div id="noDetailMsg" class="text-center py-4 text-muted d-none">
            <i class="bi bi-box-seam fs-1 mb-2 d-block"></i>
            Tidak ada detail tambahan untuk item ini.
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- DataTables & Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        // Init DataTable
        $('#tarifTable').DataTable({
            pageLength: 20,
            lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "Semua"]],
            language: { 
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                emptyTable: "Tidak ada data tarif yang ditemukan. Silakan pilih filter atau cek koneksi API."
            }
        });

        // Event delegation untuk tombol detail karena DataTables membuat element baru dari DOM pada page lain
        $('#tarifTable tbody').on('click', '.btn-detail', function() {
            var name = $(this).data('name');
            var detailJson = $(this).attr('data-detail');
            var details = [];
            
            try {
                details = detailJson ? JSON.parse(detailJson) : [];
            } catch(e) {}
            
            $('#detailModalLabel').html('<i class="bi bi-info-circle me-2"></i>' + name);
            var listEl = $('#detailList');
            var msgEl = $('#noDetailMsg');
            
            listEl.empty();
            if (details && details.length > 0) {
                details.forEach(function(item) {
                    listEl.append('<li class="list-group-item d-flex align-items-center"><i class="bi bi-check2-circle text-success fs-5 me-3"></i>' + item + '</li>');
                });
                listEl.show();
                msgEl.addClass('d-none');
            } else {
                listEl.hide();
                msgEl.removeClass('d-none');
            }
            
            var modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    });
</script>
@endsection
