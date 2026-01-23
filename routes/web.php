<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaCrudController;
use App\Http\Controllers\Admin\JadwalCrudController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route dimuat oleh RouteServiceProvider dan diberikan grup middleware "web".
|
*/

// =========================================================================
// 1. ROUTE FRONTEND (PUBLIC ACCESS)
// =========================================================================

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/informasi', [FrontendController::class, 'informasi'])->name('informasi');
Route::get('/jadwal', [FrontendController::class, 'jadwal'])->name('jadwal');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [FrontendController::class, 'detailBerita'])->name('berita.detail'); 
Route::get('/ppid', [FrontendController::class, 'ppid'])->name('ppid');
Route::get('/zona', [FrontendController::class, 'zonaIntegritas'])->name('zona');
Route::get('/komplain', [FrontendController::class, 'komplain'])->name('komplain');
Route::get('/kontak',[FrontendController::class,'kontak'])->name('kontak');
Route::get('/tidur',[FrontendController::class,'tidur'])->name('tidur');
Route::get('/api/bed-status', [FrontendController::class, 'getBedData'])->name('api.bed.status');
Route::get('/jadwalOperasi',[FrontendController::class,'jadwalOperasi'])->name('jadwaloperasi');
Route::get('/test-api-operasi', [FrontendController::class, 'testKoneksi']);
// =========================================================================
// 2. ROUTE AUTHENTICATION (BREEZE)
// =========================================================================

require __DIR__.'/auth.php'; 


// =========================================================================
// 3. ROUTE ADMIN (PROTECTED)
// =========================================================================

/*
|--------------------------------------------------------------------------
| Admin Routes (Backend)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route Dashboard Admin (contoh)
    Route::view('/', 'admin.dashboard')->name('dashboard');

    // 1. Kelola Berita: Menggunakan BeritaCrudController
    // Route ini yang menyebabkan error Anda, pastikan import BeritaCrudController sudah benar!
    Route::resource('berita', BeritaCrudController::class);

    // 2. Kelola Jadwal Dokter: Menggunakan JadwalCrudController
    Route::get('/jadwal', [JadwalCrudController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/update', [JadwalCrudController::class, 'update'])->name('jadwal.update');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update'); // Biasanya ada di UpdatePasswordController
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// =========================================================================
// 4. ROUTE PROFILE (DIPERLUKAN OLEH navigation.blade.php)
//    Pastikan file routes/profile.php ada setelah instalasi Breeze.
// =========================================================================

Route::middleware('auth')->group(function () {
    require __DIR__.'/profile.php'; 
});

// =========================================================================
// END OF ROUTES
// =========================================================================