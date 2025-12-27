<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanKerusakan;
use App\Models\PenangananLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenangananLaporanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan (untuk halaman index)
     */
    public function index()
    {
      
    }

    /**
     * Menampilkan detail laporan untuk dikelola (halaman kelola)
     */

    public function show(LaporanKerusakan $id)
    {
        
    }

    /**
     * Update status laporan
     */
    public function update(Request $request, LaporanKerusakan $id)
    {
        
    }

    /**
     * Tambah catatan penanganan
     */
    public function storeCatatan(Request $request, LaporanKerusakan $id)
    {
        
    }

    /**
     * Hapus catatan penanganan
     */
    public function destroyCatatan(PenangananLaporan $catatan)
    {
        
    }
}