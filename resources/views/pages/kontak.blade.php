@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-down">
        <h2 class="fw-bold display-5 text-success">Hubungi Kami</h2>
        <p class="lead text-muted">RS Tk. III Baladhika Husada Jember siap melayani Anda 24 Jam.</p>
        <hr class="w-25 mx-auto border-success border-3 opacity-75">
    </div>

    <div class="row g-4">
        <div class="col-lg-5" data-aos="fade-right">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white">
                <h4 class="fw-bold text-success mb-4">Informasi Kontak</h4>
                
                <div class="d-flex mb-4">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat</h6>
                        <p class="text-muted mb-0">Jl. Panglima Besar Sudirman No.45, Patrang, Jember, Jawa Timur 68118</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                        <i class="bi bi-telephone-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon (IGD/Informasi)</h6>
                        <p class="text-muted mb-0">+62 331 484674</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                        <i class="bi bi-clock-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Operasional</h6>
                        <p class="text-muted mb-0">Buka 24 Jam (Setiap Hari)</p>
                    </div>
                </div>

                <div class="rounded-4 overflow-hidden mt-2 shadow-sm border" style="height: 350px;">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.435728873523!2d113.70425027589578!3d-8.158763581739504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6953bc4478627%3A0x4568cb1a5d56572d!2sRS%20Tk.%20III%20Baladhika%20Husada!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<a href="https://www.google.com/maps/place/Rumah+Sakit+Baladhika+Husada+(RS+DKT)+Jember/@-8.1639433,113.7035974,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd6943bb3448627:0x4568cb1a5d56572d!8m2!3d-8.1639486!4d113.7061723!16s%2Fg%2F1pzx5ytnd?entry=ttu&g_ep=EgoyMDI2MDEwNC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="btn btn-sm btn-outline-success mt-2 w-100">
    <i class="bi bi-map"></i> Buka di Google Maps
</a>
            </div>
        </div>

        <div class="col-lg-7" data-aos="fade-left">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                <h4 class="fw-bold text-success mb-4">Kirim Pesan atau Pertanyaan</h4>
                
                <form id="whatsappForm">
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" id="wa_name" class="form-control rounded-3 border-2 py-2" placeholder="Nama Anda" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Subjek</label>
            <select id="wa_subject" class="form-select rounded-3 border-2 py-2">
                <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                <option value="Jadwal Dokter">Jadwal Dokter</option>
                <option value="Saran/Kritik">Saran & Kritik</option>
            </select>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Pesan Anda</label>
            <textarea id="wa_message" class="form-control rounded-3 border-2 py-2" rows="5" placeholder="Tuliskan pesan..." required></textarea>
        </div>
        <div class="col-12 mt-4">
            <button type="button" onclick="sendToWhatsApp()" class="btn btn-success w-100 py-3 fw-bold rounded-pill shadow-sm">
                <i class="bi bi-whatsapp me-2"></i> Kirim ke WhatsApp
            </button>
        </div>
    </div>
</form>

<script>
function sendToWhatsApp() {
    // Nomor WA RS (Ganti dengan nomor aslinya, awali dengan 62)
    const phoneNumber = "6281387841253"; 
    
    const name = document.getElementById('wa_name').value;
    const subject = document.getElementById('wa_subject').value;
    const message = document.getElementById('wa_message').value;

    if(name == "" || message == ""){
        alert("Mohon lengkapi nama dan pesan.");
        return;
    }

    // Format Pesan
    const text = `Halo Admin RS Baladhika Husada,%0A%0A` +
                 `*Nama:* ${name}%0A` +
                 `*Subjek:* ${subject}%0A` +
                 `*Pesan:* ${message}`;

    // Redirect ke Link WhatsApp
    const waLink = `https://wa.me/${phoneNumber}?text=${text}`;
    window.open(waLink, '_blank');
}

</script>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #2ecc71;
        box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.1);
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2) !important;
    }
    .rounded-4 { border-radius: 1.5rem !important; }
</style>
@endsection