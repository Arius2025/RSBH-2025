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
                <select class="form-select form-select-sm border-0 fw-bold text-success shadow-none" onchange="changeYear(this.value)" style="width: auto; cursor: pointer;">
                    <option value="2025" selected >2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>
        </div>
        <hr class="w-100 mb-5 border-success" style="border-width: 2px; opacity: 0.1;">

        <div class="row g-5">
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
                                <p class="small text-muted text-uppercase fw-bold">Total Pengiriman Tahun <span class="selectedYearText">2025</span></p>
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
                                <p class="small text-muted text-uppercase fw-bold">Total Jemputan Tahun <span class="selectedYearText">2025</span></p>
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
                                <p class="small text-muted text-uppercase fw-bold">Total Layanan Tahun <span class="selectedYearText">2025</span></p>
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
    const SHEETS_MAP = {
        2025: {
            siterbat: '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
            ambulance: '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
            santardekate: '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys'
        },
        2026: {
            siterbat: '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
            ambulance: '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
            santardekate: '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys'
        }
    };

    let currentYear = "2026";
    const _0xkey = "QUl6YVN5Q2NvMVVwWGJvejEteklad25HcFNGTmpWblpvYjVDXzQ0cw==";
    const API_KEY = atob(_0xkey);

    const MONTH_NAMES = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    async function fetchMonthlyData(spreadsheetId, sheetName) {
        try {
            const range = `${sheetName}!A2:A`;
            const url = `/api/dashboard/sheet-data?id=${spreadsheetId}&range=${encodeURIComponent(range)}`;
            console.log("Fetching via proxy:", url);
            const response = await fetch(url);
            const data = await response.json();
            
            if (data.error) {
                console.error("Sheets Proxy Error:", data.error);
                alert("Kesalahan Dashboard: " + data.error.message + ". Pastikan aplikasi memiliki akses ke Sheet.");
                return [];
            }

            // Initialize monthly counts
            let monthlyCounts = MONTH_NAMES.map(name => ({ label: name, count: 0 }));

            if (data.values) {
                console.log("Monthly Data Found:", data.values.length, "rows");
                data.values.forEach(row => {
                    if (row[0]) {
                        let date;
                        const dateStr = row[0].split(' ')[0]; // Take only date part
                        
                        // Try DD/MM/YYYY format
                        if (dateStr.includes('/')) {
                            const parts = dateStr.split('/');
                            if (parts.length === 3) {
                                // DD/MM/YYYY -> MM/DD/YYYY (for JS Date) or YYYY, MM-1, DD
                                if (parts[2].length === 4) { // Year is at the end
                                    date = new Date(parts[2], parts[1] - 1, parts[0]);
                                } else if (parts[0].length === 4) { // Year is at the beginning
                                    date = new Date(parts[0], parts[1] - 1, parts[2]);
                                }
                            }
                        }
                        
                        if (!date || isNaN(date)) {
                            date = new Date(dateStr);
                        }

                        if (date && !isNaN(date)) {
                            const monthIndex = date.getMonth();
                            const year = date.getFullYear();
                            if (year.toString() === currentYear) {
                                monthlyCounts[monthIndex].count++;
                            }
                        }
                    }
                });
            } else {
                console.warn("No values found in range");
            }
            return monthlyCounts;
        } catch (error) {
            console.error(`Error fetching monthly data:`, error);
            return [];
        }
    }

    async function fetchLegacySheetData(spreadsheetId, excludeSheets = []) {
        try {
            const url = `/api/dashboard/legacy-data?id=${spreadsheetId}`;
            const response = await fetch(url);
            const data = await response.json();
            if (data && data.error) {
                console.error("Legacy Proxy Error:", data.error);
                return [];
            }
            if (!Array.isArray(data)) return [];
            return data;
        } catch (error) { console.error(`Error fetching legacy data:`, error); return []; }
    }

    let charts = {};
    function renderChart(canvasId, totalElementId, type, color, label, data) {
        if(!data || data.length === 0) return;
        const ctx = document.getElementById(canvasId).getContext('2d');
        const labels = data.map(d => d.label);
        const counts = data.map(d => d.count);
        document.getElementById(totalElementId).innerText = counts.reduce((a, b) => a + b, 0).toLocaleString();
        
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
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }

    async function initDashboard() {
        // Fallback to 2025 if currentYear not found
        const sheets = SHEETS_MAP[currentYear] || SHEETS_MAP["2025"];
        if (!sheets) {
            console.error("No sheet mapping found for year:", currentYear);
            return;
        }
        
        // Siterbat & Ambulance now use the new single-sheet monthly logic
        const siterbatData = await fetchMonthlyData(sheets.siterbat, 'SITERBAT');
        renderChart('chartSiterbat', 'totalSiterbat', 'bar', '#198754', 'Siterbat', siterbatData);
        
        const ambulanceData = await fetchMonthlyData(sheets.ambulance, 'AMBULAN');
        renderChart('chartAmbulance', 'totalAmbulance', 'bar', '#dc3545', 'Ambulance', ambulanceData);
        
        // Santardekate now uses the same monthly data structure as Siterbat & Ambulance
        const santardekateData = await fetchMonthlyData(sheets.santardekate, 'SANTARDEKATE ');
        renderChart('chartSantardekate', 'totalSantardekate', 'bar', '#ffc107', 'Santardekate', santardekateData);
        
        document.querySelectorAll('.selectedYearText').forEach(el => el.innerText = currentYear);
    }

    function changeYear(year) {
        currentYear = year;
        initDashboard();
    }

    document.addEventListener('DOMContentLoaded', initDashboard);
</script>
@endsection
