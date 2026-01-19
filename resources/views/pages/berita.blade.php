@extends('layouts.app')

@section('content')
<style>
    /* Desain Kartu */
    .card-instagram {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
    }
    .card-instagram:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .img-container {
        position: relative;
        height: 280px;
        overflow: hidden;
    }
    .img-container img {
        transition: transform 0.5s ease;
        object-fit: cover;
    }
    .card-instagram:hover .img-container img {
        transform: scale(1.1);
    }
    .badge-date {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(25, 135, 84, 0.85);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        backdrop-filter: blur(5px);
        z-index: 10;
    }

    /* Tombol Gradasi Instagram */
    .btn-instagram-custom {
        background: #f09433;
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-instagram-custom:hover {
        color: white;
        opacity: 0.9;
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(220, 39, 67, 0.4);
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h6 class="text-success fw-bold text-uppercase">Social Media Feed</h6>
        <h1 class="fw-bold display-5 text-dark">Berita & Kegiatan Terkini</h1>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Update terbaru kegiatan RS Tk. III Baladhika Husada langsung dari Instagram resmi kami.
        </p>
        <hr class="w-25 mx-auto border-success border-3 opacity-75">
    </div>

    <div class="row g-4">
        @isset($beritas)
            @foreach($beritas as $b)
                <div class="col-md-4 col-sm-6">
                    <div class="card card-instagram h-100 shadow-sm">
                        <div class="img-container">
                            <span class="badge-date">
                                <i class="bi bi-calendar3 me-1"></i> 
                                {{ \Carbon\Carbon::parse($b->tgl)->translatedFormat('d M Y') }}
                            </span>
                            <img src="{{ $b->img }}" class="w-100 h-100" alt="Instagram Post">
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark mb-2" style="height: 3rem; overflow: hidden;">
                                {{ $b->judul }}
                            </h5>
                            <p class="text-muted small flex-grow-1 mb-4">
                                {{ $b->isi }}
                            </p>

                            <div class="pt-3 border-top mt-auto">
                                <a href="{{ $b->url }}" target="_blank" class="btn btn-instagram-custom w-100 rounded-pill fw-bold py-2 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-instagram me-2"></i> Buka Postingan Asli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>
@endsection