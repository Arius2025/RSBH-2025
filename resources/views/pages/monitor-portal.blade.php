@extends('layouts.app')

@section('content')
<style>
    .portal-container {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    .portal-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 40px;
        padding: 3rem;
        box-shadow: 0 40px 100px rgba(0,0,0,0.1);
        max-width: 900px;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.5);
    }
    .role-btn {
        border-radius: 25px;
        padding: 2rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        text-align: center;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        height: 100%;
    }
    .role-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .role-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .btn-siterbat { background: #e6fced; color: #198754; }
    .btn-ambulan { background: #fff5f5; color: #dc3545; }
    .btn-koperasi { background: #fffbeb; color: #ffc107; }

    .glow-success { background: #198754 !important; color: white !important; }
    .glow-danger { background: #dc3545 !important; color: white !important; }
    .glow-warning { background: #ffc107 !important; color: white !important; }
</style>

<div class="portal-container">
    <div class="portal-card" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark mb-2">Portal Monitoring</h2>
            <p class="text-muted">Silakan pilih unit Anda untuk mulai memantau pesanan.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <a href="{{ route('monitor.siterbat') }}" class="role-btn btn-siterbat shadow-sm">
                    <div class="role-icon glow-success">
                        <i class="bi bi-bicycle"></i>
                    </div>
                    <h5 class="fw-bold mb-1">SITERBAT</h5>
                    <span class="small opacity-75">Antar Obat</span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('monitor.ambulance') }}" class="role-btn btn-ambulan shadow-sm">
                    <div class="role-icon glow-danger">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5 class="fw-bold mb-1">AMBULAN</h5>
                    <span class="small opacity-75">Jemput Pasien</span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('monitor.santardekate') }}" class="role-btn btn-koperasi shadow-sm">
                    <div class="role-icon glow-warning">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h5 class="fw-bold mb-1">KOPERASI</h5>
                    <span class="small opacity-75">Santar Dekate</span>
                </a>
            </div>
        </div>

        <div class="mt-5 text-center">
            <p class="small text-muted">Aplikasi ini bisa di-install di HP dengan menekan "Tambah ke Layar Utama" pada masing-masing halaman unit.</p>
        </div>
    </div>
</div>
@endsection
