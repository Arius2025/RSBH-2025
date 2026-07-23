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
                <div class="apple-tab-container p-2 mb-4 mx-auto" style="max-width: 600px;">
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

<style>
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
</style>
@endsection
