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
            <div class="row text-center g-3">
              <div class="col-6">
                <a href="https://wa.me/6285330115991" target="_blank" class="text-decoration-none transition hover-shadow d-block p-2 rounded bg-light border h-100 d-flex flex-column justify-content-center">
                    <img src="{{ asset('images/komplain/qrkomplainwa.avif') }}" alt="QR WhatsApp" class="img-fluid rounded shadow-sm mb-2 mx-auto" style="max-width: 120px;">
                    <p class="small text-success fw-bold mb-0">WhatsApp</p>
                </a>
              </div>
              <div class="col-6">
                <a href="https://forms.gle/nSrUJS9wSP5ieoNNA" target="_blank" class="text-decoration-none transition hover-shadow d-block p-2 rounded bg-light border h-100 d-flex flex-column justify-content-center">
                    <img src="{{ asset('images/komplain/qrkomplainform.avif') }}" alt="QR Google Form" class="img-fluid rounded shadow-sm mb-2 mx-auto" style="max-width: 120px;">
                    <p class="small text-success fw-bold mb-0">Google Forms</p>
                </a>
              </div>
              <div class="col-12 mt-3">
                <div class="p-4 rounded-3 border bg-white shadow-sm text-center">
                    <img src="{{ asset('images/komplain/lapor.png') }}" alt="Logo LAPOR" class="img-fluid mb-3" style="max-height: 45px;">
                    
                    <h6 class="fw-bold text-dark mb-2">Portal SP4N-LAPOR!</h6>
                    <p class="text-muted small mb-4 px-3">
                        Layanan Aspirasi dan Pengaduan Online Rakyat. Portal resmi pemerintah untuk pengaduan terintegrasi nasional.
                    </p>
                    
                    <a href="https://lapor.go.id/" target="_blank" class="btn btn-danger px-5 py-2 fw-bold shadow-sm rounded-pill">
                        Sampaikan Laporan <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                    </a>
                </div>
              </div>
            </div>
            <p class="text-center small text-muted mt-3 fst-italic">Pilih platform pengaduan yang paling nyaman bagi Anda.</p>
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

<!-- FLOATING WIDGET (Komplain Form) -->
<div class="floating-widget-container" id="floatingWidgetContainer">
    
    <!-- Widget Form Box -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-3 floating-form-box" id="floatingFormBox">
        <!-- Header -->
        <div class="bg-success text-white px-4 py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%);">
            <div class="d-flex align-items-center">
                <i class="bi bi-pencil-square fs-4 me-2"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Pengaduan Langsung</h6>
                    <small class="opacity-75" style="font-size: 0.75rem;">Tim Kami Siap Membantu</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-link text-white p-0" id="closeWidgetBtn" style="text-decoration: none;">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>
        
        <!-- Form Body -->
        <div class="card-body bg-white p-4 custom-scrollbar" style="max-height: 450px; overflow-y: auto; background-color: #fcfcfc;">
            <div class="alert alert-info border-0 rounded-3 mb-4 p-3 d-flex align-items-start" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);">
                <i class="bi bi-info-circle-fill text-info-emphasis fs-4 me-2 mt-1"></i>
                <p class="text-dark mb-0 opacity-75" style="font-size: 0.8rem;">Data Anda akan langsung tersimpan secara otomatis dan aman.</p>
            </div>

            <form id="directKomplainForm" action="https://docs.google.com/forms/d/e/1FAIpQLSeDICgltd90k_PIB4NmBqb0GSCvcmBD0pOluN0J9Ubt6zqtVA/formResponse" method="POST" target="hidden_iframe" onsubmit="submitted=true;">
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark fs-7">Inisial Nama <span class="text-danger">*</span></label>
                    <input type="text" name="entry.1873273556" id="inputNama" class="form-control apple-input shadow-sm" required placeholder="Contoh: NN atau Budi">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark fs-7">Saran / Keluhan <span class="text-danger">*</span></label>
                    <textarea name="entry.1349614790" id="inputPesan" class="form-control apple-input shadow-sm" rows="4" required placeholder="Tuliskan keluhan atau saran Anda..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold shadow-lg hover-lift py-2.5" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
                    Kirim Laporan <i class="bi bi-send-fill ms-1"></i>
                </button>
            </form>
            
            <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;" onload="if(submitted){ showSuccessAlert(); }"></iframe>
        </div>
    </div>

    <!-- Floating Action Button (FAB) -->
    <button class="btn btn-success shadow-lg floating-btn rounded-pill d-flex align-items-center" id="openWidgetBtn" style="background: linear-gradient(135deg, #198754 0%, #115c39 100%); border: none;">
        <i class="bi bi-chat-left-text-fill fs-5 me-2"></i>
        <span class="fw-bold">Buat Laporan</span>
    </button>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var submitted = false;
    
    document.addEventListener("DOMContentLoaded", function() {
        // Widget Toggle Logic
        const widgetContainer = document.getElementById('floatingWidgetContainer');
        const openBtn = document.getElementById('openWidgetBtn');
        const closeBtn = document.getElementById('closeWidgetBtn');
        
        openBtn.addEventListener('click', function() {
            widgetContainer.classList.add('widget-open');
        });

        closeBtn.addEventListener('click', function() {
            widgetContainer.classList.remove('widget-open');
        });
    });

    function showSuccessAlert() {
        // Reset form
        document.getElementById('directKomplainForm').reset();
        
        // Hide widget
        document.getElementById('floatingWidgetContainer').classList.remove('widget-open');
        
        // Show success alert
        Swal.fire({
            title: 'Berhasil Terkirim!',
            text: 'Terima kasih, laporan/saran Anda telah berhasil masuk ke sistem kami.',
            icon: 'success',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#198754',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-4 shadow-lg',
                confirmButton: 'rounded-pill px-4 fw-bold'
            }
        });
        
        submitted = false; // Reset status
    }
</script>
@endpush

<style>
.apple-input {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 0.75rem;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}
.apple-input:focus {
    background: #fff;
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15);
    outline: none;
}

/* Floating Widget Styles */
.floating-widget-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.floating-btn {
    padding: 12px 24px;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
.floating-btn:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 15px 25px rgba(25, 135, 84, 0.4) !important;
}

.floating-form-box {
    width: 380px;
    max-width: calc(100vw - 40px);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transform-origin: bottom right;
    transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    border-radius: 1rem;
}

.widget-open .floating-form-box {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.widget-open .floating-btn {
    display: none !important;
}

/* Custom Scrollbar for Widget Body */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8; 
}

.fs-7 {
    font-size: 0.85rem;
}

/* Hover Lift Effect */
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

@media (max-width: 768px) {
    .floating-widget-container {
        position: static;
        padding: 2rem 1rem;
        align-items: center;
    }
    .floating-btn {
        display: none !important;
    }
    .floating-form-box {
        width: 100%;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    #closeWidgetBtn {
        display: none !important;
    }
}
</style>
@endsection