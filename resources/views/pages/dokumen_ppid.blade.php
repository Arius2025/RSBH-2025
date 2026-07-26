@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-gradient-success text-white text-center position-relative overflow-hidden">
    <div class="container py-4 position-relative z-1">
        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">Dokumentasi Resmi</span>
        <h1 class="display-5 fw-bold mb-2" style="letter-spacing: -1px;">Dokumen PPID</h1>
        <p class="lead opacity-90 mb-0 mx-auto" style="max-width: 600px;">Arsip Resmi Regulasi, SOP, dan SK PPID RS Tk. III Baladhika Husada Jember</p>
    </div>
</section>

<!-- Content Section -->
<section class="py-5 bg-light position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <!-- Apple Segmented Control Nav Bar -->
                <div class="apple-tab-container p-2 mb-4 mx-auto" style="max-width: 500px;">
                    <ul class="nav nav-pills nav-fill apple-segmented-control" id="documentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill py-2.5 px-4 fw-bold text-uppercase" id="regulasi-tab" data-bs-toggle="tab" data-bs-target="#regulasi" type="button" role="tab">Regulasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill py-2.5 px-4 fw-bold text-uppercase" id="sop-tab" data-bs-toggle="tab" data-bs-target="#sop" type="button" role="tab">SOP</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill py-2.5 px-4 fw-bold text-uppercase" id="sk-tab" data-bs-toggle="tab" data-bs-target="#sk" type="button" role="tab">SK PPID</button>
                        </li>
                    </ul>
                </div>

                <div class="apple-glass-card rounded-5 p-4 p-md-5">
                    <div class="tab-content" id="documentTabsContent">
                        <!-- Regulasi Tab -->
                        <div class="tab-pane fade show active" id="regulasi" role="tabpanel">
                            @include('pages.partials.document_list', ['docs' => $documents['regulasi'] ?? collect([])])
                        </div>
                        
                        <!-- SOP Tab -->
                        <div class="tab-pane fade" id="sop" role="tabpanel">
                            @include('pages.partials.document_list', ['docs' => $documents['sop'] ?? collect([])])
                        </div>
                        
                        <!-- SK PPID Tab -->
                        <div class="tab-pane fade" id="sk" role="tabpanel">
                            @include('pages.partials.document_list', ['docs' => $documents['sk_ppid'] ?? collect([])])
                        </div>
                    </div>
                </div>
                
                <div class="mt-5 text-center">
                    <a href="{{ route('ppid') }}" class="btn btn-outline-success px-4 py-2.5 rounded-pill fw-bold shadow-sm hover-lift">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Layanan PPID
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FLOATING WIDGET (Permohonan Form) -->
<div class="floating-widget-container" id="floatingWidgetContainer">
    
    <!-- Widget Form Box -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-3 floating-form-box" id="floatingFormBox">
        <!-- Header -->
        <div class="bg-success text-white px-4 py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%);">
            <div class="d-flex align-items-center">
                <i class="bi bi-envelope-paper-fill fs-4 me-2"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Permohonan Informasi</h6>
                    <small class="opacity-75" style="font-size: 0.75rem;">Tim PPID Siap Membantu</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-link text-white p-0" id="closeWidgetBtn" style="text-decoration: none;">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>
        
        <!-- Form Body -->
        <div class="card-body bg-white p-4 custom-scrollbar" style="max-height: 450px; overflow-y: auto; background-color: #fcfcfc;">
            <div class="alert alert-info border-0 rounded-3 mb-4 p-3 d-flex align-items-start" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);">
                <i class="bi bi-info-circle-fill text-info-emphasis fs-4 me-2 mt-1"></i>
                <p class="text-dark mb-0 opacity-75" style="font-size: 0.8rem;">Balasan akan dikirim melalui email Anda dalam maks 3x24 jam kerja.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 p-3" style="font-size: 0.85rem;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonan.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Nama Lengkap Sesuai KTP <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control apple-input shadow-sm" required placeholder="Budi Santoso" value="{{ old('nama_lengkap') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Alamat Email Aktif <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control apple-input shadow-sm" required placeholder="budi@contoh.com" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Alamat Domisili <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control apple-input shadow-sm" rows="2" required placeholder="Sesuai KTP / Domisili">{{ old('alamat') }}</textarea>
                </div>
                
                <hr class="my-4">

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Kategori Permohonan <span class="text-danger">*</span></label>
                    <select name="jenis_permohonan" class="form-select apple-input shadow-sm" required>
                        <option value="">Pilih kategori...</option>
                        <option value="Informasi Publik" {{ old('jenis_permohonan') == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik Secara Umum</option>
                        <option value="Data Regulasi" {{ old('jenis_permohonan') == 'Data Regulasi' ? 'selected' : '' }}>Salinan Dokumen Regulasi / SOP</option>
                        <option value="Data Layanan Kesehatan" {{ old('jenis_permohonan') == 'Data Layanan Kesehatan' ? 'selected' : '' }}>Informasi Terkait Layanan Kesehatan</option>
                        <option value="Lainnya" {{ old('jenis_permohonan') == 'Lainnya' ? 'selected' : '' }}>Permintaan Lainnya</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark fs-7">Pesan & Tujuan <span class="text-danger">*</span></label>
                    <textarea name="pesan" class="form-control apple-input shadow-sm" rows="3" required placeholder="Jelaskan spesifik yang Anda butuhkan..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold shadow-lg hover-lift py-2.5" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
                    Kirim Sekarang <i class="bi bi-send-fill ms-1"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Floating Action Button (FAB) -->
    <button class="btn btn-success shadow-lg floating-btn rounded-pill d-flex align-items-center" id="openWidgetBtn" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
        <i class="bi bi-chat-left-text-fill fs-5 me-2"></i>
        <span class="fw-bold">Ajukan Permohonan</span>
    </button>
</div>

@push('scripts')
<!-- SweetAlert2 untuk Notifikasi Pop-up -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Widget Toggle Logic
        const widgetContainer = document.getElementById('floatingWidgetContainer');
        const openBtn = document.getElementById('openWidgetBtn');
        const closeBtn = document.getElementById('closeWidgetBtn');
        
        // Open Widget if there are errors so user can see them
        @if($errors->any())
            widgetContainer.classList.add('widget-open');
        @endif
        
        openBtn.addEventListener('click', function() {
            widgetContainer.classList.toggle('widget-open');
        });

        closeBtn.addEventListener('click', function() {
            widgetContainer.classList.remove('widget-open');
        });

        // SweetAlert
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil Terkirim!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Baik, Saya Mengerti',
                confirmButtonColor: '#198754',
                background: '#ffffff',
                backdrop: `rgba(0,0,0,0.5)`,
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'rounded-pill fw-bold px-4'
                }
            });
        @endif
    });
</script>
@endpush

<style>
/* Apple Glassmorphism Original Styles */
.bg-gradient-success {
    background: linear-gradient(135deg, #198754 0%, #115c39 100%);
}

.apple-tab-container {
    background: rgba(220, 225, 230, 0.6);
    backdrop-filter: blur(20px);
    border-radius: 9999px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
}

.apple-segmented-control .nav-link {
    color: #495057;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
}

.apple-segmented-control .nav-link.active {
    background-color: #ffffff;
    color: #198754;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

.apple-glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    border-radius: 28px;
}

.apple-input {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 0.75rem;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}
.apple-input:focus {
    background: #fff;
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15);
    outline: none;
}

/* Floating Widget Styles */
.floating-widget-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.floating-btn {
    padding: 12px 24px;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
.floating-btn:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 15px 25px rgba(25, 135, 84, 0.4) !important;
}

.floating-form-box {
    width: 380px;
    max-width: calc(100vw - 40px);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transform-origin: bottom right;
    transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    border-radius: 1rem;
}

.widget-open .floating-form-box {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.widget-open .floating-btn {
    display: none !important;
}

/* Custom Scrollbar for Widget Body */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8; 
}

.fs-7 {
    font-size: 0.85rem;
}

/* Hover Lift Effect */
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

@media (max-width: 576px) {
    .floating-widget-container {
        bottom: 20px;
        right: 20px;
        left: 20px;
        align-items: flex-end;
    }
    .floating-form-box {
        width: 100%;
    }
}
</style>
@endsection
