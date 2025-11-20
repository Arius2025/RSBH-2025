{{-- zona.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="mx-auto" style="max-width: 720px;">

    {{-- Header --}}
    <div class="text-center mb-5" data-aos="fade-down">
      <h1 class="text-success fw-bold display-5">Zona Integritas</h1>
      <p class="lead text-muted">
        Komitmen RS Tk. III Baladhika Husada dalam mewujudkan <span class="fw-bold text-success">Wilayah Bebas dari Korupsi (WBK)</span> dan <span class="fw-bold text-success">Wilayah Birokrasi Bersih Melayani (WBBM)</span>.
      </p>
      <hr class="w-25 mx-auto border-success border-3">
    </div>

    {{-- Whistle Blowing System --}}
    <section class="bg-white rounded p-4 shadow-lg mb-5 border-start border-success border-5" data-aos="fade-up"> 
      <h5 class="text-success fw-bold mb-3 border-bottom border-success pb-2"><i class="bi bi-shield-lock me-2"></i> Whistle Blowing System (WBS)</h5>
      <p class="text-muted">
        WBS adalah bagian dari Zona Integritas untuk melaporkan pelanggaran seperti korupsi, gratifikasi, konflik kepentingan, dan penyalahgunaan wewenang. Identitas pelapor dijamin kerahasiaannya.
      </p>
      <ul class="list-group list-group-flush mb-4">
        <li class="list-group-item bg-light"><i class="bi bi-check-circle-fill text-success me-2"></i>Korupsi & Gratifikasi</li>
        <li class="list-group-item bg-light"><i class="bi bi-check-circle-fill text-success me-2"></i>Penyalahgunaan Wewenang</li>
        <li class="list-group-item bg-light"><i class="bi bi-check-circle-fill text-success me-2"></i>Konflik Kepentingan</li>
      </ul>
      <div class="text-center">
        <img src="{{ asset('images/Zona/qrzona.png') }}" alt="QR WBS" class="img-fluid mb-2 rounded shadow-sm border p-1" style="max-width: 200px;">
        <p class="small text-muted fw-semibold">Scan QR untuk pengaduan anonim</p>
      </div>
    </section>

    {{-- Video Profil --}}
    <section class="mb-5 bg-white rounded p-4 shadow-lg" data-aos="fade-up">
      <h5 class="text-success fw-bold mb-3 text-center border-bottom border-success pb-2"><i class="bi bi-camera-video me-2"></i> Video Profil & Edukasi</h5>
      <div class="ratio ratio-16x9 rounded shadow-lg mb-3">
        <iframe 
          src="https://www.youtube.com/embed/IUY4Kj2PHtI" 
          title="Profil RS" 
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen 
          loading="lazy">
        </iframe>
      </div>
    </section>

    {{-- Indeks Persepsi --}}
    <section class="bg-white rounded p-4 shadow-lg mb-5" data-aos="fade-up"> 
      <h5 class="text-success fw-bold mb-4 text-center border-bottom border-success pb-2"><i class="bi bi-clipboard-data me-2"></i> Hasil Indeks Persepsi Triwulan III 2025</h5>
      <div class="row g-4">
        {{-- IPAK --}}
        <div class="col-md-6">
          <h6 class="fw-bold text-success mb-3">🛡️ Indeks Persepsi Anti Korupsi (IPAK)</h6>
          <ul class="list-group list-group-flush border rounded shadow-sm">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Diskriminasi Pelayanan
                <span class="badge bg-success rounded-pill p-2">94.75</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Kecurangan Pelayanan
                <span class="badge bg-success rounded-pill p-2">95.00</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Gratifikasi
                <span class="badge bg-success rounded-pill p-2">95.75</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Pungutan Liar
                <span class="badge bg-success rounded-pill p-2">96.00</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Percaloan
                <span class="badge bg-success rounded-pill p-2">96.00</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-success text-white fw-bold">
                Rata-rata Konversi
                <span class="badge bg-light text-success p-2">95.99 – A / Bersih dari Korupsi</span>
            </li>
          </ul>
        </div>

        {{-- IKP --}}
        <div class="col-md-6">
          <h6 class="fw-bold text-success mb-3">💬 Indeks Persepsi Kualitas Pelayanan (IKP)</h6>
          <ul class="list-group list-group-flush border rounded shadow-sm">
            <li class="list-group-item d-flex justify-content-between align-items-center">Informasi <span class="badge bg-success rounded-pill p-2">94.68</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Persyaratan <span class="badge bg-success rounded-pill p-2">94.68</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Prosedur <span class="badge bg-success rounded-pill p-2">94.68</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Jangka Waktu <span class="badge bg-success rounded-pill p-2">92.09</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Tarif/Biaya <span class="badge bg-success rounded-pill p-2">93.22</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Sarana dan Prasarana <span class="badge bg-success rounded-pill p-2">94.68</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Petugas Pelayanan <span class="badge bg-success rounded-pill p-2">95.92</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Layanan Pengaduan/Konsultasi <span class="badge bg-success rounded-pill p-2">95.92</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-success text-white fw-bold">
                Rata-rata Konversi
                <span class="badge bg-light text-success p-2">94.89 – A / Sangat Baik</span>
            </li>
          </ul>
        </div>
      </div>
    </section>


    {{-- Form Pelaporan --}}
    <section class="mb-5 p-4 bg-white rounded shadow-lg" data-aos="fade-up">
      <h5 class="text-success fw-bold mb-4 text-center border-bottom border-success pb-2"><i class="bi bi-envelope-paper me-2"></i> Formulir Pelaporan (WBS)</h5>
      <form method="POST" action="" class="p-3 border rounded bg-light">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label fw-semibold">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan e-mail aktif Anda" required>
        </div>
        <div class="mb-4">
          <label for="laporan" class="form-label fw-semibold">Isi Laporan (Detail Pelanggaran)</label>
          <textarea class="form-control" id="laporan" name="laporan" rows="5" placeholder="Jelaskan detail pelanggaran yang Anda temukan" required></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100 shadow-sm btn-lg transition hover-shadow">Kirim Laporan Rahasia</button>
        <p class="text-muted small mt-3 text-center fst-italic">Laporan Anda akan diproses secara rahasia dan profesional sesuai prosedur WBS.</p>
      </form>
    </section>

  </div>
</div>
@endsection