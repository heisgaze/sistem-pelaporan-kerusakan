<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/fasilitas', [ApiController::class, 'fasilitas']);
Route::get('/laporan', [ApiController::class, 'laporanIndex']);
Route::get('/laporan/{id}', [ApiController::class, 'laporanShow']);
Route::get('/pengumuman', [ApiController::class, 'pengumuman']);
Route::get('/penanganan/{laporan_id}', [ApiController::class, 'penanganan']);
