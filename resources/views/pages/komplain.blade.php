{{-- komplain.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="mx-auto" style="max-width: 960px;">

    {{-- Header --}}
    <div class="text-center mb-5" data-aos="fade-down">
      <h1 class="text-success fw-bold display-5">Layanan Komplain & Keluhan</h1>
      <p class="lead text-muted">Respon cepat & solusi tepat – Kami siap mendengar dan menyelesaikan masalah Anda.</p>
      <hr class="w-25 mx-auto border-success border-3">
    </div>

    {{-- Komplain Online & Narahubung --}}
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-md-6" data-aos="fade-right">
          <div class="bg-white rounded p-4 shadow-lg h-100 border-start border-success border-5"> 
            <h5 class="text-success fw-bold mb-4"><i class="bi bi-qr-code-scan me-2"></i> Komplain Online</h5>
            <div class="row text-center">
              <div class="col-6">
                <a href="#" class="text-decoration-none transition hover-shadow d-block p-2 rounded">
                    <img src="{{ asset('images/komplain/qrkomplainwa.avif') }}" alt="QR WhatsApp" class="img-fluid rounded shadow-sm mb-2 border p-1" style="max-width: 180px;">
                    <p class="small text-muted fw-bold mb-0">WhatsApp</p>
                </a>
              </div>
              <div class="col-6">
                <a href="#" class="text-decoration-none transition hover-shadow d-block p-2 rounded">
                    <img src="{{ asset('images/komplain/qrkomplainform.avif') }}" alt="QR Google Form" class="img-fluid rounded shadow-sm mb-2 border p-1" style="max-width: 180px;">
                    <p class="small text-muted fw-bold mb-0">Google Forms</p>
                </a>
              </div>
            </div>
            <p class="text-center small text-muted mt-3 fst-italic">Scan untuk menghubungi kami melalui platform pilihan Anda, layanan 24 Jam.</p>
          </div>
        </div>

        <div class="col-md-6" data-aos="fade-left">
          <div class="bg-white rounded p-4 shadow-lg h-100 border-start border-success border-5"> 
            <h5 class="text-success fw-bold mb-4"><i class="bi bi-person-lines-fill me-2"></i> Narahubung Tim Komplain</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item bg-light border-0 mb-2 rounded shadow-sm">
                <strong>KAPTEN CKM TANTOWI JAUHARI, S.Kep. Ners</strong><br>
                <span class="text-success fw-semibold">Ketua Tim Komplain</span><br>
                <i class="bi bi-telephone-fill me-1 text-success"></i> <a href="tel:085330115991" class="text-decoration-none">0853-3011-5991</a>
              </li>
              <li class="list-group-item bg-light border-0 mb-2 rounded shadow-sm">
                <strong>PELTU SYAMSUL ARIFIN, S.Kep. Ners</strong><br>
                <span class="text-success fw-semibold">Komplain Pelayanan Medis</span><br>
                <i class="bi bi-telephone-fill me-1 text-success"></i> <a href="tel:081235677415" class="text-decoration-none">0812-3567-7415</a>
              </li>
              <li class="list-group-item bg-light border-0 mb-2 rounded shadow-sm">
                <strong>PNS A’JALIL ACHJAB, S.Kep.Ners, MM, M.Kes</strong><br>
                <span class="text-success fw-semibold">Komplain BPJS</span><br>
                <i class="bi bi-telephone-fill me-1 text-success"></i> <a href="tel:08123481945" class="text-decoration-none">0812-3481-945</a>
              </li>
              <li class="list-group-item bg-light border-0 mb-2 rounded shadow-sm">
                <strong>PELTU YOYOK TRI SUYANTO</strong><br>
                <span class="text-success fw-semibold">Komplain Pelayanan & Fasilitas Umum</span><br>
                <i class="bi bi-telephone-fill me-1 text-success"></i> <a href="tel:085234629570" class="text-decoration-none">0852-3462-9570</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    {{-- Alur Pengaduan --}}
    <section class="mb-5">
      <h4 class="text-success fw-bold mb-4 text-center border-bottom border-success pb-2" data-aos="fade-up"><i class="bi bi-diagram-3 me-2"></i> Alur Layanan Pengaduan</h4>
      <div class="row g-4 justify-content-center">
        <div class="col-md-6 text-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="p-3 bg-white rounded shadow-sm h-100">
            <h6 class="text-success fw-bold mb-3">Pengaduan Langsung</h6>
            <img src="{{ asset('images/komplain/komplain1.avif') }}" alt="Alur Pengaduan 1" class="img-fluid rounded shadow-sm border p-1">
          </div>
        </div>
        <div class="col-md-6 text-center" data-aos="zoom-in" data-aos-delay="200">
          <div class="p-3 bg-white rounded shadow-sm h-100">
            <h6 class="text-success fw-bold mb-3">Pengaduan Tidak Langsung</h6>
            <img src="{{ asset('images/komplain/kompain2.avif') }}" alt="Alur Pengaduan 2" class="img-fluid rounded shadow-sm border p-1">
          </div>
        </div>
      </div>
      <p class="text-center small text-muted mt-3 fst-italic">Alur pengaduan langsung & tidak langsung – transparan dan terstruktur.</p>
    </section>

  </div>
</div>
@endsection