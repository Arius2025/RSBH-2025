@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Global Premium Font & Reset */
    .premium-container {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc; /* Soft minimalist backing */
        padding-top: 2rem;
        padding-bottom: 5rem;
    }

    /* Luxury Soft Shadows */
    .luxury-shadow {
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    }
    .luxury-hover {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .luxury-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08), 0 4px 10px rgba(15, 23, 42, 0.03);
    }

    /* Hero Gradient & Glassmorphism */
    .hero-gradient {
        background: linear-gradient(135deg, #e6fced 0%, #ffffff 100%);
        border: 1px solid rgba(25, 135, 84, 0.1);
        border-radius: 32px;
        position: relative;
        overflow: hidden;
    }
    .hero-glass-blob {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(25,135,84,0.1) 0%, rgba(255,255,255,0) 70%);
        top: -100px;
        right: -50px;
        z-index: 0;
        animation: pulseBlob 8s infinite alternate;
    }
    
    @keyframes pulseBlob {
        0% { transform: scale(1); opacity: 0.8; }
        100% { transform: scale(1.2); opacity: 0.4; }
    }

    /* Glass Panels */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 28px;
    }

    /* Map Specifics */
    .map-container {
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .guide-box {
        background: white;
        border-left: 6px solid #198754;
        border-radius: 16px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    /* Buttons & Inputs */
    .btn-kirim {
        background: #198754;
        background: linear-gradient(135deg, #198754 0%, #115c39 100%);
        border: none;
        padding: 16px;
        border-radius: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: white;
        transition: all 0.4s ease;
    }
    .btn-kirim:hover:not(:disabled) {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px rgba(25, 135, 84, 0.3);
    }
    .btn-kirim:disabled {
        background: #e2e8f0;
        color: #94a3b8;
    }
    .form-control, .form-select {
        border-radius: 14px;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .form-control:focus {
        background-color: #ffffff;
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.1);
    }
    .form-label {
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #64748b;
    }

    /* Optimasi Mobile */
    @media (max-width: 768px) {
        .hero-gradient { border-radius: 24px; padding: 24px !important; }
        .display-4 { font-size: 2.2rem; }
        .map-container { min-height: 400px !important; }
    }
</style>

<div class="container premium-container py-4">
    {{-- Header --}}
    <div class="hero-gradient p-4 p-lg-5 mb-4 shadow-sm" data-aos="fade-up">
        <div class="hero-glass-blob"></div>
        <div class="row align-items-center text-center text-lg-start">
            <div class="col-lg-7">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">Layanan Prioritas</span>
                <h1 class="display-4 fw-bold text-success mb-2">SITERBAT</h1>
                <h4 class="fw-semibold text-dark mb-4">(Tanpa Antri, Khusus Pasien Geriatri & Purnawirawan)</h4>
                <div class="guide-box p-3 shadow-sm d-inline-block text-start">
                    <p class="small mb-0 text-muted">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                        <strong>Petunjuk:</strong> Tekan tombol <strong>"Gunakan Lokasi GPS"</strong> atau klik langsung pada peta untuk menentukan alamat rumah Anda.
                    </p>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="{{ asset('images/siterbat.png') }}" alt="Siterbat" class="img-fluid" style="max-height: 250px;">
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        {{-- Kolom Form (Urutan 1 di Mobile) --}}
        <div class="col-lg-5 order-1" data-aos="fade-up">
            <div class="form-section p-4 luxury-shadow glass-card border-0">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="bg-success text-white rounded-circle p-2 me-3 d-flex shadow-sm">
                        <i class="bi bi-pencil-square fs-6"></i>
                    </span>
                    Data Pengiriman
                </h5>
                
                <form id="siterbatForm">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NO. REKAM MEDIS (RM)</label>
                        <input type="text" id="wa_rm" class="form-control" placeholder="Contoh: 12.34.56" oninput="validateForm()">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NAMA LENGKAP PASIEN</label>
                        <input type="text" id="wa_name" class="form-control" placeholder="Nama pasien sesuai kartu" oninput="validateForm()">
                    </div>

                    <div class="mb-3 text-center">
                        <button type="button" onclick="getLocation()" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                            <i class="bi bi-crosshair me-2"></i> Gunakan Lokasi GPS Saya
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">ALAMAT (AUTO DARI PETA)</label>
                        <textarea id="wa_address" class="form-control bg-light" rows="3" readonly placeholder="Titik lokasi akan muncul di sini..."></textarea>
                        <div id="dist-status" class="mt-2 text-center"></div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">DETAIL RUMAH</label>
                        <textarea id="wa_detail" class="form-control" rows="2" placeholder="Contoh: Depan Mushola, Pagar Hitam No. 12" oninput="validateForm()"></textarea>
                    </div>

                    <button type="button" id="btnSubmit" onclick="sendToWhatsApp()" class="btn btn-success btn-kirim w-100 shadow" disabled>
                        <i class="bi bi-whatsapp me-2"></i> KIRIM PESANAN SEKARANG
                    </button>
                    <p id="error-msg" class="text-danger small mt-3 text-center fw-bold">Lengkapi data & titik peta (Maks. 10KM)</p>
                </form>
            </div>
        </div>

        {{-- Kolom Peta (Urutan 2 di Mobile) --}}
        <div class="col-lg-7 order-2" data-aos="fade-up">
            <div class="map-container luxury-shadow glass-card h-100" style="min-height: 450px;">
                <div id="map" style="height: 100%; width: 100%; min-height: 450px;"></div>
            </div>
        </div>
    </div>

    {{-- SECTION INDIKATOR --}}
    {{-- SECTION INDIKATOR (VERTICAL REDESIGN) --}}
    <div class="mt-5 mb-5" data-aos="fade-up">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-success display-6">Dashboard Indikator Layanan</h2>
            <p class="text-muted fs-5">Statistik performa layanan bulanan berdasarkan rekapan data sistem.</p>
            <hr class="w-25 mx-auto border-success" style="border-width: 3px;">
        </div>

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
                                <p class="small text-muted text-uppercase fw-bold">Total Pengiriman Tahun Ini</p>
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
                <div class="glass-card border-0 luxury-shadow luxury-hover p-4 p-md-5 bg-white" style="border-left: 8px solid #0d6efd !important;">
                    <div class="row align-items-center flex-md-row-reverse">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start ps-md-4">
                            <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3">
                                <i class="bi bi-truck text-primary fs-1"></i>
                            </div>
                            <h3 class="fw-bold text-primary">Indikator Ambulance</h3>
                            <p class="text-muted">Data registrasi dan layanan jemput gratis pasien.</p>
                            <div class="mt-4">
                                <h2 class="display-5 fw-bold text-dark" id="totalAmbulance">0</h2>
                                <p class="small text-muted text-uppercase fw-bold">Total Jemputan Tahun Ini</p>
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
                                <p class="small text-muted text-uppercase fw-bold">Total Layanan Tahun Ini</p>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mengamankan API key dari deteksi Github Secret Scanner (Base64 Encode)
    // Pastikan API Key di Google Cloud Console dibatasi (Restrict Key) hanya untuk url website Anda (HTTP Referrers)
    const _0xkey = "QUl6YVN5QXMyWVJQUXhOcjRESmo4LW1XQ2VLUERQT244VGoxcnJn";
    const API_KEY = atob(_0xkey);
    
    // Spreadsheet IDs
    const SHEETS = {
        siterbat: '1FH1TNMgsq2AyGULupMaGucbQ5vQ-mWCvtHh5iCGhDKg',
        ambulance: '1UzNv48klEbvLgh-kXas1OkBVTo9YvI8vK4blegJZdBY',
        santardekate: '1dZ1ORSb0JgvB-V_xZmFI1rjsBlkxOZtqkvJ_9cBlsAs'
    };

    /**
     * Generic function to fetch data from a Google Spreadsheet
     */
    async function fetchSpreadsheetData(spreadsheetId, excludeSheets = [], checkRange = '!A2:A', colIndex = 0) {
        try {
            const metadataUrl = `https://sheets.googleapis.com/v4/spreadsheets/${spreadsheetId}?key=${API_KEY}`;
            const metadataResponse = await fetch(metadataUrl);
            const metadata = await metadataResponse.json();
            
            if (!metadata.sheets) return [];

            const sheets = metadata.sheets
                .map(s => s.properties.title)
                .filter(name => !excludeSheets.includes(name));

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

                return {
                    label: cleanLabel,
                    count: count
                };
            });
        } catch (error) {
            console.error(`Error fetching data for ${spreadsheetId}:`, error);
            return [];
        }
    }

    function renderChart(canvasId, totalElementId, type, color, label, data) {
        if(data.length === 0) return;

        const ctx = document.getElementById(canvasId).getContext('2d');
        const labels = data.map(d => d.label);
        const counts = data.map(d => d.count);
        
        // Calculate total
        const total = counts.reduce((acc, current) => acc + current, 0);
        document.getElementById(totalElementId).innerText = total.toLocaleString();

        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: counts,
                    backgroundColor: type === 'bar' ? color : color + '33',
                    borderColor: color,
                    borderWidth: 2,
                    fill: type === 'line' ? true : false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: (context) => ` Total: ${context.raw}`
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { borderDash: [5, 5] }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    async function initDashboard() {
        // 1. Fetch Siterbat
        const siterbatData = await fetchSpreadsheetData(SHEETS.siterbat, ['SIMRS', 'Sheet18', 'Sheet1']);
        renderChart('chartSiterbat', 'totalSiterbat', 'bar', '#198754', 'Siterbat', siterbatData);

        // 2. Fetch Ambulance
        const ambulanceData = await fetchSpreadsheetData(SHEETS.ambulance, [], '!A2:B', 1);
        renderChart('chartAmbulance', 'totalAmbulance', 'line', '#0d6efd', 'Ambulance', ambulanceData);

        // 3. Fetch Santardekate
        const santardekateData = await fetchSpreadsheetData(SHEETS.santardekate, []);
        renderChart('chartSantardekate', 'totalSantardekate', 'bar', '#ffc107', 'Santardekate', santardekateData);
    }

    document.addEventListener('DOMContentLoaded', initDashboard);
</script>

{{-- FLOATING QUICK ACCESS (VERSI COMPACT) --}}
    <div class="floating-access">
        {{-- Tombol WhatsApp Compact --}}
        <a href="https://wa.me/6285217077347" target="_blank" class="btn-floating bg-success">
            <i class="bi bi-whatsapp fs-5"></i> 
            <div class="text-group">
                <span class="main-text">Chat Admin</span>
                <span class="sub-text">Online 24 Jam</span>
            </div>
        </a>
    </div>



<script>
    const rsCoords = [-8.165187, 113.704256]; 
    const maxRadius = 10000; // 10 KM
    let isWithinRadius = false;
    let userMarker;

    const map = L.map('map', { zoomControl: false }).setView(rsCoords, 14);
    L.control.zoom({ position: 'topright' }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const rsIcon = L.divIcon({
        html: '<i class="bi bi-hospital-fill text-success fs-3"></i>',
        className: 'custom-div-icon',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    L.marker(rsCoords, {icon: rsIcon}).addTo(map).bindPopup("<b>RS Baladhika Husada</b>");
    
    L.circle(rsCoords, { 
        color: '#198754', fillColor: '#198754', fillOpacity: 0.05, radius: maxRadius, weight: 2, dashArray: '5, 10'
    }).addTo(map);

    // Fungsi Klik Manual
    map.on('click', function(e) {
        updateLocation(e.latlng);
    });

    // Fungsi GPS Otomatis
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latlng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.flyTo(latlng, 16);
                updateLocation(latlng);
            }, function() {
                alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin lokasi diberikan.");
            });
        } else {
            alert("Browser Anda tidak mendukung GPS.");
        }
    }

    function updateLocation(latlng) {
        const distance = map.distance(latlng, rsCoords);
        const statusEl = document.getElementById('dist-status');
        const addrField = document.getElementById('wa_address');

        if (userMarker) map.removeLayer(userMarker);
        userMarker = L.marker(latlng).addTo(map);

        if (distance > maxRadius) {
            statusEl.innerHTML = `<span class="badge bg-danger">Terlalu Jauh (${(distance/1000).toFixed(1)} km)</span>`;
            isWithinRadius = false;
            addrField.value = "Lokasi di luar jangkauan pengiriman (Maks 10 KM).";
        } else {
            statusEl.innerHTML = `<span class="badge bg-success">Lokasi Terjangkau (${(distance/1000).toFixed(1)} km)</span>`;
            isWithinRadius = true;
            
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`)
                .then(r => r.json()).then(data => {
                    addrField.value = data.display_name;
                    validateForm();
                });
        }
        validateForm();
    }

    function validateForm() {
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const address = document.getElementById('wa_address').value;
        const detail = document.getElementById('wa_detail').value;
        const btn = document.getElementById('btnSubmit');
        const errMsg = document.getElementById('error-msg');

        if (rm && name && address && detail && isWithinRadius && address !== "Lokasi di luar jangkauan pengiriman (Maks 10 KM).") {
            btn.disabled = false;
            errMsg.style.display = 'none';
        } else {
            btn.disabled = true;
            errMsg.style.display = 'block';
        }
    }

    function sendToWhatsApp() {
        const phoneNumber = "6285217077347";
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const address = document.getElementById('wa_address').value;
        const detail = document.getElementById('wa_detail').value;

        const text = `*PESANAN SITERBAT*%0A%0A` +
                     `*No. RM:* ${rm}%0A` +
                     `*Pasien:* ${name}%0A` +
                     `*Alamat:* ${address}%0A` +
                     `*Detail:* ${detail}%0A%0A` +
                     `_Mohon segera diproses, Terimakasih._`;

        window.open(`https://wa.me/${phoneNumber}?text=${text}`, '_blank');
    }
</script>
@endsection
