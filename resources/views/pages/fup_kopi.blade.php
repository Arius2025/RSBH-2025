@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .premium-container { font-family: 'Inter', sans-serif; background-color: #f8fafc; padding-top: 2rem; padding-bottom: 5rem; }
    .luxury-shadow { box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02); }
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 28px; }
    .btn-submit { background: linear-gradient(135deg, #4e21f1 0%, #3a19b5 100%); border: none; padding: 16px; border-radius: 16px; font-weight: 700; color: white; transition: all 0.4s ease; }
    .btn-submit:hover:not(:disabled) { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(78, 33, 241, 0.3); }
    .form-control { border-radius: 14px; padding: 14px 16px; border: 2px solid #e2e8f0; background-color: #f8fafc; transition: all 0.3s ease; font-weight: 500; }
    .form-control:focus { background-color: #ffffff; border-color: #4e21f1; box-shadow: 0 0 0 4px rgba(78, 33, 241, 0.1); }
    
    .status-badge {
        background: rgba(78, 33, 241, 0.08); color: #4e21f1; font-size: 0.7rem;
        font-weight: 800; padding: 6px 12px; border-radius: 50px; text-transform: uppercase;
        letter-spacing: 0.5px; border: 1px solid rgba(78, 33, 241, 0.2);
    }
</style>

<div class="container premium-container py-4">
    <div class="row g-4 justify-content-center" data-aos="fade-up">
        <div class="col-lg-6">
            <div class="form-section p-4 p-md-5 luxury-shadow glass-card border-0">
                <div class="text-center mb-4">
                    <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3">
                        <i class="bi bi-phone-fill text-primary fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-dark">FUP Kopi</h3>
                    <p class="text-muted">Follow Up Pasien Kemoterapi - RS Tk. III Baladhika Husada</p>
                    <span class="status-badge">Formulir Pemantauan Pasien</span>
                </div>

                <form id="fupKopiForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase">No. Rekam Medis (RM)</label>
                            <input type="text" id="wa_rm" class="form-control" placeholder="Contoh: 123456" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Nama Lengkap Pasien</label>
                            <input type="text" id="wa_name" class="form-control" placeholder="Nama sesuai KTP" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Tanggal Kemoterapi Terakhir</label>
                        <input type="date" id="wa_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase">Kondisi / Keluhan Saat Ini</label>
                        <textarea id="wa_complaint" class="form-control" rows="4" placeholder="Sebutkan keluhan jika ada (mual, pusing, lemas, dll)..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase">No. Telepon / WhatsApp Aktif</label>
                        <input type="tel" id="wa_phone" class="form-control" placeholder="Contoh: 081234567890" required>
                    </div>

                    <button type="button" id="btnSubmit" onclick="handleSubmit()" class="btn btn-primary btn-submit w-100 shadow">
                        <i class="bi bi-send me-2"></i> <span id="btnText">KIRIM DATA FOLLOW UP</span>
                    </button>
                    <p id="error-msg" class="text-danger small mt-3 text-center fw-bold" style="display: none;">Mohon lengkapi seluruh data formulir</p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-primary" style="font-size: 5rem;"></i>
                </div>
                <h3 class="fw-bold text-dark mb-3">Data Terkirim!</h3>
                <p class="text-muted mb-4">Terima kasih telah mengisi form follow up. Petugas kami akan segera meninjau kondisi Anda.</p>
                <button type="button" class="btn btn-primary px-5 rounded-pill" data-bs-dismiss="modal">OKE</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function handleSubmit() {
        const rm = document.getElementById('wa_rm').value;
        const name = document.getElementById('wa_name').value;
        const date = document.getElementById('wa_date').value;
        const complaint = document.getElementById('wa_complaint').value;
        const phone = document.getElementById('wa_phone').value;
        const btn = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        const errorMsg = document.getElementById('error-msg');

        if (!rm || !name || !date || !complaint || !phone) {
            errorMsg.style.display = 'block';
            return;
        }
        errorMsg.style.display = 'none';

        btn.disabled = true;
        btnText.innerText = "MENGIRIM...";

        try {
            const response = await fetch("{{ route('fup_kopi.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ rm, name, date, complaint, phone })
            });

            const result = await response.json();

            if (result.success) {
                // WhatsApp notification
                const waNumber = "6285330115991"; // Tim Komplain/Follow Up
                const waMessage = `*Pesan FUP Kopi (Follow Up Kemoterapi)*\n\n- RM: ${rm}\n- Nama: ${name}\n- Tgl Kemo: ${date}\n- Keluhan: ${complaint}\n- WA: ${phone}`;
                const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;
                
                const myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
                
                setTimeout(() => {
                    window.open(waUrl, '_blank');
                }, 1000);
                
                document.getElementById('fupKopiForm').reset();
            } else {
                alert("Gagal mengirim data: " + (result.message || "Kesalahan tidak diketahui"));
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            alert("Terjadi kesalahan teknis. Silakan coba lagi.");
        } finally {
            btn.disabled = false;
            btnText.innerText = "KIRIM DATA FOLLOW UP";
        }
    }
</script>
@endsection
