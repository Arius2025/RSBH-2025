@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-success text-white">
    <div class="container py-4">
        <h1 class="display-5 fw-bold mb-2">Dokumen PPID</h1>
        <p class="lead opacity-75 mb-0">Informasi Publik RS Tk. III Baladhika Husada Jember</p>
    </div>
</section>

<!-- Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white p-0 border-0">
                        <ul class="nav nav-tabs nav-fill ppid-tabs" id="documentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active py-3 fw-bold" id="regulasi-tab" data-bs-toggle="tab" data-bs-target="#regulasi" type="button" role="tab">REGULASI</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-3 fw-bold" id="sop-tab" data-bs-toggle="tab" data-bs-target="#sop" type="button" role="tab">SOP</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-3 fw-bold" id="sk-tab" data-bs-toggle="tab" data-bs-target="#sk" type="button" role="tab">SK PPID</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4 p-md-5">
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
                </div>
                
                <div class="mt-5 text-center">
                    <a href="{{ route('ppid') }}" class="btn btn-outline-success px-4 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Layanan PPID
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.ppid-tabs .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 3px solid transparent;
    border-radius: 0;
    transition: all 0.3s ease;
}
.ppid-tabs .nav-link:hover {
    background-color: #f8f9fa;
    color: #198754;
}
.ppid-tabs .nav-link.active {
    color: #198754;
    background-color: transparent;
    border-bottom-color: #198754;
}
</style>
@endsection
