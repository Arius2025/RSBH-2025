{{-- komplain.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-gradient-success text-white text-center position-relative overflow-hidden">
        <div class="container py-4 position-relative z-1">
            <span class="badge bg-white bg-opacity-20 text-white px-3 py-1 mb-2 fw-semibold rounded-2"><i
                    class="bi bi-shield-check me-1"></i> Unit Pengaduan Masyarakat</span>
            <h1 class="display-5 fw-bold mb-2">Layanan Pengaduan & Keluhan</h1>
            <p class="lead opacity-90 mb-0 mx-auto" style="max-width: 650px;">
                Sampaikan keluhan, kritik, atau saran pelayanan Rumah Sakit Tk. III Baladhika Husada secara langsung maupun tertulis kepada Tim Komplain resmi kami.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5 bg-light position-relative">
        <div class="container">
            <div class="row g-4 justify-content-center mb-5">
                <!-- Komplain Online -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-3 p-4 p-md-5 shadow-sm h-100 border border-secondary border-opacity-25 border-top-0 border-end-0 border-bottom-0 border-start border-4 border-success d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="text-success fw-bold mb-2"><i class="bi bi-phone me-2"></i> Kanal Aduan Digital</h4>
                            <p class="text-muted small mb-4">Penyampaian keluhan atau saran melalui WhatsApp atau formulir pengaduan rumah sakit.</p>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <a href="https://wa.me/6281387841253" target="_blank" rel="noopener noreferrer" aria-label="Buka WhatsApp Pengaduan Rumah Sakit"
                                        class="d-flex flex-column align-items-center justify-content-center p-3 rounded-3 text-center text-decoration-none h-100 border border-success border-opacity-25 bg-light hover-lift">
                                        <img src="{{ asset('images/komplain/qrkomplainwa.jpeg') }}" alt="QR Code WhatsApp Pengaduan"
                                            class="img-fluid rounded-2 shadow-sm mb-2"
                                            style="max-width: 110px; width: 100%; aspect-ratio: 1/1; object-fit: contain; border: 1px solid #25D366;">
                                        <span class="text-dark fw-bold mb-1 fs-7">WhatsApp Pengaduan</span>
                                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 0.72rem;">0813 8784 1253</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="https://link.rs-bh.site/KomplainDKT" target="_blank" rel="noopener noreferrer" aria-label="Buka Google Form Pengaduan Rumah Sakit"
                                        class="d-flex flex-column align-items-center justify-content-center p-3 rounded-3 text-center text-decoration-none h-100 border border-primary border-opacity-25 bg-light hover-lift">
                                        <img src="{{ asset('images/komplain/qrkomplainform.png') }}" alt="QR Code Formulir Pengaduan Digital"
                                            class="img-fluid rounded-2 shadow-sm mb-2"
                                            style="max-width: 110px; width: 100%; aspect-ratio: 1/1; object-fit: contain; border: 1px solid #4285F4;">
                                        <span class="text-dark fw-bold mb-1 fs-7">Google Forms</span>
                                        <span class="badge bg-primary text-white px-2 py-1" style="font-size: 0.72rem;">Formulir Digital RS</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- SP4N-LAPOR! Institutional Card -->
                        <div class="pt-3 border-top border-secondary border-opacity-10">
                            <div class="card border rounded-3 p-3 p-md-4 text-center bg-white shadow-sm">
                                <div class="mb-2 d-flex justify-content-center align-items-center text-center">
                                    <img src="{{ asset('images/komplain/lapor.png') }}" alt="Logo SP4N-LAPOR!"
                                        class="img-fluid mx-auto d-block" style="height: 48px; width: 48px; object-fit: contain; margin-left: auto; margin-right: auto;">
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Portal Resmi SP4N-LAPOR!</h6>
                                <div class="mb-2 d-flex justify-content-center">
                                    <span class="badge bg-danger-subtle text-danger rounded-1 px-2 py-1" style="font-size: 0.72rem;">Kanal Pengaduan Nasional RI</span>
                                </div>
                                <p class="text-muted small mb-3" style="font-size: 0.82rem; line-height: 1.4;">
                                    Layanan Aspirasi & Pengaduan Online Rakyat terintegrasi kementerian dan lembaga pemerintah.
                                </p>
                                <a href="https://www.lapor.go.id/instansi/rumkit-tkiii-baladhika-husada-jember" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-danger w-100 fw-bold py-2 shadow-sm rounded-2 d-inline-flex align-items-center justify-content-center hover-lift"
                                    style="min-height: 44px;" aria-label="Sampaikan Laporan melalui Portal Resmi SP4N-LAPOR!">
                                    Sampaikan Laporan di SP4N-LAPOR! <i class="bi bi-box-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Narahubung -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-3 p-4 p-md-5 shadow-sm h-100 border border-secondary border-opacity-25 border-top-0 border-end-0 border-bottom-0 border-start border-4 border-success">
                        <h4 class="text-success fw-bold mb-2"><i class="bi bi-person-lines-fill me-2"></i> Kontak Narahubung Pengaduan</h4>
                        <p class="text-muted small mb-4">Hubungi penanggung jawab bidang terkait jika Anda membutuhkan tindak lanjut atau penanganan langsung.</p>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-light border-0 mb-3 rounded-3 p-3 shadow-sm contact-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-dark fs-6">KAPTEN CKM MUSTAR EFENDI</strong>
                                        <div class="text-success fw-semibold small">Ketua Tim Komplain</div>
                                    </div>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-1">Ketua</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <a href="tel:087870911995" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn" aria-label="Telepon Kapten Ckm Mustar Efendi di 0878-7091-1995">
                                        <i class="bi bi-telephone-fill me-1"></i> 0878-7091-1995
                                    </a>
                                    <a href="https://wa.me/6287870911995" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success rounded-2 px-3 action-touch-btn" aria-label="Chat WhatsApp Kapten Ckm Mustar Efendi">
                                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                    </a>
                                </div>
                            </li>
                            <li class="list-group-item bg-light border-0 mb-3 rounded-3 p-3 shadow-sm contact-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-dark fs-6">PELTU SYAMSUL ARIFIN, S.Kep. Ners</strong>
                                        <div class="text-success fw-semibold small">Komplain Pelayanan Medis</div>
                                    </div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-1">Medis</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <a href="tel:081235677415" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn" aria-label="Telepon Peltu Syamsul Arifin di 0812-3567-7415">
                                        <i class="bi bi-telephone-fill me-1"></i> 0812-3567-7415
                                    </a>
                                    <a href="https://wa.me/6281235677415" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success rounded-2 px-3 action-touch-btn" aria-label="Chat WhatsApp Peltu Syamsul Arifin">
                                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                    </a>
                                </div>
                            </li>
                            <li class="list-group-item bg-light border-0 mb-3 rounded-3 p-3 shadow-sm contact-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-dark fs-6">PNS A'JALIL ACHBAB, S.Kep., Ners., MM. M.Kes</strong>
                                        <div class="text-success fw-semibold small">Komplain BPJS</div>
                                    </div>
                                    <span class="badge bg-warning bg-opacity-10 text-warning-emphasis rounded-1">BPJS</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <a href="tel:08123481945" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn" aria-label="Telepon PNS A'Jalil Achbab di 0812-3481-945">
                                        <i class="bi bi-telephone-fill me-1"></i> 0812-3481-945
                                    </a>
                                    <a href="https://wa.me/628123481945" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success rounded-2 px-3 action-touch-btn" aria-label="Chat WhatsApp PNS A'Jalil Achbab">
                                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                    </a>
                                </div>
                            </li>
                            <li class="list-group-item bg-light border-0 mb-2 rounded-3 p-3 shadow-sm contact-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-dark fs-6">PELTU EDI SUBAGIO, S.Kep. Ners</strong>
                                        <div class="text-success fw-semibold small">Komplain Pengamanan</div>
                                    </div>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-1">Pengamanan</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <a href="tel:082143024047" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn" aria-label="Telepon Peltu Edi Subagio di 0821-4302-4047">
                                        <i class="bi bi-telephone-fill me-1"></i> 0821-4302-4047
                                    </a>
                                    <a href="https://wa.me/6282143024047" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success rounded-2 px-3 action-touch-btn" aria-label="Chat WhatsApp Peltu Edi Subagio">
                                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Alur Pengaduan --}}
            <div class="row justify-content-center mt-5" data-aos="fade-up">
                <div class="col-lg-10 text-center mb-4">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 fw-semibold mb-2 rounded-2">Bagan Alur & Narahubung Resmi</span>
                    <h3 class="text-dark fw-bold">Alur Layanan & Narahubung Pengaduan</h3>
                    <p class="text-muted">Informasi alur penanganan keluhan dan kontak resmi RS Tk. III Baladhika Husada Jember.</p>
                </div>

                <div class="col-lg-12">
                    <div class="bg-white rounded-3 p-3 p-md-5 border shadow-sm">
                        <div class="row g-4 justify-content-center">
                            <div class="col-lg-6 col-md-10" data-aos="fade-right" data-aos-delay="100">
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold text-success"><i class="bi bi-diagram-3-fill me-2"></i> Bagan Alur Layanan Pengaduan</h5>
                                    <span class="badge bg-success-subtle text-success rounded-1">Pengaduan Langsung & Tidak Langsung</span>
                                </div>
                                <div class="card border rounded-3 overflow-hidden bg-white p-2 p-md-3 shadow-sm">
                                    <a href="{{ asset('images/komplain/alur-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/alur-pengaduan.jpg')) ? filemtime(public_path('images/komplain/alur-pengaduan.jpg')) : '2' }}" target="_blank" rel="noopener noreferrer" class="d-block text-center" aria-label="Buka gambar Alur Layanan Pengaduan ukuran penuh">
                                        <img src="{{ asset('images/komplain/alur-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/alur-pengaduan.jpg')) ? filemtime(public_path('images/komplain/alur-pengaduan.jpg')) : '2' }}" alt="Bagan Alur Layanan Pengaduan RS Tk. III Baladhika Husada"
                                            class="img-fluid rounded-2 w-100 hover-lift"
                                            style="width: 100%; display: block;">
                                    </a>
                                    <div class="text-center pt-3 pb-1">
                                        <a href="{{ asset('images/komplain/alur-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/alur-pengaduan.jpg')) ? filemtime(public_path('images/komplain/alur-pengaduan.jpg')) : '2' }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn fw-semibold" aria-label="Buka Alur Layanan Pengaduan dalam resolusi penuh">
                                            <i class="bi bi-arrows-fullscreen me-1"></i> Buka Resolusi Penuh
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-10" data-aos="fade-left" data-aos-delay="200">
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold text-success"><i class="bi bi-card-image me-2"></i> Poster Layanan & Narahubung</h5>
                                    <span class="badge bg-primary-subtle text-primary rounded-1">Tim Komplain & Kanal Resmi</span>
                                </div>
                                <div class="card border rounded-3 overflow-hidden bg-white p-2 p-md-3 shadow-sm">
                                    <a href="{{ asset('images/komplain/layanan-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/layanan-pengaduan.jpg')) ? filemtime(public_path('images/komplain/layanan-pengaduan.jpg')) : '2' }}" target="_blank" rel="noopener noreferrer" class="d-block text-center" aria-label="Buka poster Layanan Pengaduan ukuran penuh">
                                        <img src="{{ asset('images/komplain/layanan-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/layanan-pengaduan.jpg')) ? filemtime(public_path('images/komplain/layanan-pengaduan.jpg')) : '2' }}" alt="Poster Layanan Pengaduan RS Tk. III Baladhika Husada"
                                            class="img-fluid rounded-2 w-100 hover-lift"
                                            style="width: 100%; display: block;">
                                    </a>
                                    <div class="text-center pt-3 pb-1">
                                        <a href="{{ asset('images/komplain/layanan-pengaduan.jpg') }}?v={{ file_exists(public_path('images/komplain/layanan-pengaduan.jpg')) ? filemtime(public_path('images/komplain/layanan-pengaduan.jpg')) : '2' }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-2 px-3 action-touch-btn fw-semibold" aria-label="Buka Poster Layanan Pengaduan dalam resolusi penuh">
                                            <i class="bi bi-arrows-fullscreen me-1"></i> Buka Resolusi Penuh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FLOATING WIDGET (Komplain Form) -->
    <div class="floating-widget-container" id="floatingWidgetContainer">

        <!-- Widget Form Box -->
        <div class="card border shadow-lg rounded-3 overflow-hidden mb-3 floating-form-box" id="floatingFormBox" role="dialog" aria-labelledby="floatingFormTitle" aria-modal="true">
            <!-- Header -->
            <div class="bg-success text-white px-4 py-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-4 me-2"></i>
                    <div>
                        <h6 class="mb-0 fw-bold" id="floatingFormTitle">Formulir Pengaduan Cepat</h6>
                        <small class="opacity-90" style="font-size: 0.75rem;">RS Tk. III Baladhika Husada</small>
                    </div>
                </div>
                <button type="button" class="btn btn-sm text-white p-2" id="closeWidgetBtn" aria-label="Tutup formulir pengaduan"
                    style="min-width: 44px; min-height: 44px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="bi bi-x-lg fs-5"></i>
                </button>
            </div>

            <!-- Form Body -->
            <div class="card-body bg-white p-4 custom-scrollbar"
                style="max-height: 450px; overflow-y: auto;">
                <div class="alert alert-success border-0 rounded-2 mb-3 p-3 d-flex align-items-start bg-success-subtle text-success-emphasis" role="note">
                    <i class="bi bi-info-circle-fill fs-5 me-2 mt-0 flex-shrink-0"></i>
                    <p class="mb-0 small" style="font-size: 0.82rem; line-height: 1.4;">Laporan Anda terkirim langsung ke tim komplain kami secara aman.</p>
                </div>

                <form id="directKomplainForm"
                    action="https://docs.google.com/forms/d/e/1FAIpQLSeDICgltd90k_PIB4NmBqb0GSCvcmBD0pOluN0J9Ubt6zqtVA/formResponse"
                    method="POST" target="hidden_iframe" onsubmit="submitted=true;">
                    <div class="mb-3">
                        <label for="inputNama" class="form-label fw-bold text-dark fs-7">Inisial / Nama Lengkap <span
                                class="text-danger">*</span></label>
                        <input type="text" name="entry.1873273556" id="inputNama" class="form-control form-input-solid shadow-none"
                            required placeholder="Contoh: NN atau Budi Santoso">
                    </div>
                    <div class="mb-4">
                        <label for="inputPesan" class="form-label fw-bold text-dark fs-7">Isi Pengaduan / Masukan <span
                                class="text-danger">*</span></label>
                        <textarea name="entry.1349614790" id="inputPesan" class="form-control form-input-solid shadow-none"
                            rows="4" required placeholder="Jelaskan kronologi, tanggal/waktu, atau rincian pelayanan yang perlu disampaikan..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-2 fw-bold shadow-sm py-2 d-inline-flex align-items-center justify-content-center"
                        style="min-height: 44px;">
                        Kirim Laporan <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </form>

                <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;" title="Frame pengiriman formulir"
                    onload="if(submitted){ showSuccessAlert(); }"></iframe>
            </div>
        </div>

        <!-- Floating Action Button (FAB) -->
        <button class="btn btn-success shadow floating-btn rounded-pill d-flex align-items-center" id="openWidgetBtn" aria-label="Buka formulir pengaduan cepat">
            <i class="bi bi-chat-left-text-fill fs-5 me-2"></i>
            <span class="fw-bold">Buat Laporan</span>
        </button>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            var submitted = false;

            document.addEventListener("DOMContentLoaded", function () {
                // Widget Toggle Logic
                const widgetContainer = document.getElementById('floatingWidgetContainer');
                const openBtn = document.getElementById('openWidgetBtn');
                const closeBtn = document.getElementById('closeWidgetBtn');

                if (openBtn && closeBtn && widgetContainer) {
                    openBtn.addEventListener('click', function () {
                        widgetContainer.classList.add('widget-open');
                        const inputNama = document.getElementById('inputNama');
                        if (inputNama) inputNama.focus();
                    });

                    closeBtn.addEventListener('click', function () {
                        widgetContainer.classList.remove('widget-open');
                        openBtn.focus();
                    });

                    // Keyboard Escape handling
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape' && widgetContainer.classList.contains('widget-open')) {
                            widgetContainer.classList.remove('widget-open');
                            openBtn.focus();
                        }
                    });
                }
            });

            function showSuccessAlert() {
                // Reset form
                const form = document.getElementById('directKomplainForm');
                if (form) form.reset();

                // Hide widget
                const widgetContainer = document.getElementById('floatingWidgetContainer');
                if (widgetContainer) widgetContainer.classList.remove('widget-open');

                // Show success alert
                Swal.fire({
                    title: 'Berhasil Terkirim!',
                    text: 'Terima kasih, laporan/saran Anda telah berhasil masuk ke sistem kami.',
                    icon: 'success',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#198754',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-3 shadow-lg',
                        confirmButton: 'rounded-2 px-4 fw-bold'
                    }
                });

                submitted = false; // Reset status
            }
        </script>
    @endpush

    <style>
        .bg-gradient-success {
            background-color: #115c39;
            background-image: linear-gradient(135deg, #115c39 0%, #198754 100%);
        }

        .contact-card {
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .contact-card:hover {
            transform: translateY(-2px);
            background: #ffffff !important;
            border-color: #198754 !important;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.12) !important;
        }

        .action-touch-btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .form-input-solid {
            background: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.65rem 0.85rem;
            font-size: 0.9rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-input-solid:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            outline: 0;
        }

        /* Floating Widget Styles */
        .floating-widget-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .floating-btn {
            padding: 12px 20px;
            min-height: 48px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .floating-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(25, 135, 84, 0.3) !important;
        }

        .floating-form-box {
            width: 380px;
            max-width: calc(100vw - 32px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(16px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
        }

        .widget-open .floating-form-box {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .widget-open .floating-btn {
            display: none !important;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .fs-7 {
            font-size: 0.85rem;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08) !important;
        }

        /* Keyboard Focus Visible */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible {
            outline: 2px solid #198754;
            outline-offset: 2px;
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
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
            }

            #closeWidgetBtn {
                display: none !important;
            }
        }
    </style>
@endsection