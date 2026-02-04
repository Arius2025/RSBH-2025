@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    .hero-gradient {
        background: linear-gradient(135deg, #f8fff9 0%, #e8f5e9 100%);
        border-radius: 30px;
        position: relative;
        overflow: hidden;
    }
    .floating-card {
        border: none;
        border-radius: 25px;
        transition: transform 0.3s ease;
    }
    .form-section {
        background: #ffffff;
        border-radius: 25px;
        z-index: 2;
    }
    .map-container {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .guide-box {
        background: white;
        border-left: 5px solid #198754;
        border-radius: 15px;
    }
    .btn-kirim {
        background: #198754;
        border: none;
        padding: 15px;
        border-radius: 15px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-kirim:hover:not(:disabled) {
        background: #146c43;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px;
        border: 1.5px solid #eee;
    }

    /* Optimasi Mobile */
    @media (max-width: 768px) {
        .hero-gradient { border-radius: 20px; padding: 20px !important; }
        .display-4 { font-size: 2.2rem; }
        .map-container { min-height: 350px !important; margin-bottom: 20px; }
        .form-section { padding: 20px !important; }
    }
</style>

<div class="container py-4">
    {{-- Header --}}
    <div class="hero-gradient p-4 p-lg-5 mb-4 shadow-sm" data-aos="fade-up">
        <div class="row align-items-center text-center text-lg-start">
            <div class="col-lg-7">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">Layanan Prioritas</span>
                <h1 class="display-4 fw-bold text-success mb-2">SITERBAT</h1>
                <h4 class="fw-semibold text-dark mb-4">Siap Antar Obat</h4>
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
            <div class="form-section p-4 shadow-lg border">
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
            <div class="map-container shadow-lg h-100" style="min-height: 450px;">
                <div id="map" style="height: 100%; width: 100%; min-height: 450px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const rsCoords = [-8.165187, 113.704256]; 
    const maxRadius = 10000; // 10 KM
    let isWithinRadius = false;
    let userMarker;

    const map = L.map('map', { zoomControl: false }).setView(rsCoords, 14);
    L.control.zoom({ position: 'topright' }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
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