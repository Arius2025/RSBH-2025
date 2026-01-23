@extends('layouts.app')

@section('content')
<style>
    :root { --rs-green: #157347; --rs-blue: #0d6efd; --rs-gold: #ffc107; }
    .op-card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); background: white; }
    
    /* Stats Box Styling */
    .stats-box { border-radius: 15px; padding: 12px 20px; text-align: center; min-width: 120px; border: 1px solid #f0f0f0; transition: 0.3s; }
    .stats-box:hover { transform: translateY(-5px); }
    .stats-number { font-size: 1.6rem; font-weight: 800; line-height: 1; margin-top: 5px; }
    
    /* Table Styling */
    .table-container { border-radius: 20px; overflow: hidden; background: white; border: 1px solid #eee; }
    .row-proses { background-color: rgba(13, 110, 253, 0.05) !important; border-left: 5px solid var(--rs-blue); }
    
    /* Loading Overlay */
    #loading-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255,255,255,0.85); z-index: 9999;
        display: none; align-items: center; justify-content: center; flex-direction: column;
    }
    
    .status-live { width: 10px; height: 10px; background: red; border-radius: 50%; display: inline-block; margin-right: 5px; animation: blink 1s infinite; }
    @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
</style>

<div id="loading-overlay">
    <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;"></div>
    <h5 class="mt-3 fw-bold text-success">Memproses Data...</h5>
</div>

<div class="container py-5">
    <div class="row mb-4 align-items-center">
        <div class="col-lg-5 mb-3 mb-lg-0">
            <h2 class="fw-bold text-dark mb-1">Monitoring Kamar Operasi</h2>
            <p class="text-muted small mb-0"><span class="status-live"></span> Sistem Terintegrasi RS DKT Jember</p>
        </div>
        <div class="col-lg-7">
            <div class="d-flex gap-2 justify-content-lg-end flex-wrap">
                <div class="stats-box bg-white shadow-sm border-start border-warning border-4">
                    <div class="small text-muted fw-bold">MENUNGGU</div>
                    <div class="stats-number text-warning">{{ $jadwal->where('status', 'MENUNGGU')->count() }}</div>
                </div>
                <div class="stats-box bg-white shadow-sm border-start border-primary border-4">
                    <div class="small text-muted fw-bold">PROSES</div>
                    <div class="stats-number text-primary">{{ $jadwal->where('status', 'PROSES')->count() }}</div>
                </div>
                <div class="stats-box bg-white shadow-sm border-start border-success border-4">
                    <div class="small text-muted fw-bold">SELESAI</div>
                    <div class="stats-number text-success">{{ $jadwal->where('status', 'SELESAI')->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card op-card p-4">
                <form action="{{ route('jadwaloperasi') }}" method="GET" onsubmit="showLoading()">
                    <h6 class="fw-bold mb-3 text-uppercase small text-muted"><i class="bi bi-search me-2"></i>Pencarian</h6>
                    <div class="mb-4">
                        <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control form-control-lg border-0 bg-light shadow-none" placeholder="Nama / Dokter / RM...">
                    </div>

                    <h6 class="fw-bold mb-3 text-uppercase small text-muted"><i class="bi bi-calendar-range me-2"></i>Periode Tanggal</h6>
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label class="x-small fw-bold text-muted">Mulai</label>
                            <input type="date" name="tgl_awal" value="{{ $tglAwal }}" class="form-control border-0 bg-light shadow-none">
                        </div>
                        <div class="col-6">
                            <label class="x-small fw-bold text-muted">Sampai</label>
                            <input type="date" name="tgl_akhir" value="{{ $tglAkhir }}" class="form-control border-0 bg-light shadow-none">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success py-3 rounded-3 shadow-sm fw-bold">
                            Tampilkan Data
                        </button>
                        @if($search || request()->has('tgl_awal'))
                            <a href="{{ route('jadwaloperasi') }}" class="btn btn-outline-danger py-2 rounded-3 fw-bold small" onclick="showLoading()">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="table-container shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-uppercase small fw-bold">
                                <th class="py-3 ps-4" style="width: 120px;">Waktu</th>
                                <th class="py-3">Detail Pasien</th>
                                <th class="py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $item)
                                @php
                                    $status = strtoupper($item->status);
                                    $isProses = ($status == 'PROSES');
                                @endphp
                                <tr class="{{ $isProses ? 'row-proses' : '' }}">
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</div>
                                        <small class="text-muted d-block">{{ $item->tanggal }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark mb-0">{{ $item->pasien }}</div>
                                        <div class="small text-muted mb-1">
                                            <span class="badge bg-secondary-subtle text-secondary me-1">RM: {{ $item->rm }}</span>
                                            Dr. {{ $item->namadokter }}
                                        </div>
                                        <div class="small text-muted text-truncate" style="max-width: 250px;">
                                            <i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $item->namaruang }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $badgeStyle = 'background: #fff3cd; color: #856404;'; // MENUNGGU
                                            if($status == 'SELESAI') $badgeStyle = 'background: #d4edda; color: #155724;';
                                            if($status == 'PROSES') $badgeStyle = 'background: #cfe2ff; color: #084298;';
                                        @endphp
                                        <span class="badge rounded-pill px-3 py-2 shadow-sm" style="{{ $badgeStyle }} font-size: 10px;">
                                            @if($isProses) <span class="spinner-grow spinner-grow-sm me-1"></span> @endif
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="bi bi-inbox display-4 text-light d-block mb-3"></i>
                                        <p class="text-muted">Tidak ada jadwal ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoading() {
        document.getElementById('loading-overlay').style.display = 'flex';
    }
</script>
@endsection