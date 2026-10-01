@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .premium-container { font-family: 'Inter', sans-serif; background-color: #f8fafc; padding-top: 3rem; padding-bottom: 5rem; }
    .luxury-shadow { box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02); }
    .luxury-hover { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    .luxury-hover:hover { transform: translateY(-5px); box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08), 0 4px 10px rgba(15, 23, 42, 0.03); }
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 28px; }
</style>

<div class="container premium-container py-4">
    <div class="mt-2 mb-5" data-aos="fade-up">
        <div class="text-center mb-5 d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-start">
                <h2 class="fw-bold text-success display-6 mb-0">Dashboard Indikator Layanan</h2>
                <p class="text-muted fs-5">Statistik performa layanan bulanan berdasarkan rekapan data sistem.</p>
            </div>
            <div class="d-flex align-items-center bg-white luxury-shadow px-4 py-2 rounded-pill border">
                <label class="small fw-bold text-uppercase text-muted me-3 mb-0">Filter Tahun:</label>
                <select id="yearSelect" class="form-select form-select-sm border-0 fw-bold text-success shadow-none" onchange="changeYear(this.value)" style="width: auto; cursor: pointer;">
                    @php $thisYear = (int) date('Y'); @endphp
                    @for($y = 2024; $y <= max($thisYear + 4, 2030); $y++)
                        <option value="{{ $y }}" {{ $y == $thisYear ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <hr class="w-100 mb-5 border-success" style="border-width: 2px; opacity: 0.1;">

        <div class="row g-5">
{{-- 0. Grafik FUP Kopi - HIDDEN FOR NOW
 
            <div class="col-12">
                <div class="glass-card border-0 luxury-shadow luxury-hover p-4 p-md-5 bg-white" style="border-left: 8px solid #4e21f1ff !important;">
                    <div class="row align-items-center flex-md-row-reverse">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start ps-md-4">
                            <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3">
                                <i class="bi bi-phone-fill text-primary fs-1"></i>
                            </div>
                            <h3 class="fw-bold text-primary">Indikator FUP Kopi</h3>
                            <p class="text-muted">Follow Up Pasien Kemoterapi</p>
                            <div class="mt-4">
                                <h2 class="display-5 fw-bold text-dark" id="totalFupKopi">0</h2>
                                <p class="small text-muted text-uppercase fw-bold">Total Pasien Tahun <span class="selectedYearText">2025</span></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="height: 350px;">
                                <canvas id="chartFupKopi"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
--}}

        
            {{-- 1. Grafik Siterbat --}}
            <div class="col-12">
                <div class="glass-card border-0 luxury-shadow luxury-hover p-4 p-md-5 bg-white" style="border-left: 8px solid #198754 !important;">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start">
                            <div class="d-inline-block bg-success bg-opacity-10 p-3 rounded-circle mb-3">
                                <i class="bi bi-bicycle text-success fs-1"></i>
                            </div>
                            <h3 class="fw-bold text-success">Indikator Siterbat</h3>
                            <p class="text-muted">Data performa pengiriman obat ke rumah pasien (Geriatri & Purnawirawan).</p>
                            <div class="mt-4">
                                <h2 class="display-5 fw-bold text-dark" id="totalSiterbat">0</h2>
                                <p class="small text-muted text-uppercase fw-bold">Total Pengiriman Tahun <span class="selectedYearText">{{ date('Y') }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="height: 350px;">
                                <canvas id="chartSiterbat"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Grafik Ambulance --}}
            <div class="col-12">
                <div class="glass-card border-0 luxury-shadow luxury-hover p-4 p-md-5 bg-white" style="border-left: 8px solid #dc3545 !important;">
                    <div class="row align-items-center flex-md-row-reverse">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start ps-md-4">
                            <div class="d-inline-block bg-danger bg-opacity-10 p-3 rounded-circle mb-3">
                                <i class="bi bi-truck text-danger fs-1"></i>
                            </div>
                            <h3 class="fw-bold text-danger">Indikator Ambulance</h3>
                            <p class="text-muted">Data registrasi dan layanan jemput gratis pasien.</p>
                            <div class="mt-4">
                                <h2 class="display-5 fw-bold text-dark" id="totalAmbulance">0</h2>
                                <p class="small text-muted text-uppercase fw-bold">Total Jemputan Tahun <span class="selectedYearText">{{ date('Y') }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="height: 350px;">
                                <canvas id="chartAmbulance"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Grafik Santardekate --}}
            <div class="col-12">
                <div class="glass-card border-0 luxury-shadow luxury-hover p-4 p-md-5 bg-white" style="border-left: 8px solid #ffc107 !important;">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start">
                            <div class="d-inline-block bg-warning bg-opacity-10 p-3 rounded-circle mb-3">
                                <i class="bi bi-house-heart text-warning fs-1"></i>
                            </div>
                            <h3 class="fw-bold text-warning">Indikator Santardekate</h3>
                            <p class="text-muted">Data pelayanan Santardekate (Pelayanan antar pesanan pasien dari koperasi rumah sakit).</p>
                            <div class="mt-4">
                                <h2 class="display-5 fw-bold text-dark" id="totalSantardekate">0</h2>
                                <p class="small text-muted text-uppercase fw-bold">Total Layanan Tahun <span class="selectedYearText">{{ date('Y') }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="height: 350px;">
                                <canvas id="chartSantardekate"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ID Sheet tetap untuk masing-masing layanan (tidak dibedakan per tahun)
    const SERVICES = {
        siterbat: {
            id: '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
            sheet: 'SITERBAT',
            chartId: 'chartSiterbat',
            totalId: 'totalSiterbat',
            type: 'bar',
            color: '#198754',
            label: 'Siterbat'
        },
        ambulance: {
            id: '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
            sheet: 'AMBULAN',
            chartId: 'chartAmbulance',
            totalId: 'totalAmbulance',
            type: 'bar',
            color: '#dc3545',
            label: 'Ambulance'
        },
        santardekate: {
            id: '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys',
            sheet: 'SANTARDEKATE ',
            chartId: 'chartSantardekate',
            totalId: 'totalSantardekate',
            type: 'bar',
            color: '#ffc107',
            label: 'Santardekate'
        }
    };

    let currentYear = "{{ date('Y') }}";
    const rawDataCache = {};
    const charts = {};
    const MONTH_NAMES = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    // Parser tanggal fleksibel (DD/MM/YYYY, YYYY-MM-DD, dsb.)
    function extractDate(rowVal) {
        if (!rowVal) return null;
        const dateStr = String(rowVal).trim().split(' ')[0];
        
        if (dateStr.includes('/')) {
            const parts = dateStr.split('/');
            if (parts.length === 3) {
                if (parts[2].length === 4) {
                    return new Date(parseInt(parts[2]), parseInt(parts[1]) - 1, parseInt(parts[0]));
                } else if (parts[0].length === 4) {
                    return new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
                }
            }
        }
        
        if (dateStr.includes('-')) {
            const parts = dateStr.split('-');
            if (parts.length === 3) {
                if (parts[0].length === 4) {
                    return new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
                } else if (parts[2].length === 4) {
                    return new Date(parseInt(parts[2]), parseInt(parts[1]) - 1, parseInt(parts[0]));
                }
            }
        }

        const d = new Date(dateStr);
        return isNaN(d.getTime()) ? null : d;
    }

    // Ambil data baris mentah dari sheet per layanan (disimpan di cache memory)
    async function fetchServiceRawRows(serviceKey) {
        if (rawDataCache[serviceKey]) {
            return rawDataCache[serviceKey];
        }

        const service = SERVICES[serviceKey];
        try {
            const range = `${service.sheet}!A2:A`;
            const url = `/api/dashboard/sheet-data?id=${service.id}&range=${encodeURIComponent(range)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.error) {
                console.error(`Error sheet ${serviceKey}:`, data.error);
                rawDataCache[serviceKey] = [];
                return [];
            }

            rawDataCache[serviceKey] = Array.isArray(data.values) ? data.values : [];
            return rawDataCache[serviceKey];
        } catch (err) {
            console.error(`Fetch error ${serviceKey}:`, err);
            rawDataCache[serviceKey] = [];
            return [];
        }
    }

    // Render chart Chart.js
    function renderChart(canvasId, totalElementId, type, color, label, data) {
        if (!data || data.length === 0) return;
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const labels = data.map(d => d.label);
        const counts = data.map(d => d.count);
        const total = counts.reduce((a, b) => a + b, 0);

        const totalEl = document.getElementById(totalElementId);
        if (totalEl) totalEl.innerText = total.toLocaleString();
        
        if (charts[canvasId]) charts[canvasId].destroy();
        charts[canvasId] = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: counts,
                    backgroundColor: type === 'bar' ? color : color + '33',
                    borderColor: color,
                    borderWidth: 2,
                    fill: type === 'line',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    }

    // Terapkan filter tahun ke semua grafik secara instan
    function applyYearFilter(year) {
        currentYear = year.toString();
        document.querySelectorAll('.selectedYearText').forEach(el => el.innerText = currentYear);

        for (const [key, service] of Object.entries(SERVICES)) {
            const rawRows = rawDataCache[key] || [];
            let monthlyCounts = MONTH_NAMES.map(name => ({ label: name, count: 0 }));

            rawRows.forEach(row => {
                if (row && row[0]) {
                    const date = extractDate(row[0]);
                    if (date && date.getFullYear().toString() === currentYear) {
                        monthlyCounts[date.getMonth()].count++;
                    }
                }
            });

            renderChart(service.chartId, service.totalId, service.type, service.color, service.label, monthlyCounts);
        }
    }

    // Update opsi dropdown tahun jika ditemukan tahun tambahan di spreadsheet
    function syncYearDropdownOptions() {
        const detectedYears = new Set([2024, 2025, 2026, 2027, 2028, 2029, 2030]);

        for (const rows of Object.values(rawDataCache)) {
            rows.forEach(row => {
                if (row && row[0]) {
                    const d = extractDate(row[0]);
                    if (d) {
                        const y = d.getFullYear();
                        if (y >= 2020 && y <= 2040) {
                            detectedYears.add(y);
                        }
                    }
                }
            });
        }

        const sorted = Array.from(detectedYears).sort((a, b) => a - b);
        const yearSelect = document.getElementById('yearSelect');
        if (yearSelect) {
            yearSelect.innerHTML = '';
            sorted.forEach(y => {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                if (y.toString() === currentYear.toString()) {
                    opt.selected = true;
                }
                yearSelect.appendChild(opt);
            });
        }
    }

    // Init Dashboard
    async function initDashboard() {
        const yearSelect = document.getElementById('yearSelect');
        if (yearSelect && yearSelect.value) {
            currentYear = yearSelect.value;
        }

        // Ambil data dari masing-masing spreadsheet layanan
        await Promise.all([
            fetchServiceRawRows('siterbat'),
            fetchServiceRawRows('ambulance'),
            fetchServiceRawRows('santardekate')
        ]);

        // Sinkronkan tahun pada dropdown dan render grafik
        syncYearDropdownOptions();
        applyYearFilter(currentYear);
    }

    function changeYear(year) {
        applyYearFilter(year);
    }

    document.addEventListener('DOMContentLoaded', initDashboard);
</script>
@endsection
