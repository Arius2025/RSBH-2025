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

    /* Pulse Animation */
    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(25, 135, 84, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(25, 135, 84, 0); }
    }
    .pulse-indicator {
        width: 10px; height: 10px; background: #198754; border-radius: 50%;
        display: inline-block; animation: pulse-green 2s infinite; margin-right: 8px;
    }
    .status-badge {
        background: rgba(25, 135, 84, 0.08); color: #198754; font-size: 0.65rem;
        font-weight: 800; padding: 6px 12px; border-radius: 50px; text-transform: uppercase;
        letter-spacing: 0.5px; border: 1px solid rgba(25, 135, 84, 0.2);
    }
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

                <div class="mb-4 text-center">
                    <span class="status-badge">
                        <span class="pulse-indicator"></span> SISTEM MONITORING AKTIF
                    </span>
                </div>
                
                <form id="siterbatForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">No. Rekam Medis (RM)</label>
                        <input type="text" id="wa_rm" class="form-control" placeholder="Contoh: 123456" oninput="validateForm()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Nama Lengkap Pasien</label>
                        <input type="text" id="wa_name" class="form-control" placeholder="Nama pasien sesuai KTP" oninput="validateForm()">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="button" onclick="getLocation()" class="btn btn-outline-success btn-sm rounded-pill px-4">
                            <i class="bi bi-crosshair me-2"></i> Gunakan Lokasi GPS Saya
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Alamat (Bisa Diisi Manual)</label>
                        <textarea id="wa_address" class="form-control" rows="3" placeholder="Isi alamat manual atau pilih dari peta..." oninput="validateForm()"></textarea>
                        <div id="dist-status" class="mt-2 text-center"></div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Detail Rumah</label>
                        <textarea id="wa_detail" class="form-control" rows="2" placeholder="Contoh: Depan Mushola, Pagar Hitam No. 12" oninput="validateForm()"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">No. Telepon / WhatsApp</label>
                        <input type="tel" id="wa_phone" class="form-control" placeholder="Contoh: 081234567890" oninput="validateForm()">
                    </div>
                    <button type="button" id="btnSubmit" onclick="handleSubmit()" class="btn btn-success btn-kirim w-100 shadow" disabled>
                        <i class="bi bi-send me-2"></i> <span id="btnText">KIRIM DATA PERMINTAAN OBAT</span>
                    </button>
                    <p id="error-msg" class="text-danger small mt-3 text-center fw-bold">Lengkapi data untuk mengirim pesanan</p>
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

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                </div>
                <h3 class="fw-bold text-dark mb-3">Permintaan Terkirim!</h3>
                <p class="text-muted mb-4">Silahkan tunggu, petugas kami akan menghubungi anda.</p>
                <button type="button" class="btn btn-success px-5 rounded-pill" data-bs-dismiss="modal">OKE</button>
            </div>
        </div>
    </div>
</div>

<script>
    const RS_COORDS = [-8.1639486, 113.7061723];
    const CONFIG = {
        radius: 10000,
        prefix: "wa_"
    };

    let isWithinRadius = true; // Default true to allow manual address even if map not used
    let userMarker, rsCircle, map;

    function initMap() {
        map = L.map('map', { zoomControl: false }).setView(RS_COORDS, 13);
        L.control.zoom({ position: 'topright' }).addTo(map);
        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0','mt1','mt2','mt3'],
            attribution: '&copy; <a href="https://maps.google.com">Google Maps</a>'
        }).addTo(map);

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
        const phone = document.getElementById('wa_phone').value;
        const btn = document.getElementById('btnSubmit');
        const errMsg = document.getElementById('error-msg');

        // Regex: Only numbers, at least 10 digits
        const phoneRegex = /^[0-9]+$/;
        const isPhoneValid = phoneRegex.test(phone) && phone.length >= 10;

        if (rm && name && address && detail && isPhoneValid && isWithinRadius) {
            btn.disabled = false;
            errMsg.style.display = 'none';
        } else {
            btn.disabled = true;
            errMsg.style.display = 'block';
            if (!isWithinRadius) {
                errMsg.innerText = "Lokasi di luar jangkauan (Maks 10 KM)";
            } else if (phone && !isPhoneValid) {
                errMsg.innerText = "Nomor WhatsApp harus angka (Min. 10 digit)";
            } else {
                errMsg.innerText = "Lengkapi data untuk mengirim pesanan";
            }
        }
    }

    async function handleSubmit() {
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const address = document.getElementById('wa_address').value;
        const detail = document.getElementById('wa_detail').value;
        const phone = document.getElementById('wa_phone').value;
        const btn = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');

        btn.disabled = true;
        btnText.innerText = "MENGIRIM...";

        try {
            const response = await fetch("{{ route('siterbat.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ rm, name, address, detail, phone })
            });

            const result = await response.json();

            if (result.success) {
                // WA Notification
                const waNumber = "6285217077347";
                const waMessage = `*Pesan Siterbat (Antar Obat)*\n\n- RM: ${rm}\n- Nama: ${name}\n- Alamat: ${address}\n- Detail: ${detail}\n- WA Pasien: ${phone}`;
                const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;
                
                const myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
                
                // Open WA after a small delay
                setTimeout(() => {
                    window.open(waUrl, '_blank');
                }, 1000);
                
                document.getElementById('siterbatForm').reset();
                validateForm();
            } else {
                alert("Gagal menyimpan pesanan: " + (result.message || "Unknown error"));
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            alert("Terjadi kesalahan teknis. Silakan coba lagi.");
        } finally {
            btn.disabled = false;
            btnText.innerText = "KIRIM DATA PESANAN";
        }
    }

    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endsection
