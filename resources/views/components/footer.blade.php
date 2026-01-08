{{-- footer.blade.php --}}
<footer class="bg-white border-top mt-5 pt-5 pb-4 shadow-sm">
  <div class="container">
    <div class="row gy-4">

      {{-- Kolom 1: Profil RS --}}
      <div class="col-lg-4 col-md-6">
        <h5 class="fw-bold text-success mb-4">
            <i class="bi bi-hospital-fill me-2"></i>RS Baladhika Husada
        </h5>
        <p class="text-dark small lh-lg">
            Rumah Sakit Tk. III Baladhika Husada Jember berkomitmen memberikan pelayanan kesehatan prima bagi prajurit TNI, PNS, keluarga, serta masyarakat umum dengan profesionalisme tinggi.
        </p>
        <div class="d-flex gap-3 mt-4">
          <a href="#" class="social-icon-light"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon-light"><i class="bi bi-instagram"></i></a>
          <a href="#" class="social-icon-light"><i class="bi bi-youtube"></i></a>
          <a href="#" class="social-icon-light"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      {{-- Kolom 2: Tautan Cepat --}}
      <div class="col-lg-2 col-md-6">
        <h5 class="fw-bold text-dark mb-4 border-bottom border-success pb-2 d-inline-block">Tautan</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('home') }}" class="text-muted text-decoration-none hover-green">Beranda</a></li>
          <li class="mb-2"><a href="{{ route('informasi') }}"" class="text-muted text-decoration-none hover-green">Informasi</a></li>
          <li class="mb-2"><a href="{{ route('jadwal') }}"" class="text-muted text-decoration-none hover-green">Jadwal Dokter</a></li>
          <li class="mb-2"><a href="{{ route('kontak') }}"" class="text-muted text-decoration-none hover-green">Kontak Kami</a></li>
        </ul>
      </div>

      {{-- Kolom 3: Kontak IGD --}}
      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold text-dark mb-4 border-bottom border-success pb-2 d-inline-block">Kontak IGD</h5>
        <div class="bg-light p-3 rounded-4 border border-success border-opacity-25 shadow-sm">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-telephone-fill me-2 text-success"></i>
                <span class="fw-bold text-dark">(0331) 484674</span>
            </div>
            <p class="small text-muted mb-0">Layanan Gawat Darurat 24 Jam siap membantu Anda.</p>
        </div>
        <p class="text-dark small mt-3">
            <i class="bi bi-geo-alt-fill text-success me-2"></i>Jl. Panglima Besar Sudirman No.45, Jember
        </p>
      </div>

      {{-- Kolom 4: Survei QR --}}
      <div class="col-lg-3 col-md-6 text-center text-md-start">
        <h5 class="fw-bold text-dark mb-4 border-bottom border-success pb-2 d-inline-block">Survei Layanan</h5>
        <div class="bg-white p-2 d-inline-block rounded-3 shadow border mb-2">
            <img src="images/qr.png" 
                 alt="QR Survei" style="width: 100px; height: 100px;">
        </div>
        <p class="text-muted small">Scan QR untuk memberikan saran atau kritik Anda.</p>
      </div>

    </div>

    <hr class="my-4 border-dark opacity-10">

    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start">
        <p class="text-muted small mb-0">© 2026 RS Baladhika Husada. Hak Cipta Dilindungi.</p>
      </div>
      <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
        <p class="text-muted small mb-0">Developed by <span class="text-success fw-bold">Tim IT RSBH</span> | v1.2</p>
      </div>
    </div>
  </div>
</footer>

<style>
    .social-icon-light {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #198754;
        border-radius: 50%;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid #e9ecef;
    }

    .social-icon-light:hover {
        background: #198754;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .hover-green:hover {
        color: #198754 !important;
        padding-left: 4px;
        transition: all 0.2s ease;
    }

    .lh-lg { line-height: 1.7; }
    .rounded-4 { border-radius: 1rem; }
</style>