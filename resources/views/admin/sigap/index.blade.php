@extends('layouts.admin')

@section('content')
<style>
    .sigap-stat-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .sigap-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
    }
    .sigap-stat-label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.35rem;
    }
    .sigap-stat-value {
        font-size: 1.85rem;
        font-weight: 800;
        line-height: 1.1;
        color: #1e293b;
    }
    .sigap-stat-sub {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.25rem;
    }
    .nav-pills-sigap .nav-link {
        color: #475569;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 10px 18px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .nav-pills-sigap .nav-link:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
    }
    .nav-pills-sigap .nav-link.active {
        background: #198754;
        border-color: #198754;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
    }
    .btn-touch {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .table-sigap thead th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
        padding: 12px 16px;
    }
    .table-sigap tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #edf2f7;
        font-size: 0.875rem;
    }
    .table-sigap tbody tr:hover {
        background-color: #f8fafc;
    }
    .mobile-data-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.1rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
</style>

<div class="container-fluid px-3 px-lg-4 py-3">
    
    {{-- Header Halaman Mandiri --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-semibold">
                    <i class="bi {{ $activeService['icon'] }} me-1"></i> Layanan {{ $activeService['title'] }}
                </span>
                <span class="text-muted small">Panel Administrasi Mandiri</span>
            </div>
            <h1 class="h3 fw-bold text-dark mb-0">Data Permohonan {{ $activeService['title'] }}</h1>
            <p class="text-muted small mb-0 mt-1">{{ $activeService['subtitle'] }} - RS Baladhika Husada Jember.</p>
        </div>
        <div class="d-flex align-items-center gap-2 w-100 w-md-auto">
            <a href="{{ request()->fullUrlWithQuery(['refresh' => 1]) }}" class="btn btn-outline-secondary btn-touch px-3 rounded-3 w-100 w-md-auto" title="Segarkan data dari Google Sheets">
                <i class="bi bi-arrow-clockwise me-1"></i> Segarkan Data
            </a>
            <a href="{{ route('monitor.portal') }}" target="_blank" class="btn btn-success btn-touch px-3 rounded-3 w-100 w-md-auto">
                <i class="bi bi-display me-1"></i> Layar Monitor
            </a>
        </div>
    </div>

    {{-- Pesan Peringatan Jika Terjadi Kendala Koneksi --}}
    @if(!empty($errorMessage))
        <div class="alert alert-warning alert-dismissible fade show rounded-3 mb-4 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>
                    <strong>Pemberitahuan:</strong> {{ $errorMessage }}
                    <div class="small mt-1">Silakan coba klik tombol <strong>"Segarkan Data"</strong> di atas.</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Pilihan Menu Halaman Layanan SIGAP (Navigasi Antar Halaman Sendiri-Sendiri) --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.sigap.siterbat') }}" class="nav-link {{ $activeServiceKey === 'siterbat' ? 'btn btn-success text-white' : 'btn btn-outline-secondary bg-white' }} px-3 py-2 rounded-3 fw-semibold">
            <i class="bi bi-bicycle me-1.5"></i> SITERBAT (Antar Obat)
        </a>
        <a href="{{ route('admin.sigap.ambulan') }}" class="nav-link {{ $activeServiceKey === 'ambulan' ? 'btn btn-success text-white' : 'btn btn-outline-secondary bg-white' }} px-3 py-2 rounded-3 fw-semibold">
            <i class="bi bi-truck me-1.5"></i> AMBULAN (Jemput Pasien)
        </a>
        <a href="{{ route('admin.sigap.santardekate') }}" class="nav-link {{ $activeServiceKey === 'santardekate' ? 'btn btn-success text-white' : 'btn btn-outline-secondary bg-white' }} px-3 py-2 rounded-3 fw-semibold">
            <i class="bi bi-basket3 me-1.5"></i> SANTAR DEKATE (Koperasi)
        </a>
    </div>

    {{-- Widget Ringkasan Angka di Bagian Atas Tabel (Bulan & Tahun) --}}
    <div class="row g-3 mb-4">
        {{-- Total Bulan Terpilih --}}
        <div class="col-12 col-md-4">
            <div class="sigap-stat-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="sigap-stat-label">Bulan {{ $filterMonth === 'semua' ? 'Semua Bulan' : ($monthNames[$filterMonth] ?? '') }}</div>
                        <div class="sigap-stat-value text-success">
                            {{ number_format($countSelectedMonth, 0, ',', '.') }}
                        </div>
                        <div class="sigap-stat-sub">
                            Permohonan {{ $activeService['title'] }} (Tahun {{ $filterYear }})
                        </div>
                    </div>
                    <div class="p-2.5 bg-success-subtle text-success rounded-3 fs-5">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Tahun Terpilih --}}
        <div class="col-12 col-md-4">
            <div class="sigap-stat-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="sigap-stat-label">Total Tahun {{ $filterYear }}</div>
                        <div class="sigap-stat-value text-primary">
                            {{ number_format($countSelectedYear, 0, ',', '.') }}
                        </div>
                        <div class="sigap-stat-sub">
                            Akumulasi sepanjang tahun {{ $filterYear }}
                        </div>
                    </div>
                    <div class="p-2.5 bg-primary-subtle text-primary rounded-3 fs-5">
                        <i class="bi bi-calendar3"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Seluruh Riwayat Layanan Ini --}}
        <div class="col-12 col-md-4">
            <div class="sigap-stat-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="sigap-stat-label">Seluruh Data Masuk</div>
                        <div class="sigap-stat-value text-dark">
                            {{ number_format($countTotal, 0, ',', '.') }}
                        </div>
                        <div class="sigap-stat-sub">
                            Total baris rekap Google Sheets {{ $activeService['title'] }}
                        </div>
                    </div>
                    <div class="p-2.5 bg-secondary-subtle text-secondary rounded-3 fs-5">
                        <i class="bi bi-database"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kotak Filter Bulan, Tahun, dan Pencarian --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" action="{{ route($activeService['route']) }}" class="row g-2 align-items-end">
                
                {{-- Filter Bulan --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <label class="form-label small fw-bold text-muted mb-1">
                        <i class="bi bi-calendar-event me-1"></i> Pilih Bulan
                    </label>
                    <select name="bulan" class="form-select btn-touch rounded-3">
                        <option value="semua" {{ $filterMonth === 'semua' ? 'selected' : '' }}>Semua Bulan</option>
                        @foreach($monthNames as $num => $name)
                            <option value="{{ $num }}" {{ $filterMonth === $num ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Tahun --}}
                <div class="col-12 col-sm-6 col-md-2">
                    <label class="form-label small fw-bold text-muted mb-1">
                        <i class="bi bi-calendar-range me-1"></i> Pilih Tahun
                    </label>
                    <select name="tahun" class="form-select btn-touch rounded-3">
                        @foreach($availableYears as $yr)
                            <option value="{{ $yr }}" {{ $filterYear === $yr ? 'selected' : '' }}>{{ $yr }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kotak Pencarian --}}
                <div class="col-12 col-sm-8 col-md-5">
                    <label class="form-label small fw-bold text-muted mb-1">
                        <i class="bi bi-search me-1"></i> Pencarian
                    </label>
                    <div class="input-group">
                        <input type="text" 
                               name="q" 
                               value="{{ $searchQuery }}" 
                               class="form-control btn-touch rounded-start-3" 
                               placeholder="Cari nama, no rm, alamat, no hp...">
                        @if(!empty($searchQuery))
                            <a href="{{ route($activeService['route'], ['bulan' => $filterMonth, 'tahun' => $filterYear]) }}" class="btn btn-outline-secondary d-flex align-items-center" title="Hapus pencarian">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Tombol Terapkan --}}
                <div class="col-12 col-sm-4 col-md-2 d-grid">
                    <button type="submit" class="btn btn-success btn-touch rounded-3 fw-semibold">
                        <i class="bi bi-funnel-fill me-1"></i> Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Keterangan Baris Aktif --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="h5 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="bi {{ $activeService['icon'] }} text-success"></i>
                Daftar Permohonan {{ $activeService['title'] }}
            </h2>
            <div class="text-muted small mt-0.5">
                Periode: <strong>{{ $filterMonth === 'semua' ? 'Semua Bulan' : ($monthNames[$filterMonth] ?? '') }} {{ $filterYear }}</strong>
                &bull; Total data tampil: <strong>{{ count($tableRows) }}</strong> baris
                @if(!empty($searchQuery))
                    &bull; Kata kunci: <em>"{{ $searchQuery }}"</em>
                @endif
            </div>
        </div>
        <div class="text-muted small">
            Urutan: <strong>Terbaru di atas</strong>
        </div>
    </div>

    {{-- Tampilan Desktop (Tabel Lengkap) --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-sigap mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th style="width: 140px;">Waktu Masuk</th>
                        @if($activeServiceKey === 'siterbat')
                            <th style="width: 110px;">No. RM</th>
                            <th>Nama Pasien</th>
                            <th style="width: 150px;">Kontak WhatsApp</th>
                            <th>Alamat Pengantaran</th>
                            <th>Keterangan / Obat</th>
                        @elseif($activeServiceKey === 'ambulan')
                            <th>Nama Pasien / Pemohon</th>
                            <th style="width: 150px;">Kontak WhatsApp</th>
                            <th>Lokasi Penjemputan</th>
                            <th>Detail Permohonan</th>
                            <th>Gejala / Kondisi Pasien</th>
                        @elseif($activeServiceKey === 'santardekate')
                            <th>Nama Pemesan</th>
                            <th style="width: 150px;">Kontak WhatsApp</th>
                            <th style="width: 180px;">Ruangan / Kamar Rawat</th>
                            <th>Daftar Pesanan Belanja</th>
                        @endif
                        <th style="width: 90px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tableRows as $idx => $row)
                        <tr>
                            <td class="text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                            
                            {{-- Tanggal & Jam --}}
                            <td>
                                <div class="fw-semibold text-dark">{{ $row['date_meta']['formatted'] ?? $row['tanggal_raw'] }}</div>
                                @if(!empty($row['jam_raw']) && $row['jam_raw'] !== '-')
                                    <div class="text-muted small"><i class="bi bi-clock me-1"></i>{{ $row['jam_raw'] }} WIB</div>
                                @endif
                            </td>

                            @if($activeServiceKey === 'siterbat')
                                {{-- No RM --}}
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                        {{ $row['no_rm'] ?? '-' }}
                                    </span>
                                </td>

                                {{-- Nama Pasien --}}
                                <td>
                                    <div class="fw-bold text-dark">{{ $row['nama'] }}</div>
                                </td>

                                {{-- No WA --}}
                                <td>
                                    @if(!empty($row['wa_number']))
                                        <a href="https://wa.me/{{ $row['wa_number'] }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>{{ $row['telepon'] }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted small">{{ $row['telepon'] ?? '-' }}</span>
                                    @endif
                                </td>

                                {{-- Alamat --}}
                                <td>
                                    <div class="text-wrap" style="max-width: 280px;">
                                        {{ $row['alamat'] ?? '-' }}
                                    </div>
                                </td>

                                {{-- Keterangan --}}
                                <td>
                                    <div class="text-wrap text-secondary" style="max-width: 250px;">
                                        {{ $row['detail'] ?? '-' }}
                                    </div>
                                </td>

                            @elseif($activeServiceKey === 'ambulan')
                                {{-- Nama Pemohon / Pasien --}}
                                <td>
                                    <div class="fw-bold text-dark">{{ $row['nama'] }}</div>
                                </td>

                                {{-- No WA --}}
                                <td>
                                    @if(!empty($row['wa_number']))
                                        <a href="https://wa.me/{{ $row['wa_number'] }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>{{ $row['telepon'] }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted small">{{ $row['telepon'] ?? '-' }}</span>
                                    @endif
                                </td>

                                {{-- Alamat Jemput --}}
                                <td>
                                    <div class="text-wrap" style="max-width: 260px;">
                                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $row['alamat'] ?? '-' }}
                                    </div>
                                </td>

                                {{-- Detail --}}
                                <td>
                                    <div class="text-wrap" style="max-width: 220px;">
                                        {{ $row['detail'] ?? '-' }}
                                    </div>
                                </td>

                                {{-- Gejala --}}
                                <td>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-2 text-wrap text-start">
                                        {{ $row['gejala'] ?? '-' }}
                                    </span>
                                </td>

                            @elseif($activeServiceKey === 'santardekate')
                                {{-- Nama Pemesan --}}
                                <td>
                                    <div class="fw-bold text-dark">{{ $row['nama'] }}</div>
                                </td>

                                {{-- No WA --}}
                                <td>
                                    @if(!empty($row['wa_number']))
                                        <a href="https://wa.me/{{ $row['wa_number'] }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2.5 py-1 d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>{{ $row['telepon'] }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted small">{{ $row['telepon'] ?? '-' }}</span>
                                    @endif
                                </td>

                                {{-- Ruangan --}}
                                <td>
                                    <span class="badge bg-warning-subtle text-dark border border-warning-subtle px-2.5 py-1.5 rounded-2">
                                        <i class="bi bi-door-open-fill text-warning me-1"></i>{{ $row['ruangan'] ?? '-' }}
                                    </span>
                                </td>

                                {{-- Pesanan / Belanja --}}
                                <td>
                                    <div class="text-wrap text-secondary" style="max-width: 320px;">
                                        {{ $row['belanja'] ?? '-' }}
                                    </div>
                                </td>
                            @endif

                            {{-- Tombol Aksi WhatsApp --}}
                            <td class="text-center">
                                @if(!empty($row['wa_number']))
                                    <a href="https://wa.me/{{ $row['wa_number'] }}" target="_blank" class="btn btn-sm btn-success rounded-circle p-2" title="Kirim Pesan WhatsApp">
                                        <i class="bi bi-chat-dots-fill"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-5 text-center text-muted">
                                <div class="py-4">
                                    <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                                    <h6 class="mt-3 fw-bold text-dark">Tidak Ada Data Permohonan</h6>
                                    <p class="small text-muted mb-3">Tidak ditemukan rekaman data pada periode bulan & tahun yang dipilih.</p>
                                    <a href="{{ route($activeService['route'], ['bulan' => 'semua', 'tahun' => $filterYear]) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        Tampilkan Semua Bulan Tahun {{ $filterYear }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tampilan Mobile (Daftar Kartu yang Responsif dan Nyaman disentuh) --}}
    <div class="d-md-none">
        @forelse($tableRows as $idx => $row)
            <div class="mobile-data-card">
                <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-2">
                    <div>
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-0.5 small me-1">#{{ $idx + 1 }}</span>
                        <strong class="text-dark">{{ $row['nama'] }}</strong>
                        @if($activeServiceKey === 'siterbat' && !empty($row['no_rm']))
                            <span class="badge bg-light text-dark border font-monospace ms-1">{{ $row['no_rm'] }}</span>
                        @endif
                    </div>
                    <span class="text-muted small text-end" style="font-size: 0.72rem;">
                        {{ $row['date_meta']['formatted'] ?? $row['tanggal_raw'] }}<br>
                        @if(!empty($row['jam_raw']) && $row['jam_raw'] !== '-')
                            {{ $row['jam_raw'] }} WIB
                        @endif
                    </span>
                </div>

                @if($activeServiceKey === 'siterbat')
                    <div class="small mb-1 text-muted">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                        <span class="text-dark">{{ $row['alamat'] ?? '-' }}</span>
                    </div>
                    <div class="small mb-2 p-2 bg-light rounded-2 text-secondary">
                        <strong>Obat/Catatan:</strong> {{ $row['detail'] ?? '-' }}
                    </div>
                @elseif($activeServiceKey === 'ambulan')
                    <div class="small mb-1 text-muted">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                        <span class="text-dark">{{ $row['alamat'] ?? '-' }}</span>
                    </div>
                    <div class="small mb-1 text-muted">
                        <strong>Detail:</strong> {{ $row['detail'] ?? '-' }}
                    </div>
                    <div class="small mb-2">
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                            Gejala: {{ $row['gejala'] ?? '-' }}
                        </span>
                    </div>
                @elseif($activeServiceKey === 'santardekate')
                    <div class="small mb-1">
                        <span class="badge bg-warning-subtle text-dark border border-warning-subtle px-2 py-1 mb-1">
                            <i class="bi bi-door-open-fill text-warning me-1"></i> {{ $row['ruangan'] ?? '-' }}
                        </span>
                    </div>
                    <div class="small mb-2 p-2 bg-light rounded-2 text-secondary">
                        <strong>Pesanan:</strong> {{ $row['belanja'] ?? '-' }}
                    </div>
                @endif

                <div class="pt-2 border-top d-flex gap-2">
                    @if(!empty($row['wa_number']))
                        <a href="https://wa.me/{{ $row['wa_number'] }}" target="_blank" class="btn btn-success btn-touch rounded-3 flex-grow-1 small fw-semibold">
                            <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
                        </a>
                    @endif
                    @if(!empty($row['telepon']) && $row['telepon'] !== '-')
                        <a href="tel:{{ $row['telepon'] }}" class="btn btn-outline-secondary btn-touch rounded-3 px-3">
                            <i class="bi bi-telephone-fill"></i>
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white rounded-4 border p-4">
                <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                <h6 class="mt-3 fw-bold text-dark">Tidak Ada Data Permohonan</h6>
                <p class="small text-muted mb-3">Tidak ditemukan rekaman data pada periode ini.</p>
                <a href="{{ route($activeService['route'], ['bulan' => 'semua', 'tahun' => $filterYear]) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    Tampilkan Semua Bulan
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
