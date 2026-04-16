<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaCrudController;
use App\Http\Controllers\Admin\JadwalCrudController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JadwalHarianController;

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
Route::get('/dokter', [FrontendController::class, 'dokter'])->name('dokter');

// Jadwal Harian
Route::get('/jadwal', [JadwalHarianController::class, 'index'])->name('jadwal');
Route::get('/update-jadwal-rahasia-x912', [JadwalHarianController::class, 'uploadForm']);
Route::post('/update-jadwal-rahasia-x912', [JadwalHarianController::class, 'upload'])->name('jadwal-harian.upload');
Route::delete('/update-jadwal-rahasia-x912/{id}', [JadwalHarianController::class, 'destroy'])->name('jadwal-harian.destroy');

Route::get('/ppid', [FrontendController::class, 'ppid'])->name('ppid');
Route::get('/zona', [FrontendController::class, 'zonaIntegritas'])->name('zona');
Route::get('/komplain', [FrontendController::class, 'komplain'])->name('komplain');
Route::get('/kontak',[FrontendController::class,'kontak'])->name('kontak');
Route::get('/siterbat',[FrontendController::class,'siterbat'])->name('siterbat');
Route::post('/siterbat/submit', [\App\Http\Controllers\SiterbatController::class, 'submit'])->name('siterbat.submit');
Route::post('/ambulance/submit', [\App\Http\Controllers\AmbulanceController::class, 'submit'])->name('ambulance.submit');

Route::get('/santardekate', [\App\Http\Controllers\SantardekateController::class, 'index'])->name('santardekate');
Route::post('/santardekate/submit', [\App\Http\Controllers\SantardekateController::class, 'submit'])->name('santardekate.submit');

Route::get('/ambulance',[FrontendController::class,'ambulance'])->name('ambulance');
Route::get('/dashboard-indikator',[FrontendController::class,'dashboardIndikator'])->name('dashboard-indikator');
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
use App\Http\Controllers\Admin\AdminController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route Dashboard Admin (contoh)
    Route::view('/', 'admin.dashboard')->name('dashboard');

    // Reset Cache Instagram
    Route::post('/refresh-instagram', [AdminController::class, 'refreshInstagram'])->name('refresh_instagram');

    // 2. Kelola Jadwal Dokter: Menggunakan JadwalCrudController
    Route::get('/jadwal', [JadwalCrudController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/update', [JadwalCrudController::class, 'update'])->name('jadwal.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');
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