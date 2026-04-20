@extends('layouts.app')

@section('content')
<style>
    .monitor-container { font-family: 'Inter', sans-serif; background: #f0f4f8; min-height: 100vh; padding-top: 2rem; }
    .status-card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; margin-bottom: 1.5rem; }
    .status-card:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    .badge-time { font-size: 0.75rem; background: rgba(0,0,0,0.05); color: #666; padding: 4px 10px; border-radius: 50px; }
    .live-indicator { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; animation: blink 1s infinite; }
    @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
    
    .empty-state { padding: 4rem 2rem; opacity: 0.6; }
    .new-row-highlight { animation: highlight-new 2s ease-out; }
    @keyframes highlight-new { from { background-color: rgba(255, 193, 7, 0.2); } to { background-color: white; } }
</style>

<div class="monitor-container pb-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0" style="color: {{ $color }}">
                    <i class="bi {{ $icon }} me-2"></i> MONITOR {{ $title }}
                </h3>
                <p class="text-muted small mb-0"><span class="live-indicator" style="background: {{ $color }}"></span> Memantau data terbaru secara otomatis...</p>
            </div>
            <div class="text-end">
                <button onclick="requestPermission()" id="notifBtn" class="btn btn-sm btn-outline-dark rounded-pill">
                    <i class="bi bi-bell"></i> Aktifkan Notifikasi
                </button>
            </div>
        </div>

        <div id="loading" class="text-center py-5">
            <div class="spinner-border text-secondary" role="status"></div>
            <p class="mt-2 text-muted">Menghubungkan ke pusat data...</p>
        </div>

        <div id="monitor-feed" style="display: none;">
            <!-- Data rows will appear here -->
        </div>

        <div id="empty-state" class="empty-state text-center" style="display: none;">
            <i class="bi bi-clipboard2-x fs-1"></i>
            <h5 class="mt-3">Belum ada data masuk</h5>
            <p>Data terbaru akan muncul di sini secara otomatis.</p>
        </div>
    </div>
</div>

{{-- Notification Sound --}}
<audio id="notifSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

<script>
    let lastDataHash = "";
    let isFirstLoad = true;
    const SHEET_ID = "{{ $sheetId }}";
    const RANGE = "{{ $sheetName }}!A2:G"; // Fetch last 50-100 rows roughly

    async function fetchData() {
        try {
            const apiBase = "{{ url('/api/dashboard/sheet-data') }}";
            const response = await fetch(`${apiBase}?id=${SHEET_ID}&range=${encodeURIComponent(RANGE)}`);
            const data = await response.json();
            
            document.getElementById('loading').style.display = 'none';

            if (data && data.range) {
                const rows = data.values ? data.values.reverse().slice(0, 20) : [];
                
                if (rows.length > 0) {
                    const currentHash = JSON.stringify(rows[0]);
                    if (currentHash !== lastDataHash) {
                        if (!isFirstLoad) {
                            playNotif();
                        }
                        lastDataHash = currentHash;
                        renderData(rows);
                    }
                    document.getElementById('empty-state').style.display = 'none';
                    document.getElementById('monitor-feed').style.display = 'block';
                } else {
                    document.getElementById('empty-state').style.display = 'block';
                    document.getElementById('monitor-feed').style.display = 'none';
                }
            } else {
                const errMsg = (data && data.error) ? data.error.message : (data.message || "Cek koneksi.");
                document.getElementById('loading').innerText = "Gagal memuat data: " + errMsg;
                document.getElementById('loading').style.display = 'block';
            }
            isFirstLoad = false;
        } catch (error) {
            console.error("Fetch error:", error);
            document.getElementById('loading').innerText = "Gagal memuat data: Error JSON/Koneksi";
        }
    }

    function renderData(rows) {
        const feed = document.getElementById('monitor-feed');
        feed.innerHTML = "";
        
        rows.forEach((row, index) => {
            const isNew = index === 0 && !isFirstLoad;
            const card = document.createElement('div');
            card.className = `card status-card p-3 ${isNew ? 'new-row-highlight' : ''}`;
            
            // Format dynamic columns based on title
            let content = "";
            const title = "{{ $title }}";
            
            if (title === "SITERBAT") {
                // Tgl, Jam, RM, Nama, Alamat, Detail, Phone
                content = `
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge-time">${row[0]} ${row[1]}</span>
                        <span class="fw-bold text-success">#${row[2]}</span>
                    </div>
                    <h5 class="fw-bold mb-1">${row[3]}</h5>
                    <p class="mb-1 text-dark"><i class="bi bi-geo-alt"></i> ${row[4]}</p>
                    <p class="small text-muted mb-2">${row[5] || '-'}</p>
                    <a href="https://wa.me/${row[6]}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                        <i class="bi bi-whatsapp"></i> Hubungi Pasien
                    </a>
                `;
            } else if (title === "AMBULAN") {
                // Tgl, Jam, Nama, Alamat, Detail, Phone, Gejala
                content = `
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge-time">${row[0]} ${row[1]}</span>
                        <span class="badge bg-danger">EMERGENCY</span>
                    </div>
                    <h5 class="fw-bold mb-1">${row[2]}</h5>
                    <p class="mb-1 text-dark"><i class="bi bi-geo-alt"></i> ${row[3]}</p>
                    <p class="small text-muted mb-1">${row[4] || '-'}</p>
                    <div class="bg-light p-2 rounded small mb-2"><b>Gejala:</b> ${row[6]}</div>
                    <a href="https://wa.me/${row[5]}" target="_blank" class="btn btn-sm btn-danger rounded-pill px-3">
                        <i class="bi bi-whatsapp"></i> Hubungi Pasien
                    </a>
                `;
            } else { // SANTAR DEKATE
                // Tgl, Jam, Nama, Phone, Ruangan, Belanja
                content = `
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge-time">${row[0]} ${row[1]}</span>
                        <span class="badge bg-warning text-dark">${row[4]}</span>
                    </div>
                    <h5 class="fw-bold mb-1">${row[2]}</h5>
                    <div class="bg-warning bg-opacity-10 p-2 rounded small mb-2 border border-warning border-opacity-20">
                        <b>Pesanan:</b><br>${row[5]}
                    </div>
                    <a href="https://wa.me/${row[3]}" target="_blank" class="btn btn-sm btn-warning rounded-pill px-3">
                        <i class="bi bi-whatsapp"></i> Hubungi Pasien
                    </a>
                `;
            }
            
            card.innerHTML = content;
            feed.appendChild(card);
        });
    }

    function playNotif() {
        const sound = document.getElementById('notifSound');
        sound.play().catch(e => console.log("Sound play blocked"));
        
        if (Notification.permission === "granted") {
            new Notification(`Pesanan ${"{{ $title }}"} Baru!`, {
                body: "Ada data baru masuk, silakan cek segera.",
                icon: "/images/dkt.png"
            });
        }
    }

    function requestPermission() {
        Notification.requestPermission().then(p => {
            if (p === "granted") {
                document.getElementById('notifBtn').classList.add('btn-success');
                document.getElementById('notifBtn').innerText = "Notifikasi Aktif";
            }
        });
    }

    // Auto poll every 20 seconds
    setInterval(fetchData, 20000);
    document.addEventListener('DOMContentLoaded', () => {
        fetchData();
        requestWakeLock();
    });

    // WAKE LOCK - Keep screen on
    let wakeLock = null;
    async function requestWakeLock() {
        try {
            if ('wakeLock' in navigator) {
                wakeLock = await navigator.wakeLock.request('screen');
                console.log('Wake Lock is active');
                
                wakeLock.addEventListener('release', () => {
                    console.log('Wake Lock was released');
                });
            }
        } catch (err) {
            console.error(`${err.name}, ${err.message}`);
        }
    }

    // Re-request wake lock when page becomes visible again
    document.addEventListener('visibilitychange', async () => {
        if (wakeLock !== null && document.visibilityState === 'visible') {
            await requestWakeLock();
        }
    });
</script>
@endsection
