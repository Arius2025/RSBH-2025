@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center" data-aos="fade-up">
            <div class="error-container py-5">
                <i class="bi bi-shield-lock display-1 text-danger mb-4 d-block"></i>
                <h1 class="display-3 fw-bold text-dark">403</h1>
                <h2 class="h3 fw-bold text-danger mb-3">Akses Dilarang</h2>
                <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 500px;">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                </p>
                <a href="{{ route('home') }}" class="btn btn-success btn-lg rounded-pill px-5 shadow-lg transition hover-lift">
                    <i class="bi bi-house-fill me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .error-container {
        padding: 60px 20px;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
    }
</style>
@endsection
