{{-- resources/views/admin/tarif/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid px-0">
    {{-- Header Page --}}
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <span>Daftar Tarif Layanan & Obat</span>
                <span class="badge bg-success-subtle text-success fs-6 fw-semibold rounded-pill px-3 py-1">API RSDKT</span>
            </h3>
            <p class="text-muted mb-0 small">Katalog data tarif, tindakan medis, pemeriksaan laboratorium, dan farmasi</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.tarif.print', ['group' => $group, 'search' => $search ?? '', 'min_price' => $minPrice ?? '', 'max_price' => $maxPrice ?? '']) }}" target="_blank" class="btn btn-outline-danger rounded-3 px-3 py-2 fw-semibold d-flex align-items-center gap-2 shadow-xs">
                <i class="bi bi-printer-fill"></i>
                <span>Cetak / PDF</span>
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- FILTER PENCARIAN CARD --}}
    <div class="card border-0 rounded-4 shadow-sm mb-4 bg-white">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <h6 class="fw-bold text-success mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-funnel-fill"></i> Filter Pencarian Tarif & Obat
                </h6>
                @if(!empty($search) || !empty($minPrice) || !empty($maxPrice) || ($group && $group !== 'OBAT DAN ALKES'))
                    <a href="{{ route('admin.tarif.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-semibold">
                        <i class="bi bi-x-circle-fill"></i> Reset Semua Filter
                    </a>
                @endif
            </div>

            {{-- Quick Category Filter Pills --}}
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold mb-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Kategori Layanan:</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($groups as $grp)
                        <a href="{{ route('admin.tarif.index', array_merge(request()->query(), ['group' => $grp])) }}" 
                           class="btn btn-sm rounded-pill px-3 py-1.5 fw-semibold transition-all {{ ($group == $grp) ? 'btn-success text-white shadow-sm' : 'btn-outline-secondary border-dashed text-secondary' }}">
                            @if($grp == 'OBAT DAN ALKES')
                                <i class="bi bi-capsule me-1"></i>
                            @elseif($grp == 'TINDAKAN MEDIS')
                                <i class="bi bi-heart-pulse me-1"></i>
                            @elseif($grp == 'LAB')
                                <i class="bi bi-moisture me-1"></i>
                            @elseif($grp == 'RADIOLOGI')
                                <i class="bi bi-radioactive me-1"></i>
                            @else
                                <i class="bi bi-grid-3x3-gap me-1"></i>
                            @endif
                            {{ $grp }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Search & Price Filter Form --}}
            <form method="GET" action="{{ route('admin.tarif.index') }}" class="row g-3 align-items-end">
                <input type="hidden" name="group" value="{{ $group }}">

                {{-- Keyword Input --}}
                <div class="col-12 col-md-5">
                    <label class="form-label small fw-bold text-muted mb-1">Cari Nama Obat / Layanan / Kode:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Ketik nama obat (misal: Paracetamol, Amox...)" value="{{ $search ?? '' }}">
                    </div>
                </div>

                {{-- Min Price --}}
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-bold text-muted mb-1">Harga Min (Rp):</label>
                    <input type="number" name="min_price" class="form-control" placeholder="0" value="{{ $minPrice ?? '' }}">
                </div>

                {{-- Max Price --}}
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-bold text-muted mb-1">Harga Max (Rp):</label>
                    <input type="number" name="max_price" class="form-control" placeholder="1000000" value="{{ $maxPrice ?? '' }}">
                </div>

                {{-- Submit Buttons --}}
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success fw-bold px-4 flex-grow-1 rounded-3 d-flex align-items-center justify-content-center gap-1">
                        <i class="bi bi-filter"></i> Terapkan
                    </button>
                    <a href="{{ route('admin.tarif.index', ['group' => $group]) }}" class="btn btn-outline-secondary rounded-3 px-3" title="Reset Pencarian Kata Kunci">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- DATA TABLE CARD --}}
    <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success rounded-pill px-3 py-1.5 fw-bold">{{ count($data) }} Data</span>
                <span class="text-muted small fw-medium">Menampilkan tarif untuk kategori <strong>{{ $group }}</strong></span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tarifTable" class="table table-hover align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3 py-3 text-center" width="5%">No</th>
                            <th class="px-3 py-3" width="14%">Kode Tarif</th>
                            <th class="px-3 py-3" width="14%">Kode Item</th>
                            <th class="px-3 py-3" width="38%">Nama Obat / Layanan</th>
                            <th class="px-3 py-3 text-end" width="17%">Harga Satuan</th>
                            <th class="px-3 py-3 text-center" width="12%">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="px-3 py-3 text-center text-muted fw-semibold">{{ $loop->iteration }}</td>
                            <td class="px-3 py-3">
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 font-monospace">
                                    {{ $item['code_tariff'] ?? '-' }}
                                </span>
                            </td>
                            <td class="px-3 py-3">
                                <span class="badge bg-light text-secondary border px-2 py-1 font-monospace">
                                    {{ $item['code'] ?? '-' }}
                                </span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="fw-bold text-dark">{{ $item['name'] ?? '-' }}</div>
                                <small class="text-muted">{{ $group }}</small>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <span class="fw-bold text-success fs-6">
                                    Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                @if(!empty($item['detail']))
                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 btn-detail" 
                                        data-name="{{ $item['name'] }}"
                                        data-detail="{{ json_encode($item['detail'] ?? []) }}">
                                        <i class="bi bi-list-check me-1"></i> Rincian
                                    </button>
                                @else
                                    <span class="badge bg-light text-muted fw-normal px-2 py-1">-</span>
                                @endif
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
    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
      <div class="modal-header bg-success text-white py-3 px-4">
        <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="detailModalLabel">
            <i class="bi bi-info-circle-fill"></i> Detail Pemeriksaan
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="fw-bold mb-3 text-secondary text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Daftar Item / Komponen:</p>
        <ul id="detailList" class="list-group list-group-flush mb-0 border rounded-3 overflow-hidden">
            <!-- Item disuntik via JS -->
        </ul>
        <div id="noDetailMsg" class="text-center py-4 text-muted d-none">
            <i class="bi bi-box-seam fs-1 mb-2 d-block"></i>
            Tidak ada detail tambahan untuk item ini.
        </div>
      </div>
      <div class="modal-footer bg-light py-2 px-4">
        <button type="button" class="btn btn-secondary rounded-3 px-4 fw-bold" data-bs-dismiss="modal">Tutup</button>
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
        // Init DataTable dengan konfigurasi responsif & bahasa Indonesia
        $('#tarifTable').DataTable({
            pageLength: 25,
            lengthMenu: [[25, 50, 100, 250, -1], [25, 50, 100, 250, "Semua"]],
            language: { 
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                emptyTable: "Tidak ada data tarif yang ditemukan sesuai filter pencarian.",
                search: "Filter cepat tabel:"
            },
            order: [[3, 'asc']] // Urutkan berdasarkan Nama Produk
        });

        // Event delegation untuk tombol detail
        $('#tarifTable tbody').on('click', '.btn-detail', function() {
            var name = $(this).data('name');
            var detailJson = $(this).attr('data-detail');
            var details = [];
            
            try {
                details = detailJson ? JSON.parse(detailJson) : [];
            } catch(e) {}
            
            $('#detailModalLabel').html('<i class="bi bi-info-circle-fill me-2"></i>' + name);
            var listEl = $('#detailList');
            var msgEl = $('#noDetailMsg');
            
            listEl.empty();
            if (details && details.length > 0) {
                details.forEach(function(item) {
                    listEl.append('<li class="list-group-item d-flex align-items-center py-2.5"><i class="bi bi-check-circle-fill text-success fs-6 me-2.5"></i><span>' + item + '</span></li>');
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
