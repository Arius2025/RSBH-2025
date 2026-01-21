@extends('layouts.app')

@section('content')
<style>
    /* BED MONITORING STYLES - CLEAN & PROFESSIONAL */
    :root {
        --rs-green: #157347;
        --rs-dark: #2d3419;
        --rs-light: #f8f9fa;
    }

    .monitoring-container {
        background: #ffffff;
        min-height: 80vh;
    }

    .bed-card {
        border: none !important;
        border-top: 5px solid var(--rs-green) !important;
        border-radius: 12px !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05) !important;
        transition: all 0.3s ease;
        background: #fff;
    }

    .bed-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }

    .room-name {
        font-weight: 800;
        color: var(--rs-dark);
        font-size: 1.1rem;
        letter-spacing: -0.5px;
    }

    .class-box {
        background: var(--rs-light);
        border: 1px solid rgba(0,0,0,0.03);
        padding: 12px 8px;
        border-radius: 10px;
        text-align: center;
    }

    .val-tersedia {
        color: var(--rs-green);
        font-weight: 800;
        font-size: 1.4rem;
        line-height: 1;
    }

    .val-kosong {
        color: #ced4da;
        font-weight: 400;
    }

    .update-badge {
        font-size: 0.75rem;
        background: rgba(255,255,255,0.2);
        padding: 4px 12px;
        border-radius: 20px;
    }

    #scroll-wrapper-bed {
        max-height: 700px;
        overflow-y: auto;
        padding: 10px;
        scrollbar-width: thin;
    }
</style>

<div class="container py-4 monitoring-container">
    {{-- HEADER SECTION --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="fw-bold text-success display-6">Monitoring Tempat Tidur</h1>
        <p class="text-muted">Data ketersediaan ruang rawat inap RS Tk. III Baladhika Husada secara Real-Time.</p>
        <hr class="w-25 mx-auto border-success border-3 opacity-75">
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            {{-- STATUS BAR --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" data-aos="fade-up">
                <div class="card-header bg-success text-white p-3 d-flex justify-content-between align-items-center border-0">
                    <div class="d-flex align-items-center">
                        <div class="spinner-grow spinner-grow-sm text-light me-2" role="status"></div>
                        <span class="fw-bold">LIVE UPDATE</span>
                    </div>
                    <div id="last-update" class="update-badge">Menghubungkan...</div>
                </div>
                
                <div class="card-body bg-light p-4">
                    <div id="scroll-wrapper-bed">
                        <div id="bed-container" class="row g-3">
                            {{-- Loader --}}
                            <div class="col-12 text-center py-5">
                                <div class="spinner-border text-success" role="status"></div>
                                <p class="mt-3 text-muted fw-bold">Sinkronisasi data dengan server pusat...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER INFO --}}
            <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <p class="text-muted small mb-0 fst-italic">
                    *Data diperbarui otomatis setiap 60 detik.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const API_URL = "{{ route('api.bed.status') }}"; 

    async function fetchBedData() {
    const container = document.getElementById('bed-container');
    const updateText = document.getElementById('last-update');

    try {
        const response = await fetch("{{ route('api.bed.status') }}");
        
        // Log untuk developer (bisa dilihat di Console F12)
        console.log("Status Response:", response.status);
        
        if (!response.ok) throw new Error('Server Return Status: ' + response.status);
        
        const result = await response.json();
        
        // Cek apakah ada error dari Controller
        if (result.error) {
            showError("Pesan Server: " + result.error);
            return;
        }

        // Pastikan properti 'rooms' ada
        if (result && result.rooms) {
            const processedData = processRooms(result.rooms);
            renderBedCards(processedData);
            updateText.textContent = "Terakhir diperbarui: " + new Date().toLocaleTimeString('id-ID');
        } else {
            showError("Format data server pusat berubah.");
        }
    } catch (e) {
        console.error("Detail Error:", e);
        showError("Koneksi gagal ke internal API. (Cek Console F12)");
    }
}

    function processRooms(rooms) {
        const grouped = {};
        const allowedRooms = ["NICU", "TERATAI", "BOUGENVIL", "MAWAR", "NUSA INDAH", "ANGGREK", "FLAMBOYAN", "MELATI", "ICU", "DAHLIA", "PICU"];

        rooms.forEach(item => {
            let rawName = item.namaruang.toUpperCase();
            let finalName = allowedRooms.find(r => rawName.includes(r));

            if (finalName) {
                if (!grouped[finalName]) {
                    grouped[finalName] = { nama: finalName, total: 0, detail: { VIP:0, KL1:0, KL2:0, KL3:0 } };
                }
                grouped[finalName].total += parseInt(item.kapasitas) || 0;
                let k = String(item.kodekelas);
                let t = parseInt(item.tersedia) || 0;

                if (k === "VIP") grouped[finalName].detail.VIP += t;
                else if (k === "KL1") grouped[finalName].detail.KL1 += t;
                else if (k === "KL2" || k === "12") grouped[finalName].detail.KL2 += t;
                else if (k === "KL3") grouped[finalName].detail.KL3 += t;
            }
        });
        return Object.values(grouped);
    }

    function renderBedCards(data) {
        const container = document.getElementById('bed-container');
        container.innerHTML = data.map(item => `
            <div class="col-xl-4 col-md-6">
                <div class="card bed-card h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="room-name">${item.nama}</span>
                            <span class="badge bg-success opacity-75 rounded-pill">TT: ${item.total}</span>
                        </div>
                        <div class="row g-2">
                            ${createBox("VIP", item.detail.VIP)}
                            ${createBox("KL 1", item.detail.KL1)}
                            ${createBox("KL 2", item.detail.KL2)}
                            ${createBox("KL 3", item.detail.KL3)}
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function createBox(label, val) {
        return `
            <div class="col-3">
                <div class="class-box">
                    <div class="small text-muted mb-1" style="font-size:0.6rem; font-weight:700">${label}</div>
                    <div class="${val > 0 ? 'val-tersedia' : 'val-kosong'}">${val}</div>
                </div>
            </div>`;
    }

    function showError() {
        document.getElementById('bed-container').innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning d-inline-block border-0 shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal memuat data. Periksa koneksi ke server.
                </div>
            </div>`;
    }

    fetchBedData();
    setInterval(fetchBedData, 60000);
});
</script>
@endsection