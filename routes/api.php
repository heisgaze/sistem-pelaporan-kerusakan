<?php

use App\Models\Fasilitas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\LaporanKerusakan;
use App\Models\Pengumuman;
use App\Models\PenangananLaporan;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/fasilitas', function () {
    return response()->json(Fasilitas::all());
});
Route::get('/laporan', function () {
    return LaporanKerusakan::with(['user', 'fasilitas'])->get();
});
Route::get('/laporan/{id}', function ($id) {
    return LaporanKerusakan::with(['user', 'fasilitas'])->findOrFail($id);
});

Route::get('/pengumuman', function () {
    return Pengumuman::where('status', 'aktif')->get();
});

Route::get('/penanganan/{laporan_id}', function ($laporan_id) {
    return PenangananLaporan::where('laporan_id', $laporan_id)
            ->with('admin')
            ->get();
});
