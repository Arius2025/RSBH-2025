<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rute ini hanya bisa diakses oleh pengguna yang sudah login (middleware 'auth')
Route::middleware('auth')->group(function () {
    // Menampilkan formulir edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Memproses update data profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Menghapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});