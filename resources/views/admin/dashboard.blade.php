{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<div class="container-fluid px-0">
    {{-- Header Section --}}
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 pb-3 border-bottom gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h3 class="fw-bold text-dark mb-0">Dashboard & Analitik Pengunjung</h3>
                <span class="badge bg-success-subtle text-success fs-6 fw-semibold rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1.5">
                    <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 8px; height: 8px;"></span> Live Analytics
                </span>
            </div>
            <p class="text-muted mb-0 small">Statistik lengkap lalu lintas, perangkat, lokasi asal, dan performa website RS Tk. III Baladhika Husada</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-white border text-secondary px-3 py-2 rounded-pill shadow-xs d-flex align-items-center gap-1.5">
                <i class="bi bi-calendar3 text-success"></i> {{ date('d F Y') }}
            </span>
            <span class="badge bg-white border text-secondary px-3 py-2 rounded-pill shadow-xs d-flex align-items-center gap-1.5">
                <i class="bi bi-clock text-success"></i> {{ date('H:i') }} WIB
            </span>
        </div>
    </div>

    {{-- KPI STAT CARDS (4 Cards Grid) --}}
    <div class="row g-3 g-lg-4 mb-4">
        {{-- Card 1: Total Kunjungan --}}
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-sm p-3 p-md-4 bg-white h-100 position-relative overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Kunjungan</span>
                    <div class="rounded-3 p-2 bg-success-subtle text-success">
                        <i class="bi bi-eye-fill fs-5"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-1 font-monospace">{{ number_format($totalPageViews, 0, ',', '.') }}</h2>
                <span class="text-muted small" style="font-size: 0.75rem;">Seluruh Page Views</span>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>

        {{-- Card 2: Pengunjung Unik --}}
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-sm p-3 p-md-4 bg-white h-100 position-relative overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Pengunjung Unik</span>
                    <div class="rounded-3 p-2 text-primary" style="background: rgba(13, 110, 253, 0.1);">
                        <i class="bi bi-people-fill fs-5"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-1 font-monospace">{{ number_format($totalUniqueVisitors, 0, ',', '.') }}</h2>
                <span class="text-muted small" style="font-size: 0.75rem;">Berdasarkan Alamat IP</span>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                </div>
            </div>
        </div>

        {{-- Card 3: Pengunjung Hari Ini --}}
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-sm p-3 p-md-4 bg-white h-100 position-relative overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Hari Ini</span>
                    <div class="rounded-3 p-2 text-warning" style="background: rgba(255, 193, 7, 0.15);">
                        <i class="bi bi-calendar-check-fill fs-5 text-warning"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-1 font-monospace">{{ number_format($todayPageViews, 0, ',', '.') }}</h2>
                <span class="text-success small fw-semibold" style="font-size: 0.75rem;">
                    <i class="bi bi-person-fill"></i> {{ number_format($todayUniqueVisitors, 0, ',', '.') }} Pengunjung Unik
                </span>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"></div>
                </div>
            </div>
        </div>

        {{-- Card 4: Pengunjung Online / Realtime --}}
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-sm p-3 p-md-4 bg-white h-100 position-relative overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Online Sekarang</span>
                    <div class="rounded-3 p-2 text-danger" style="background: rgba(220, 53, 69, 0.1);">
                        <i class="bi bi-broadcast fs-5 text-danger"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold text-dark mb-0 font-monospace">{{ $activeVisitorsNow }}</h2>
                    <span class="badge bg-success-subtle text-success rounded-pill px-2 py-0.5 small" style="font-size: 0.65rem;">Aktif (15m)</span>
                </div>
                <span class="text-muted small" style="font-size: 0.75rem;">Sedang membuka website</span>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN INTERACTIVE TIMESERIES CHART (Per Jam, Hari, Minggu, Bulan, Tahun) --}}
    <div class="card border-0 rounded-4 shadow-sm mb-4 bg-white">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div>
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-graph-up-arrow text-success"></i> Grafik Tren Pengunjung Website
                    </h5>
                    <small class="text-muted" id="chartSubtitle">Menampilkan jumlah kunjungan per jam (24 Jam Terakhir)</small>
                </div>

                {{-- Timeframe Filter Switcher --}}
                <div class="btn-group p-1 bg-light rounded-pill shadow-xs border" role="group" id="timeframeButtons">
                    <button type="button" class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold btn-success active" onclick="switchTimeframe('hourly')">
                        Per Jam
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold text-secondary" onclick="switchTimeframe('daily')">
                        Per Hari
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold text-secondary" onclick="switchTimeframe('weekly')">
                        Per Minggu
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold text-secondary" onclick="switchTimeframe('monthly')">
                        Per Bulan
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 py-1.5 fw-bold text-secondary" onclick="switchTimeframe('yearly')">
                        Per Tahun
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-3 p-md-4">
            <div style="position: relative; height: 320px; width: 100%;">
                <canvas id="mainVisitorChart"></canvas>
            </div>
        </div>
    </div>

    {{-- 2-COLUMN BREAKDOWN ROW (Devices & Traffic Sources) --}}
    <div class="row g-3 g-lg-4 mb-4">
        {{-- Device Breakdown --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm bg-white h-100">
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-phone text-success"></i> Perangkat Pengunjung (*Device*)
                    </h6>
                    <span class="badge bg-light text-muted fw-normal">Mobile vs Desktop</span>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 text-center mb-3 mb-sm-0">
                            <div style="position: relative; height: 200px; width: 100%;">
                                <canvas id="deviceChart"></canvas>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <ul class="list-group list-group-flush border-0">
                                @php
                                    $totalDevice = array_sum($deviceBreakdown) ?: 1;
                                @endphp
                                @foreach($deviceBreakdown as $dev => $count)
                                    @php
                                        $pct = round(($count / $totalDevice) * 100, 1);
                                        $icon = match(strtolower($dev)) {
                                            'mobile' => 'bi-phone text-success',
                                            'desktop' => 'bi-laptop text-primary',
                                            'tablet' => 'bi-tablet text-warning',
                                            default => 'bi-display text-secondary'
                                        };
                                    @endphp
                                    <li class="list-group-item px-0 py-2.5 d-flex align-items-center justify-content-between border-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi {{ $icon }} fs-5"></i>
                                            <div>
                                                <div class="fw-semibold small text-dark">{{ $dev }}</div>
                                                <small class="text-muted">{{ number_format($count) }} hits</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-light text-dark fw-bold border px-2.5 py-1">{{ $pct }}%</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Traffic Sources --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm bg-white h-100">
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-signpost-split text-success"></i> Sumber Kunjungan (*Traffic Source*)
                    </h6>
                    <span class="badge bg-light text-muted fw-normal">Dari Mana Saja</span>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 text-center mb-3 mb-sm-0">
                            <div style="position: relative; height: 200px; width: 100%;">
                                <canvas id="sourceChart"></canvas>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <ul class="list-group list-group-flush border-0">
                                @php
                                    $totalSource = array_sum($sourceBreakdown) ?: 1;
                                @endphp
                                @foreach($sourceBreakdown as $src => $count)
                                    @php
                                        $pct = round(($count / $totalSource) * 100, 1);
                                    @endphp
                                    <li class="list-group-item px-0 py-2 d-flex align-items-center justify-content-between border-0">
                                        <div class="d-flex align-items-center gap-2 text-truncate pe-2">
                                            <span class="badge rounded-circle p-1 bg-success" style="width: 8px; height: 8px;"></span>
                                            <span class="small fw-semibold text-dark text-truncate">{{ $src }}</span>
                                        </div>
                                        <span class="badge bg-success-subtle text-success fw-bold px-2 py-1">{{ $pct }}%</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2-COLUMN TECHNICAL ROW (OS/Browser & Top Geographic Locations) --}}
    <div class="row g-3 g-lg-4 mb-4">
        {{-- OS & Browser Specs --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm bg-white h-100">
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-cpu text-success"></i> Sistem Operasi & Browser
                    </h6>
                    <span class="badge bg-light text-muted fw-normal">Spesifikasi</span>
                </div>
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-3" style="font-size: 0.7rem; letter-spacing: 0.5px;">Sistem Operasi (OS):</h6>
                    <div class="mb-4">
                        @php
                            $totalOS = array_sum($osBreakdown) ?: 1;
                        @endphp
                        @foreach($osBreakdown as $os => $count)
                            @php
                                $pct = round(($count / $totalOS) * 100, 1);
                            @endphp
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small fw-semibold mb-1">
                                    <span>{{ $os }}</span>
                                    <span class="text-muted">{{ number_format($count) }} ({{ $pct }}%)</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h6 class="text-muted small fw-bold text-uppercase mb-3" style="font-size: 0.7rem; letter-spacing: 0.5px;">Browser Populer:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($browserBreakdown as $browser => $count)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-2 d-flex align-items-center gap-1.5 shadow-xs">
                                <i class="bi bi-browser-chrome text-success"></i>
                                <span>{{ $browser }}</span>
                                <strong class="text-success ms-1">{{ number_format($count) }}</strong>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Geographic Locations (Cities) --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm bg-white h-100">
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-danger"></i> Asal Wilayah / Kota Pengunjung
                    </h6>
                    <span class="badge bg-light text-muted fw-normal">Geografis</span>
                </div>
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        @php
                            $maxCity = $topCities->max('total') ?: 1;
                        @endphp
                        @foreach($topCities as $index => $c)
                            @php
                                $pct = round(($c->total / $totalPageViews) * 100, 1);
                                $barWidth = round(($c->total / $maxCity) * 100);
                            @endphp
                            <div class="py-2.5 border-bottom border-light">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-secondary rounded-circle px-2 py-1 font-monospace" style="font-size: 0.75rem;">#{{ $index + 1 }}</span>
                                        <span class="fw-bold text-dark small">{{ $c->city }}</span>
                                        <span class="text-muted" style="font-size: 0.72rem;">&bull; Indonesia</span>
                                    </div>
                                    <div class="text-end">
                                        <strong class="text-success small">{{ number_format($c->total) }}</strong>
                                        <span class="text-muted small" style="font-size: 0.72rem;">({{ $pct }}%)</span>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-success-subtle bg-success" role="progressbar" style="width: {{ $barWidth }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TOP VISITED PAGES TABLE --}}
    <div class="card border-0 rounded-4 shadow-sm bg-white mb-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-bar-graph text-success"></i> Halaman Paling Sering Dikunjungi (*Top Pages*)
            </h6>
            <span class="badge bg-success rounded-pill px-3 py-1 fw-bold">Paling Populer</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3" width="8%">Peringkat</th>
                            <th class="px-4 py-3" width="42%">Nama Halaman</th>
                            <th class="px-4 py-3" width="25%">URL Path</th>
                            <th class="px-4 py-3 text-end" width="25%">Total Kunjungan (Hits)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topPages as $idx => $p)
                            @php
                                $pct = round(($p->total / ($totalPageViews ?: 1)) * 100, 1);
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-center">
                                    @if($idx == 0)
                                        <span class="badge bg-warning text-dark rounded-circle p-2">🥇</span>
                                    @elseif($idx == 1)
                                        <span class="badge bg-secondary text-white rounded-circle p-2">🥈</span>
                                    @elseif($idx == 2)
                                        <span class="badge bg-danger text-white rounded-circle p-2">🥉</span>
                                    @else
                                        <span class="badge bg-light text-secondary border rounded-circle p-2 font-monospace">{{ $idx + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark">{{ $p->page_name }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-light text-secondary border font-monospace px-2.5 py-1.5">{{ $p->path }}</span>
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <span class="fw-bold text-success fs-6">{{ number_format($p->total) }}</span>
                                    <span class="text-muted small ms-1">({{ $pct }}%)</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data kunjungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- QUICK ACTION SHORTCUTS SECTION --}}
    <div class="d-flex align-items-center justify-content-between mb-3 pt-2">
        <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-grid-fill text-success"></i> Menu Akses Cepat Administrasi
        </h5>
    </div>

    <div class="row g-3 g-lg-4">
        {{-- Jadwal Dokter --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-3.5 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-3 p-2.5 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-calendar2-week-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Jadwal Dokter</h6>
                        <small class="text-muted">Praktik spesialis</small>
                    </div>
                </div>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-sm btn-success rounded-3 mt-2 w-100 fw-semibold">
                    Kelola Jadwal &rarr;
                </a>
            </div>
        </div>

        {{-- Dokumen PPID --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-3.5 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-3 p-2.5 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-file-earmark-lock2-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Dokumen PPID</h6>
                        <small class="text-muted">Regulasi & SOP</small>
                    </div>
                </div>
                <a href="{{ route('admin.documents.index') }}" class="btn btn-sm btn-success rounded-3 mt-2 w-100 fw-semibold">
                    Kelola Dokumen &rarr;
                </a>
            </div>
        </div>

        {{-- Permohonan Info --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-3.5 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-3 p-2.5 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-inbox-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Permohonan Info</h6>
                        <small class="text-muted">Pengajuan publik</small>
                    </div>
                </div>
                <a href="{{ route('admin.permohonan.index') }}" class="btn btn-sm btn-success rounded-3 mt-2 w-100 fw-semibold">
                    Tinjau Pesan &rarr;
                </a>
            </div>
        </div>

        {{-- Tarif RSDKT --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-3.5 bg-white transition-all hover-lift">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-3 p-2.5 text-success" style="background: rgba(25, 135, 84, 0.1);">
                        <i class="bi bi-tag-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Tarif & Obat</h6>
                        <small class="text-muted">Filter pencarian</small>
                    </div>
                </div>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-sm btn-outline-success rounded-3 mt-2 w-100 fw-semibold">
                    Katalog Tarif &rarr;
                </a>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT & CHART CONFIGURATION --}}
<script>
    // Data multi-periode dari Backend
    const analyticsData = {
        hourly: {
            labels: {!! json_encode($hourlyLabels) !!},
            data: {!! json_encode($hourlyData) !!},
            subtitle: "Menampilkan jumlah kunjungan per jam (24 Jam Terakhir)"
        },
        daily: {
            labels: {!! json_encode($dailyLabels) !!},
            data: {!! json_encode($dailyData) !!},
            subtitle: "Menampilkan tren kunjungan harian (30 Hari Terakhir)"
        },
        weekly: {
            labels: {!! json_encode($weeklyLabels) !!},
            data: {!! json_encode($weeklyData) !!},
            subtitle: "Menampilkan tren kunjungan mingguan (8 Minggu Terakhir)"
        },
        monthly: {
            labels: {!! json_encode($monthlyLabels) !!},
            data: {!! json_encode($monthlyData) !!},
            subtitle: "Menampilkan total kunjungan bulanan (12 Bulan / 1 Tahun)"
        },
        yearly: {
            labels: {!! json_encode($yearlyLabels) !!},
            data: {!! json_encode($yearlyData) !!},
            subtitle: "Menampilkan pertumbuhan kunjungan tahunan (5 Tahun Terakhir)"
        }
    };

    let mainChart = null;

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Inisialisasi Main Visitor Chart (Default: Hourly)
        const ctx = document.getElementById('mainVisitorChart').getContext('2d');
        
        // Gradient fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(25, 135, 84, 0.35)');
        gradient.addColorStop(1, 'rgba(25, 135, 84, 0.00)');

        mainChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: analyticsData.hourly.labels,
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: analyticsData.hourly.data,
                    borderColor: '#198754',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#198754',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 3.5,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 12, family: 'Plus Jakarta Sans', weight: 'bold' },
                        bodyFont: { size: 12, family: 'Plus Jakarta Sans' },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return context.parsed.y + ' Kunjungan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            color: '#64748b',
                            precision: 0
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            color: '#64748b',
                            maxRotation: 45
                        }
                    }
                }
            }
        });

        // 2. Inisialisasi Device Chart (Donut)
        const deviceCtx = document.getElementById('deviceChart').getContext('2d');
        new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($deviceBreakdown)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($deviceBreakdown)) !!},
                    backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#6c757d'],
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { cornerRadius: 8 }
                },
                cutout: '70%'
            }
        });

        // 3. Inisialisasi Traffic Source Chart (Donut/Pie)
        const sourceCtx = document.getElementById('sourceChart').getContext('2d');
        new Chart(sourceCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($sourceBreakdown)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($sourceBreakdown)) !!},
                    backgroundColor: ['#198754', '#20c997', '#0dcaf0', '#ffc107', '#fd7e14', '#6f42c1'],
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { cornerRadius: 8 }
                },
                cutout: '65%'
            }
        });
    });

    // Fungsi Pengubah Periode Waktu Grafik
    function switchTimeframe(period) {
        if (!mainChart || !analyticsData[period]) return;

        // Update dataset & labels
        mainChart.data.labels = analyticsData[period].labels;
        mainChart.data.datasets[0].data = analyticsData[period].data;
        mainChart.update();

        // Update Subtitle
        document.getElementById('chartSubtitle').innerText = analyticsData[period].subtitle;

        // Update Active Button Style
        const buttons = document.querySelectorAll('#timeframeButtons button');
        buttons.forEach(btn => {
            btn.classList.remove('btn-success', 'active', 'text-white');
            btn.classList.add('text-secondary');
        });

        const activeBtn = event.target;
        activeBtn.classList.remove('text-secondary');
        activeBtn.classList.add('btn-success', 'active', 'text-white');
    }
</script>
@endsection