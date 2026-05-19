<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Anggota\AnggotaDashboardController;
use App\Http\Controllers\Anggota\DaftarFasilitasController;
use App\Http\Controllers\Anggota\LaporanKerusakanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\PenangananLaporanController;
use App\Http\Controllers\Admin\PengumumanController;

Route::view('/', 'index')->name('home');
// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/fasilitas', [DaftarFasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/laporan/buat', [LaporanKerusakanController::class, 'create'])->name('laporan.buat');
    Route::post('/laporan', [LaporanKerusakanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan', [LaporanKerusakanController::class, 'index'])->name('laporan');
    Route::get('/laporan/{id}', [LaporanKerusakanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/edit', [LaporanKerusakanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}', [LaporanKerusakanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanKerusakanController::class, 'destroy'])->name('laporan.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Fasilitas CRUD
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
    
    // Laporan Management
    Route::get('/laporan', [PenangananLaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/{id}', [PenangananLaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/kelola', [PenangananLaporanController::class, 'show'])->name('laporan.kelola');
    Route::put('/laporan/{id}', [PenangananLaporanController::class, 'update'])->name('laporan.update');
    Route::post('/laporan/{id}/catatan', [PenangananLaporanController::class, 'storeCatatan'])->name('laporan.catatan.store');
    Route::delete('/laporan/{id}', [PenangananLaporanController::class, 'destroy'])->name('laporan.destroy');
    
    // Pengumuman CRUD
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});

Route::get('/debug-users', function () {
    return response()->json([
        'users' => \Illuminate\Support\Facades\DB::table('users')->get(),
        'schema' => \Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE users')
    ]);
});