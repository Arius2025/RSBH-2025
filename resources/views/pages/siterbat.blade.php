@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .premium-container { font-family: 'Inter', sans-serif; background-color: #f8fafc; padding-top: 2rem; padding-bottom: 5rem; }
    .luxury-shadow { box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02); }
    .hero-gradient { background: linear-gradient(135deg, #e6fced 0%, #ffffff 100%); border: 1px solid rgba(25, 135, 84, 0.1); border-radius: 32px; position: relative; overflow: hidden; }
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 28px; }
    .map-container { border-radius: 28px; overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.05); }
    .btn-kirim { background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none; padding: 16px; border-radius: 16px; font-weight: 700; color: white; transition: all 0.4s ease; }
    .btn-kirim:hover:not(:disabled) { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(25, 135, 84, 0.3); }
    .form-control { border-radius: 14px; padding: 14px 16px; border: 2px solid #e2e8f0; background-color: #f8fafc; transition: all 0.3s ease; font-weight: 500; }
    .form-control:focus { background-color: #ffffff; border-color: #198754; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.1); }
    @media (max-width: 768px) { .map-container { min-height: 400px !important; } }
</style>

<div class="container premium-container py-4">
    <div class="row g-4 justify-content-center" data-aos="fade-up">
        <div class="col-lg-5">
            <div class="form-section p-4 luxury-shadow glass-card border-0">
                <h5 class="fw-bold mb-4 d-flex align-items-center text-success">
                    <span class="bg-success text-white rounded-circle p-2 me-3 d-flex shadow-sm">
                        <i class="bi bi-bicycle fs-6"></i>
                    </span>
                    Siterbat (Siap Antar Obat)
                </h5>
                
                <form id="siterbatForm">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">No. Rekam Medis (RM)</label>
                        <input type="text" id="wa_rm" class="form-control" placeholder="Contoh: 12.34.56" oninput="validateForm()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Nama Lengkap Pasien</label>
                        <input type="text" id="wa_name" class="form-control" placeholder="Nama pasien sesuai kartu" oninput="validateForm()">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="button" onclick="getLocation()" class="btn btn-outline-success btn-sm rounded-pill px-4">
                            <i class="bi bi-crosshair me-2"></i> Gunakan Lokasi GPS Saya
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Alamat (Auto dari Peta)</label>
                        <textarea id="wa_address" class="form-control bg-light" rows="3" readonly placeholder="Titik lokasi akan muncul di sini..."></textarea>
                        <div id="dist-status" class="mt-2 text-center"></div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Detail Rumah</label>
                        <textarea id="wa_detail" class="form-control" rows="2" placeholder="Contoh: Depan Mushola, Pagar Hitam No. 12" oninput="validateForm()"></textarea>
                    </div>
                    <button type="button" id="btnSubmit" onclick="sendToWhatsApp()" class="btn btn-success btn-kirim w-100 shadow" disabled>
                        <i class="bi bi-whatsapp me-2"></i> KIRIM PESANAN SEKARANG
                    </button>
                    <p id="error-msg" class="text-danger small mt-3 text-center fw-bold">Lengkapi data & titik peta (Maks. 10KM)</p>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="map-container luxury-shadow glass-card h-100" style="min-height: 500px;">
                <div id="map" style="height: 100%; width: 100%; min-height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const RS_COORDS = [-8.165187, 113.704256];
    const CONFIG = {
        radius: 10000,
        wa: "6285217077347",
        template: "*PESANAN SITERBAT*\n\n*No. RM:* {rm}\n*Pasien:* {name}\n*Alamat:* {address}\n*Detail:* {detail}\n\n_Mohon segera diproses, Terimakasih._",
        prefix: "wa_"
    };

    let isWithinRadius = false;
    let userMarker, rsCircle, map;

    function initMap() {
        map = L.map('map', { zoomControl: false }).setView(RS_COORDS, 13);
        L.control.zoom({ position: 'topright' }).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap' }).addTo(map);

        const rsIcon = L.divIcon({
            html: '<i class="bi bi-hospital-fill text-success fs-3"></i>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });
        L.marker(RS_COORDS, {icon: rsIcon}).addTo(map).bindPopup("<b>RS Baladhika Husada</b>");
        
        rsCircle = L.circle(RS_COORDS, { 
            color: '#198754', fillColor: '#198754', fillOpacity: 0.05, radius: CONFIG.radius, weight: 2, dashArray: '5, 10'
        }).addTo(map);

        map.on('click', function(e) { updateLocation(e.latlng); });
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latlng = { lat: position.coords.latitude, lng: position.coords.longitude };
                map.flyTo(latlng, 16);
                updateLocation(latlng);
            }, () => alert("Gagal mendapatkan lokasi."));
        } else {
            alert("Browser tidak mendukung GPS.");
        }
    }

    function updateLocation(latlng) {
        const distance = map.distance(latlng, RS_COORDS);
        const statusEl = document.getElementById('dist-status');
        const addrField = document.getElementById('wa_address');

        if (userMarker) map.removeLayer(userMarker);
        userMarker = L.marker(latlng).addTo(map);

        if (distance > CONFIG.radius) {
            statusEl.innerHTML = `<span class="badge bg-danger text-white">Terlalu Jauh (${(distance/1000).toFixed(1)} km)</span>`;
            isWithinRadius = false;
            addrField.value = `Lokasi di luar jangkauan (Maks 10 KM).`;
        } else {
            statusEl.innerHTML = `<span class="badge bg-success text-white">Lokasi Terjangkau (${(distance/1000).toFixed(1)} km)</span>`;
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

        if (rm && name && address && detail && isWithinRadius && !address.includes("luar jangkauan")) {
            btn.disabled = false;
            errMsg.style.display = 'none';
        } else {
            btn.disabled = true;
            errMsg.style.display = 'block';
        }
    }

    function sendToWhatsApp() {
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const address = document.getElementById('wa_address').value;
        const detail = document.getElementById('wa_detail').value;

        const text = CONFIG.template
            .replace('{rm}', rm)
            .replace('{name}', name)
            .replace('{address}', address)
            .replace('{detail}', detail);

        window.open(`https://wa.me/${CONFIG.wa}?text=${encodeURIComponent(text)}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endsection
