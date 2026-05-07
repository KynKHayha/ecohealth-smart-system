<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes - EcoHealth
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (TANPA LOGIN) ---
Route::get('/', [PlantController::class, 'index'])->name('index');
Route::get('/koleksi', [PlantController::class, 'koleksi'])->name('plant.koleksi');
Route::get('/tanaman/{slug}', [PlantController::class, 'detail'])->name('plant.detail');
Route::get('/scan', function () { return view('scan'); })->name('plant.scan');
Route::get('/tips', [PlantController::class, 'tips'])->name('plant.tips');

// --- AUTHENTICATION (LOGIN & LUPA PASSWORD) ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- HALAMAN ADMIN (PERLU LOGIN) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. DASHBOARD & TANAMAN
    Route::get('/dashboard', [PlantController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/tambah', [PlantController::class, 'create'])->name('plant.create');
    Route::post('/dashboard/tambah', [PlantController::class, 'store'])->name('plant.store');
    Route::get('/plant/edit/{id}', [PlantController::class, 'edit'])->name('plant.edit');
    Route::put('/plant/update/{id}', [PlantController::class, 'update'])->name('plant.update');
    Route::post('/update-stok/{id}', [PlantController::class, 'updateStock'])->name('update.stok');
    Route::delete('/plant/{id}', [PlantController::class, 'destroy'])->name('plant.destroy');
    Route::get('/plant/print/{id}', [PlantController::class, 'printLabel'])->name('plant.print');
    Route::get('/dashboard/cetak-laporan', [PlantController::class, 'cetakLaporan'])->name('plant.cetak');

    // 2. TIPS KESEHATAN
    Route::get('/dashboard/tips', [PlantController::class, 'manageTips'])->name('tips.manage');
    Route::post('/tips/store', [PlantController::class, 'storeTip'])->name('tips.store');
    Route::delete('/tips/{id}', [PlantController::class, 'destroyTip'])->name('tips.destroy');

    // 3. MANAJEMEN LANSIA (URUTAN KRUSIAL BIAR TIDAK 404)
    // Rute Spesifik/Custom taruh di ATAS
    Route::delete('/admin/lansia/bulk-delete', [LansiaController::class, 'bulkDelete'])->name('lansia.bulkDelete');
    Route::delete('/admin/lansia/recent-manual', [LansiaController::class, 'deleteRecentManual'])->name('lansia.recentManual');
    Route::delete('/admin/lansia/recent-import', [LansiaController::class, 'deleteRecentImport'])->name('lansia.recentImport');
    Route::delete('/admin/lansia-truncate', [LansiaController::class, 'truncate'])->name('lansia.truncate');
    
    // Rute Umum
    Route::get('/admin/lansia', [LansiaController::class, 'index'])->name('lansia.index');
    Route::post('/admin/lansia/store', [LansiaController::class, 'store'])->name('lansia.store');
    Route::post('/admin/lansia/import', [LansiaController::class, 'import'])->name('lansia.import');
    
    // Rute dengan Parameter {id} taruh di PALING BAWAH
    Route::get('/admin/lansia/kartu/{id}', [LansiaController::class, 'cetakKartu'])->name('lansia.kartu');
    Route::delete('/admin/lansia/{id}', [LansiaController::class, 'destroy'])->name('lansia.destroy');
});