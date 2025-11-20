{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <h4 class="fw-bold text-success text-center mb-4">Masuk ke Panel Admin</h4>

    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        {{-- Email Address --}}
        <div class="mb-3 input-group has-validation" data-input="email">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus autocomplete="username" />
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3 input-group has-validation" data-input="password">
            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
            <input id="password" class="form-control" type="password" name="password" placeholder="Kata Sandi" required autocomplete="current-password" />
            <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Tampilkan Kata Sandi">
                <i class="bi bi-eye"></i>
            </button>
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Remember Me & Forgot Password --}}
        <div class="form-check mb-4 d-flex justify-content-between align-items-center">
            <div>
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">{{ __('Ingat Saya') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-success text-decoration-none small fw-semibold" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-right me-2"></i> {{ __('Masuk ke Dashboard') }}
            </button>
        </div>
    </form>
    
    <hr class="my-4">

    {{-- TOMBOL KE REGISTER --}}
    <div class="text-center">
        <p class="mb-2 text-muted small">Anda belum terdaftar sebagai Admin?</p>
        <a href="{{ route('register') }}" class="btn btn-outline-success w-100 fw-bold">
            <i class="bi bi-person-plus-fill me-2"></i> {{ __('Daftar Akun Baru') }}
        </a>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // JS 1: Toggle Password Visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = togglePassword.querySelector('i');

            if (togglePassword) {
                togglePassword.addEventListener('click', function (e) {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    toggleIcon.classList.toggle('bi-eye');
                    toggleIcon.classList.toggle('bi-eye-slash');
                });
            }

            // JS 2: Simple Form Validation Feedback (Bootstrap style)
            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
    @endpush
</x-guest-layout>