<x-guest-layout>
    <h4 class="fw-bold text-success text-center mb-4">Masuk ke Panel Admin</h4>

    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        {{-- Email Address --}}
        <div class="mb-3">
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus />
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                <input id="password" class="form-control" type="password" name="password" placeholder="Kata Sandi" required />
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Remember & Forgot --}}
        <div class="form-check mb-4 d-flex justify-content-between">
            <div>
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Ingat Saya</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-success text-decoration-none small fw-semibold" href="{{ route('password.request') }}">Lupa Password?</a>
            @endif
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
            </button>
        </div>
    </form>
    
    <div class="text-center mt-4">
        <p class="mb-2 text-muted small">Belum terdaftar sebagai Admin?</p>
        <a href="{{ route('register') }}" class="btn btn-outline-success w-100 fw-bold">Daftar Akun Baru</a>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnToggle = document.querySelector('#togglePassword');
            const inputPass = document.querySelector('#password');

            if (btnToggle && inputPass) {
                btnToggle.addEventListener('click', function () {
                    const icon = this.querySelector('i');
                    
                    if (inputPass.type === 'password') {
                        inputPass.type = 'text';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                        // Opsional: ganti warna button saat aktif
                        this.classList.add('btn-secondary');
                        this.classList.remove('btn-outline-secondary');
                    } else {
                        inputPass.type = 'password';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                        this.classList.add('btn-outline-secondary');
                        this.classList.remove('btn-secondary');
                    }
                });
            }
        });
    </script>
    @endpush
</x-guest-layout>