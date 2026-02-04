@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    /* Custom Styling agar tidak kaku */
    .hero-gradient {
        background: linear-gradient(135deg, #f8fff9 0%, #e8f5e9 100%);
        border-radius: 30px;
        position: relative;
        overflow: hidden;
    }
    .hero-gradient::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(25, 135, 84, 0.05);
        border-radius: 50%;
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
        min-height: 450px;
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
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
    }
</style>

<div class="container py-5">
    <div class="hero-gradient p-4 p-lg-5 mb-5 shadow-sm" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-3">Layanan Prioritas</span>
                <h1 class="display-4 fw-bold text-success mb-2">SITERBAT</h1>
                <h4 class="fw-semibold text-dark mb-4">Siap Antar Obat</h4>
                <div class="guide-box p-3 shadow-sm d-inline-block text-start">
                    <p class="small mb-0 text-muted">
                        <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                        <strong>Tips Cepat:</strong> Pilih kecamatan, lalu <strong>klik lokasi rumah Anda</strong> pada peta untuk mengisi alamat secara otomatis.
                    </p>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="{{ asset('images/siterbat.png') }}" alt="Siterbat" class="img-fluid" style="max-height: 300px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-right">
            <div class="form-section p-4 shadow-lg h-100">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="bg-success text-white rounded-circle p-2 me-3 d-flex shadow-sm">
                        <i class="bi bi-pencil-square fs-6"></i>
                    </span>
                    Data Pengiriman
                </h5>
                
                <form id="siterbatForm" oninput="validateForm()">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NO. REKAM MEDIS (RM)</label>
                        <input type="text" id="wa_rm" class="form-control" placeholder="Contoh: 12.34.56" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NAMA LENGKAP PASIEN</label>
                        <input type="text" id="wa_name" class="form-control" placeholder="Masukkan nama pasien" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">KECAMATAN</label>
                        <select id="wa_district" class="form-select" onchange="jumpToDistrict()">
                            <option value="-8.1691,113.7021">-- Pilih Wilayah --</option>
                            <option value="-8.1565,113.7056">Patrang</option>
                            <option value="-8.1844,113.7122">Sumbersari</option>
                            <option value="-8.1789,113.6924">Kaliwates</option>
                            <option value="-8.1147,113.7224">Arjasa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">ALAMAT (DARI PETA)</label>
                        <textarea id="wa_address" class="form-control bg-light" rows="2" readonly placeholder="Klik titik lokasi Anda di peta..."></textarea>
                        <div id="dist-status" class="mt-2"></div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">DETAIL RUMAH</label>
                        <textarea id="wa_detail" class="form-control" rows="2" placeholder="Nomor rumah, warna pagar, atau patokan lainnya" required></textarea>
                    </div>

                    <button type="button" id="btnSubmit" onclick="sendToWhatsApp()" class="btn btn-success btn-kirim w-100 shadow" disabled>
                        <i class="bi bi-whatsapp me-2"></i> KIRIM PESANAN SEKARANG
                    </button>
                    <p id="error-msg" class="text-danger small mt-3 text-center fw-bold" style="display:none;">Mohon lengkapi semua data & lokasi peta (Max 10KM)</p>
                </form>
            </div>
        </div>

        <div class="col-lg-7 order-1 order-lg-2" data-aos="fade-left">
            <div class="map-container h-100">
                <div id="map" style="height: 100%; width: 100%; min-height: 500px;"></div>
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

    // Marker RS
    const rsIcon = L.divIcon({
        html: '<i class="bi bi-hospital-fill text-success fs-3"></i>',
        className: 'custom-div-icon',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    L.marker(rsCoords, {icon: rsIcon}).addTo(map).bindPopup("<b>RS Baladhika Husada</b>");
    
    // Circle Radius
    L.circle(rsCoords, { 
        color: '#198754', 
        fillColor: '#198754', 
        fillOpacity: 0.05, 
        radius: maxRadius,
        weight: 2,
        dashArray: '5, 10'
    }).addTo(map);

    map.on('click', function(e) {
        const distance = map.distance(e.latlng, rsCoords);
        const statusEl = document.getElementById('dist-status');
        const addrField = document.getElementById('wa_address');

        if (userMarker) map.removeLayer(userMarker);
        userMarker = L.marker(e.latlng).addTo(map);

        if (distance > maxRadius) {
            statusEl.innerHTML = `<div class="badge bg-danger rounded-pill"><i class="bi bi-x-circle me-1"></i> Luar Jangkauan (${(distance/1000).toFixed(1)} km)</div>`;
            isWithinRadius = false;
            addrField.value = "";
        } else {
            statusEl.innerHTML = `<div class="badge bg-success rounded-pill"><i class="bi bi-check-circle me-1"></i> Dalam Jangkauan (${(distance/1000).toFixed(1)} km)</div>`;
            isWithinRadius = true;
            
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
                .then(r => r.json()).then(data => {
                    addrField.value = data.display_name;
                    validateForm();
                });
        }
        validateForm();
    });

    function jumpToDistrict() {
        const coords = document.getElementById('wa_district').value.split(',');
        map.flyTo([coords[0], coords[1]], 15);
    }

    function validateForm() {
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const address = document.getElementById('wa_address').value;
        const detail = document.getElementById('wa_detail').value;
        const btn = document.getElementById('btnSubmit');
        const errMsg = document.getElementById('error-msg');

        if (rm && name && address && detail && isWithinRadius) {
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