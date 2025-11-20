{{-- footer.blade.php --}}
<footer class="bg-white border-top mt-5 pt-5 pb-4">
  <div class="container">
    <div class="row gy-5 align-items-start">

      {{-- Kolom Layanan --}}
      <div class="col-md-4">
        <h5 class="text-success fw-bold mb-3 border-bottom border-success pb-2"><i class="bi bi-heart-pulse-fill me-2"></i>Layanan Kami</h5>
        <p class="text-muted small">Kami memberikan pelayanan kesehatan terbaik untuk peserta BPJS, umum, dan anggota TNI/POLRI dengan komitmen profesionalisme dan empati.</p>
        <div class="d-flex gap-4 mt-4">
          <a href="#" aria-label="Facebook" class="text-decoration-none transition hover-shadow"><i class="bi bi-facebook fs-4 text-success"></i></a>
          <a href="#" aria-label="Twitter" class="text-decoration-none transition hover-shadow"><i class="bi bi-twitter fs-4 text-success"></i></a>
          <a href="#" aria-label="Instagram" class="text-decoration-none transition hover-shadow"><i class="bi bi-instagram fs-4 text-success"></i></a>
          <a href="#" aria-label="YouTube" class="text-decoration-none transition hover-shadow"><i class="bi bi-youtube fs-4 text-success"></i></a>
        </div>
      </div>

      {{-- Kolom Lokasi --}}
      <div class="col-md-4">
        <h5 class="text-success fw-bold mb-3 border-bottom border-success pb-2"><i class="bi bi-geo-alt-fill me-2"></i>Lokasi Kami</h5>
        <div class="ratio ratio-4x3 rounded shadow-lg border"> 
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.619208905634!2d113.70399767500394!3d-8.16394858134159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6943bb3448627%3A0x4568cb1a5d56572d!2sBaladhika%20Husada%20Hospital!5e0!3m2!1sid!2sid!4v1693245600000!5m2!1sid!2sid"
            style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
        <p class="text-muted small mt-3 fw-semibold">Jl. Letjen Sutoyo No. 12, Jember – Jawa Timur</p>
      </div>

      {{-- Kolom Survei --}}
      <div class="col-md-4 text-center">
        <h5 class="text-success fw-bold mb-3 border-bottom border-success pb-2"><i class="bi bi-chat-square-heart-fill me-2"></i>Survei Kepuasan</h5>
        <p class="text-muted small">Bantu kami meningkatkan layanan dengan mengisi survei kepuasan melalui QR berikut:</p>
        <img src="https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=1440,h=1406,fit=crop/m7VK7alWx1TJWNKJ/qrcode_196127072_e4063c6b5d52e0d678d589f12ac2e4cb-YNqBM6NLZ7sqxM4Z.png" alt="QR Survei Kepuasan" class="img-fluid rounded shadow-lg border p-2 bg-white" width="240" loading="lazy"> 
        <p class="text-muted small mt-2 fw-semibold">Scan dengan kamera HP Anda</p>
      </div>

    </div>

    <hr class="mt-5">
    <div class="text-center text-muted small">
      <span class="d-block mb-1">© {{ date('Y') }} Rumah Sakit Tk. III Baladhika Husada</span>
      <span>Dirancang oleh Tim IT RSBH | Versi 1.0</span> 
    </div>
  </div>
</footer>