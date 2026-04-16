@extends('layouts.app')

@section('content')
<style>
    .premium-form-container {
        font-family: 'Inter', sans-serif;
        background: #fdfdfd;
        min-height: 100vh;
        padding-top: 3rem;
        padding-bottom: 5rem;
    }
    .service-card {
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .card-header-premium {
        background: linear-gradient(135deg, #ffc107 0%, #ffca28 100%);
        padding: 3rem 2rem;
        text-align: center;
        color: #000;
    }
    .btn-kirim {
        border-radius: 15px;
        padding: 1rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        background: #ffc107;
        border: none;
        color: #000;
    }
    .btn-kirim:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 193, 7, 0.3);
        background: #ffca28;
    }
    .form-control {
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        border: 1.5px solid #eee;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.1);
    }
    .floating-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>

<div class="premium-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="service-card" data-aos="zoom-in">
                    <div class="card-header-premium">
                        <div class="floating-icon"><i class="bi bi-house-heart"></i></div>
                        <h2 class="fw-bold mb-1">SANTARDEKATE</h2>
                        <p class="mb-0 opacity-75">Layanan Antar Pesanan Koperasi Rumah Sakit</p>
                    </div>
                    
                    <div class="p-4 p-md-5">
                        <form id="santarkateForm">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase">Nama Lengkap Pasien</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama pasien" oninput="validateForm()">
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase">Nomor WhatsApp</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Contoh: 081234567890" oninput="validateForm()">
                                <div id="phone-error" class="text-danger small mt-1 d-none">Nomor WA harus angka (minimal 10 digit)</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase">Nama Ruangan / Kamar</label>
                                <input type="text" id="ruangan" name="ruangan" class="form-control" placeholder="Contoh: Teratai No. 5" oninput="validateForm()">
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase">Detail Belanja / Pesanan</label>
                                <textarea id="belanja" name="belanja" class="form-control" rows="4" placeholder="Sebutkan item yang dipesan dan jumlahnya" oninput="validateForm()"></textarea>
                            </div>

                            <button type="button" id="btnSubmit" onclick="handleSubmit()" class="btn btn-kirim w-100 shadow" disabled>
                                <i class="bi bi-send me-2"></i> <span id="btnText">KIRIM PESANAN</span>
                            </button>
                            
                            <p id="error-msg" class="text-danger small mt-3 text-center fw-bold">Lengkapi semua data untuk memesan</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-body text-center p-5">
                <div class="bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-check-circle-fill fs-1"></i>
                </div>
                <h3 class="fw-bold mb-3">Pesanan Terkirim!</h3>
                <p class="text-muted mb-4">Silahkan tunggu, petugas koperasi kami akan menghubungi anda untuk konfirmasi pesanan.</p>
                <button type="button" class="btn btn-warning w-100 py-3 rounded-pill fw-bold text-white shadow-sm" data-bs-dismiss="modal">SIAP, TERIMA KASIH</button>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const ruangan = document.getElementById('ruangan').value;
        const belanja = document.getElementById('belanja').value;
        const btnSubmit = document.getElementById('btnSubmit');
        const errorMsg = document.getElementById('error-msg');
        const phoneError = document.getElementById('phone-error');

        // Regex for numeric only
        const isPhoneValid = /^[0-9]+$/.test(phone) && phone.length >= 10;
        
        if (phone && !isPhoneValid) {
            phoneError.classList.remove('d-none');
        } else {
            phoneError.classList.add('d-none');
        }

        const isValid = name.trim() !== '' && isPhoneValid && ruangan.trim() !== '' && belanja.trim() !== '';

        btnSubmit.disabled = !isValid;
        if (isValid) {
            errorMsg.classList.add('d-none');
        } else {
            errorMsg.classList.remove('d-none');
        }
    }

    async function handleSubmit() {
        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        
        btnSubmit.disabled = true;
        btnText.innerText = "MENGIRIM...";

        const formData = {
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            ruangan: document.getElementById('ruangan').value,
            belanja: document.getElementById('belanja').value,
            _token: document.querySelector('input[name="_token"]').value
        };

        try {
            const response = await fetch('/santardekate/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': formData._token
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.success) {
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
                document.getElementById('santarkateForm').reset();
                validateForm();
            } else {
                alert("Gagal mengirim pesanan: " + (result.message || "Terjadi kesalahan"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan sistem. Silakan coba lagi nanti.");
        } finally {
            btnSubmit.disabled = false;
            btnText.innerText = "KIRIM PESANAN";
        }
    }
</script>
@endsection
