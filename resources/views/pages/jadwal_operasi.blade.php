@extends('layouts.app')

@section('content')
<style>
    :root { 
        --rs-green: #198754; 
        --rs-green-light: #e6fced;
        --rs-blue: #0d6efd; 
        --rs-blue-light: #cfe2ff;
        --rs-red: #dc3545;
    }
    
    .op-page-container {
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 5rem;
    }

    .op-card { 
        border-radius: 24px; 
        border: none; 
        box-shadow: 0 10px 40px rgba(0,0,0,0.04); 
        background: white; 
    }
    
    .filter-card {
        position: sticky;
        top: 100px;
    }

    /* List Item Styling */
    .op-list-item {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 16px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .op-list-item:hover {
        transform: translateX(8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        border-color: var(--rs-green);
    }

    .op-list-item.is-proses {
        border-left: 6px solid var(--rs-blue);
        background: linear-gradient(90deg, rgba(13, 110, 253, 0.03) 0%, rgba(255,255,255,1) 100%);
        animation: subtlePulse 3s infinite ease-in-out;
    }
    
    @keyframes subtlePulse {
        0% { border-left-color: var(--rs-blue); }
        50% { border-left-color: #70a1ff; }
        100% { border-left-color: var(--rs-blue); }
    }

    .time-box {
        background: var(--rs-green-light);
        color: var(--rs-green);
        padding: 15px;
        border-radius: 16px;
        min-width: 130px;
        text-align: center;
        line-height: 1.2;
    }

    .is-proses .time-box {
        background: var(--rs-blue-light);
        color: var(--rs-blue);
    }

    .pasien-info h5 {
        margin-bottom: 4px;
        font-weight: 700;
        color: #1e293b;
    }

    .detail-badge {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Loading Overlay */
    #loading-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255,255,255,0.9); z-index: 9999;
        display: none; align-items: center; justify-content: center; flex-direction: column;
        backdrop-filter: blur(5px);
    }
    
    .status-live { width: 10px; height: 10px; background: #dc3545; border-radius: 50%; display: inline-block; margin-right: 5px; animation: blink 1.5s infinite; }
    @keyframes blink { 0% { opacity: 1; transform: scale(1); } 50% { opacity: 0.3; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }

    .x-small { font-size: 0.7rem; }
</style>

<div id="loading-overlay">
    <div class="spinner-grow text-success" role="status" style="width: 3rem; height: 3rem;"></div>
    <h5 class="mt-4 fw-bold text-success">Meload Data Jadwal...</h5>
</div>

<div class="op-page-container pt-5">
    <div class="container">
        <div class="row mb-5 align-items-end">
            <div class="col-lg-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2 text-uppercase small fw-bold">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active">Monitoring Operasi</li>
                    </ol>
                </nav>
                <h1 class="fw-extrabold display-5 text-dark mb-1">Monitoring Kamar Operasi</h1>
                <p class="text-muted fs-5"><span class="status-live shadow-sm"></span> Sistem Pemantauan Real-time Antrian Operasi</p>
            </div>
        </div>

        <div class="row g-4">
            {{-- SIDEBAR FILTER --}}
            <div class="col-lg-4">
                <div class="card op-card p-4 filter-card">
                    <form action="{{ route('jadwaloperasi') }}" method="GET" onsubmit="showLoading()">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-success">
                                <i class="bi bi-funnel-fill fs-5"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Filter Data</h5>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Cari Pasien / Dokter</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control border-0 bg-light shadow-none" placeholder="Masukkan nama...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Periode Tanggal</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="p-2 bg-light rounded-3">
                                        <label class="x-small fw-bold text-muted d-block mb-1">DARI</label>
                                        <input type="date" name="tgl_awal" value="{{ $tglAwal }}" class="form-control border-0 bg-transparent p-0 shadow-none small">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 bg-light rounded-3">
                                        <label class="x-small fw-bold text-muted d-block mb-1">SAMPAI</label>
                                        <input type="date" name="tgl_akhir" value="{{ $tglAkhir }}" class="form-control border-0 bg-transparent p-0 shadow-none small">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success py-3 rounded-4 shadow-sm fw-bold">
                                <i class="bi bi-filter me-2"></i>Terapkan Filter
                            </button>
                            @if($search || request()->has('tgl_awal'))
                                <a href="{{ route('jadwaloperasi') }}" class="btn btn-link text-decoration-none text-danger fw-bold small" onclick="showLoading()">
                                    Bersihkan Filter
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- LIST JADWAL --}}
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                    <h5 class="fw-bold mb-0 text-dark">Daftar Antrian <span class="badge bg-success bg-opacity-10 text-success ms-2">{{ $jadwal->count() }} Jadwal</span></h5>
                    <div class="text-muted small">Update Terakhir: {{ now()->format('H:i') }} WIB</div>
                </div>

                @forelse($jadwal as $item)
                    @php
                        $status = strtoupper($item->status);
                        $isProses = ($status == 'PROSES');
                    @endphp
                    <div class="op-list-item op-card {{ $isProses ? 'is-proses' : '' }}" data-aos="fade-up">
                        <div class="time-box">
                            <div class="fw-bold fs-4">{{ date('H:i', strtotime($item->jam_mulai)) }}</div>
                            <div class="small opacity-75">s/d {{ date('H:i', strtotime($item->jam_selesai)) }}</div>
                            <div class="mt-2 text-uppercase fw-bold" style="font-size: 0.65rem;">
                                {{ date('d M Y', strtotime($item->tanggal)) }}
                            </div>
                        </div>

                        <div class="pasien-info flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h5 class="mb-0">{{ $item->pasien }}</h5>
                                @if($isProses)
                                    <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold" style="font-size: 0.65rem;">
                                        <span class="spinner-grow spinner-grow-sm me-1"></span> SEDANG BERLANGSUNG
                                    </span>
                                @endif
                            </div>
                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="detail-badge bg-secondary bg-opacity-10 text-secondary">
                                    <i class="bi bi-hash me-1"></i>RM: {{ $item->rm }}
                                </span>
                                <span class="detail-badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-person-fill me-1"></i>Dr. {{ $item->namadokter }}
                                </span>
                            </div>

                            <div class="text-muted small bg-light p-2 rounded-3 d-inline-block border">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>RUANG: <span class="fw-bold text-dark">{{ $item->namaruang }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="op-card p-5 text-center" data-aos="zoom-in">
                        <div class="bg-light d-inline-block p-4 rounded-circle mb-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                        </div>
                        <h4 class="fw-bold">Tidak Ada Jadwal</h4>
                        <p class="text-muted">Maaf, tidak ditemukan jadwal operasi untuk periode atau kriteria pencarian ini.</p>
                        <a href="{{ route('jadwaloperasi') }}" class="btn btn-success rounded-pill px-4 mt-3">Reset Pencarian</a>
                    </div>
                @endforelse
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