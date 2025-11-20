{{-- informasi.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="mx-auto" style="max-width: 800px;"> 

    {{-- Header --}}
    <div class="text-center mb-5" data-aos="fade-down"> 
      <h1 class="fw-bold display-5 text-success">Informasi Rumah Sakit</h1>
      <p class="lead text-muted">Profil, Visi Misi, Sejarah, Organisasi, dan Riwayat Karumkit RS Tk. III Baladhika Husada</p>
      <hr class="w-25 mx-auto border-success border-3">
      <blockquote class="blockquote text-muted fst-italic mt-4">"Melayani dengan hati, menjaga kesehatan bangsa."</blockquote>
    </div>

    {{-- Navigasi Internal --}}
    <nav class="mb-5 text-center p-3 bg-white rounded shadow-sm" data-aos="fade-up">
      <a href="#visi" class="btn btn-outline-success btn-sm mx-1 my-1">Visi</a>
      <a href="#misi" class="btn btn-outline-success btn-sm mx-1 my-1">Misi</a>
      <a href="#sejarah" class="btn btn-outline-success btn-sm mx-1 my-1">Sejarah</a>
      <a href="#organisasi" class="btn btn-outline-success btn-sm mx-1 my-1">Organisasi</a>
      <a href="#timeline-organisasi" class="btn btn-outline-success btn-sm mx-1 my-1">Timeline</a>
      <a href="#karumkit" class="btn btn-outline-success btn-sm mx-1 my-1">Karumkit</a>
    </nav>

    {{-- Visi --}}
    <section id="visi" class="mb-5 p-4 bg-white rounded shadow-sm" data-aos="fade-right">
      <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-eye me-2"></i> Visi</h4>
      <p class="text-muted lead">Menjadi Rumah Sakit kepercayaan dan kebanggaan Prajurit, PNS dan Keluarganya di wilayah Kodam V/Brawijaya, serta masyarakat Umum di Jember dan sekitarnya.</p>
    </section>

    {{-- Misi --}}
    <section id="misi" class="mb-5 p-4 bg-white rounded shadow-sm" data-aos="fade-left">
      <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-bullseye me-2"></i> Misi</h4>
      <ul class="list-group list-group-flush">
        <li class="list-group-item bg-light p-3 rounded mb-2 shadow-sm">Menyelenggarakan dukungan kesehatan yang handal</li>
        <li class="list-group-item bg-light p-3 rounded mb-2 shadow-sm">Memberikan pelayanan kesehatan yang paripurna, bermutu dan terjangkau</li>
        <li class="list-group-item bg-light p-3 rounded mb-2 shadow-sm">Meningkatkan kemampuan personel yang profesional sesuai dengan bidang dan profesinya</li>
      </ul>
    </section>

    {{-- Sejarah (Timeline) --}}
    <section id="sejarah" class="mb-5 p-4 bg-white rounded shadow-sm" data-aos="fade-up">
      <div class="container-fluid"> 
        <div class="text-center mb-4">
          <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-journal-text me-2"></i> Sejarah RS Baladhika Husada</h4>
          <p class="text-muted">Perjalanan panjang institusi kesehatan militer di Jember sejak 1945.</p>
        </div>

        <div class="timeline-list"> 
          @foreach([
            ['1945', 'Pembentukan DKT Resimen IV', 'DKT dibentuk sebagai institusi kesehatan militer di wilayah Karesidenan Besuki.'],
            ['1946', 'dr. RM. Soebandi Menjadi Kepala DKT', 'Ditunjuk oleh Ir. Soekarno, dr. Soebandi memimpin DKT dengan 25 personel eks Tentara PETA.'],
            ['1949', 'Gugurnya Letkol dr. Soebandi', 'Beliau gugur dalam pertempuran di Karang Kedawung, Jember, dan dimakamkan di TMP Patrang.'],
            ['2006', 'Permintaan Sejarah Resmi', 'Surat Kakesdam V/Brawijaya menjadi dasar dokumentasi sejarah RS Tingkat III Baladhika Husada.']
          ] as $item)
          <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <span class="timeline-marker"></span> 
            <div class="timeline-content">
                <h6 class="fw-bold text-success">{{ $item[0] }} – {{ $item[1] }}</h6>
                <p class="text-muted">{{ $item[2] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- Riwayat Karumkit (Tampilan Card) --}}
    <section id="karumkit" class="mb-5 p-4 bg-white rounded shadow-sm" data-aos="fade-up">
        <h4 class="text-success fw-bold border-bottom border-success pb-2 mb-3"><i class="bi bi-person-lines-fill me-2"></i> Riwayat Kepala Rumah Sakit</h4>
        <p class="text-muted">Daftar para pemimpin RS dari masa ke masa, menunjukkan dedikasi dalam pelayanan kesehatan militer dan publik.</p>
        <div class="row row-cols-1 row-cols-md-2 g-3 mt-3">
        @foreach([
            ['Letkol dr. Soebandi', 'Tahun 1946 s.d 1949'],
            ['Mayor Cdm dr. Soedjono', 'Tahun 1959 s.d 1962'],
            ['Mayor Cdm dr. Karno Supojo', 'Tahun 1966 s.d 1969'],
            ['Kapten Cdm dr. Sam Pakpahan', 'Tahun 1969 s.d 1972'],
            ['Kapten Cdm dr. Soedomo Pradono', 'Tahun 1972 s.d 1973'],
            ['Mayor Cdm dr. Tom Uripan', 'Tahun 1973 s.d 1976'],
            ['Mayor Cdm dr. Suryono', 'Tahun 1977 s.d 1983'],
            ['Letkol Ckm dr. Koesnan D', 'Tahun 1983 s.d 1990'],
            ['Mayor Ckm dr. Budiharto', 'Januari 1991 s.d April 1991'],
            ['Mayor Ckm dr. H. Zularnain Pohan', 'Tahun 1991 s.d 1995'],
            ['Letkol Ckm Drs. Basuki, MS', 'Tahun 1997 s.d 2001'],
            ['Letkol Ckm dr. Bambang Haryatno, Sp. S', 'Tahun 2001 s.d 2004'],
            ['Letkol Ckm dr. Muhammad Ilyas, Sp. An', 'Tahun 2004 s.d 2006'],
            ['Letkol Ckm dr. Agus Sunandar, Sp. An', 'Tahun 2006 s.d 2009'],
            ['Letkol Ckm dr. Trio Tangkas W.M, Sp. PD', 'Tahun 2009 s.d 2013'],
            ['Letkol Ckm (K) dr. Dwi Ana Wahyuningrum', 'Februari 2013 s.d Desember 2013'],
            ['Letkol Ckm dr. A Rusli Budi Ansyah, Sp. B., MARS', '1 Maret 2013 s.d Maret 2016'],
            ['Letkol Ckm dr. Masri Sihombing, Sp.OT (K)., M.Kes', '1 April 2016 s.d Agustus 2018'],
            ['Letkol Ckm dr. Maksum Pandelima, Sp.OT', '1 September 2018 s.d Januari 2021'],
            ['Letkol Ckm dr. Mahyudi Sp.M., M.Kes', 'Januari 2021 s.d Mei 2023'],
            ['Letkol Ckm dr. Arif Puguh Santoso, Sp.PD., M.Kes', 'Mei 2023 s.d Agustus 2025'],
            ['Letkol Ckm dr. Zaltonys Tolombot, Sp.M', 'Agustus 2025 s.d Sekarang']
        ] as $karumkit)
        <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index > 1 ? 0 : $loop->index * 50 }}"> 
            <div class="card border-success h-100 shadow-sm transition hover-shadow">
                <div class="card-body">
                    <h6 class="card-title text-success fw-bold">{{ $karumkit[0] }}</h6>
                    <p class="card-text text-muted small">Menjabat pada periode: <strong>{{ $karumkit[1] }}</strong></p>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </section>


    {{-- CTA Penutup --}}
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="/kontak" class="btn btn-success btn-lg shadow-lg transition hover-shadow">Hubungi Kami</a>
      <p class="text-muted mt-2 small">Untuk informasi lebih lanjut atau pertanyaan seputar layanan RS, silakan klik tombol di atas.</p>
    </div>

  </div>
</div>
@endsection