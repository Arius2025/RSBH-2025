@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center" data-aos="fade-up">
            <div class="error-container py-5">
                <i class="bi bi-hammer display-1 text-secondary mb-4 d-block"></i>
                <h1 class="display-3 fw-bold text-dark">503</h1>
                <h2 class="h3 fw-bold text-secondary mb-3">Layanan Tidak Tersedia</h2>
                <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 500px;">
                    Kami sedang melakukan pemeliharaan rutin untuk meningkatkan layanan kami. Silakan kembali lagi dalam beberapa saat.
                </p>
                <div class="p-3 bg-light rounded-4 border d-inline-block">
                    <p class="mb-0 small text-muted"><i class="bi bi-info-circle me-1"></i> Estimasi selesai: Segera</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-container {
        padding: 60px 20px;
    }
</style>
@endsection
