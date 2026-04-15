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
            siterbat: '1FH1TNMgsq2AyGULupMaGucbQ5vQ-mWCvtHh5iCGhDKg',
            ambulance: '1y43wfA8FGsMp8-jxm0NNF-QSKw5PdMJZlAZr1h5pcBg',
            santardekate: '1j3TCQp_klvX60SPQPglb-whTkfLhI4xjr2M7OTWGIS8'
        },
        2026: {
            siterbat: '1FH1TNMgsq2AyGULupMaGucbQ5vQ-mWCvtHh5iCGhDKg',
            ambulance: '1y43wfA8FGsMp8-jxm0NNF-QSKw5PdMJZlAZr1h5pcBg',
            santardekate: '1j3TCQp_klvX60SPQPglb-whTkfLhI4xjr2M7OTWGIS8'
        }
    };

    let currentYear = "2025";
    const _0xkey = "QUl6YVN5QXMyWVJQUXhOcjRESmo4LW1XQ2VLUERQT244VGoxcnJn";
    const API_KEY = atob(_0xkey);

    async function fetchSpreadsheetData(spreadsheetId, excludeSheets = [], checkRange = '!A2:A', colIndex = 0) {
        try {
            const metadataUrl = `https://sheets.googleapis.com/v4/spreadsheets/${spreadsheetId}?key=${API_KEY}`;
            const metadataResponse = await fetch(metadataUrl);
            const metadata = await metadataResponse.json();
            if (!metadata.sheets) return [];
            const sheets = metadata.sheets.map(s => s.properties.title).filter(name => !excludeSheets.includes(name));
            if(sheets.length === 0) return [];
            const ranges = sheets.map(name => encodeURIComponent(name) + checkRange);
            const valuesUrl = `https://sheets.googleapis.com/v4/spreadsheets/${spreadsheetId}/values:batchGet?ranges=${ranges.join('&ranges=')}&key=${API_KEY}`;
            const valuesResponse = await fetch(valuesUrl);
            const data = await valuesResponse.json();
            if (!data.valueRanges) return [];
            return data.valueRanges.map((vr, index) => {
                let count = 0;
                if(vr.values) {
                    count = vr.values.filter(row => row.length > colIndex && row[colIndex] !== '' && !isNaN(row[colIndex]) ).length; 
                }
                let cleanLabel = sheets[index].replace(/\s*\(\d+\)\s*/g, '');
                return { label: cleanLabel, count: count };
            });
        } catch (error) { console.error(`Error fetching data:`, error); return []; }
    }

    let charts = {};
    function renderChart(canvasId, totalElementId, type, color, label, data) {
        if(data.length === 0) return;
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
        const sheets = SHEETS_MAP[currentYear];
        const siterbatData = await fetchSpreadsheetData(sheets.siterbat, ['SIMRS', 'Sheet18', 'Sheet1']);
        renderChart('chartSiterbat', 'totalSiterbat', 'bar', '#198754', 'Siterbat', siterbatData);
        const ambulanceData = await fetchSpreadsheetData(sheets.ambulance, [], '!A2:B', 1);
        renderChart('chartAmbulance', 'totalAmbulance', 'bar', '#dc3545', 'Ambulance', ambulanceData);
        const santardekateData = await fetchSpreadsheetData(sheets.santardekate, []);
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
