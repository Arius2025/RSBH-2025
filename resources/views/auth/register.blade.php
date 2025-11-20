{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <h4 class="fw-bold text-success text-center mb-4">Daftar Akun Admin Baru</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="mb-3 input-group has-validation">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus autocomplete="name" />
            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Email Address --}}
        <div class="mb-3 input-group has-validation">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="username" />
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3 input-group has-validation">
            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
            <input id="password" class="form-control" type="password" name="password" placeholder="Kata Sandi" required autocomplete="new-password" />
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3 input-group has-validation">
            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password" />
            @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                {{ __('Daftar Akun') }}
            </button>
        </div>
    </form>
    
    <hr class="my-4">

    <div class="text-center">
        <p class="mb-2 text-muted small">Sudah punya akun?</p>
        <a class="btn btn-outline-secondary w-100 fw-bold" href="{{ route('login') }}">
            {{ __('Kembali ke Login') }}
        </a>
    </div>

</x-guest-layout>