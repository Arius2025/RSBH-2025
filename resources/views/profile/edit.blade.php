{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold text-success mb-4">Pengaturan Akun & Profil</h1>
    <p class="lead text-muted">Kelola informasi profil, email, dan kata sandi akun Anda.</p>
    <hr>
    
    <div class="row g-4">
        
        {{-- 1. Update Profile Information --}}
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="bi bi-person-circle me-2"></i> Informasi Profil
                </div>
                <div class="card-body">
                    {{-- Form untuk mengupdate Nama dan Email --}}
                    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            {{-- Cek jika Email sudah diverifikasi, ini fitur Laravel default --}}
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm mt-2 text-muted">
                                        E-mail Anda belum diverifikasi.
                                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                                            Klik di sini untuk mengirim ulang link verifikasi.
                                        </button>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex align-items-center gap-4 mt-4">
                            <button type="submit" class="btn btn-success transition hover-shadow">Simpan Perubahan</button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success fw-semibold mb-0">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 2. Update Password --}}
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark fw-bold">
                    <i class="bi bi-key-fill me-2"></i> Ganti Kata Sandi
                </div>
                <div class="card-body">
                    {{-- Form untuk mengupdate Kata Sandi --}}
                    <form method="post" action="{{ route('password.update') }}" class="mt-4">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Kata Sandi Saat Ini</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                            @error('current_password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" required>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center gap-4 mt-4">
                            <button type="submit" class="btn btn-warning text-dark transition hover-shadow">Simpan Kata Sandi Baru</button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success fw-semibold mb-0">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 3. Delete Account (Opsional, fitur standar Laravel) --}}
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 border-danger">
                <div class="card-header bg-danger text-white fw-bold">
                    <i class="bi bi-trash-fill me-2"></i> Hapus Akun
                </div>
                <div class="card-body">
                    <p class="text-muted">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                    
                    <button type="button" class="btn btn-danger transition hover-shadow" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL Konfirmasi Hapus Akun --}}
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmUserDeletionModalLabel">Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold">Anda yakin ingin menghapus akun Anda?</h6>
                <p class="text-muted">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>

                <form method="post" action="{{ route('profile.destroy') }}" class="p-4" id="deleteAccountForm">
                    @csrf
                    @method('delete')
                    
                    <div class="mb-3">
                        <label for="password_delete" class="form-label fw-semibold">Kata Sandi</label>
                        <input id="password_delete" name="password" type="password" class="form-control" placeholder="Masukkan Kata Sandi Anda" required>
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger">Ya, Hapus Akun</button>
            </div>
        </div>
    </div>
</div>
@endsection