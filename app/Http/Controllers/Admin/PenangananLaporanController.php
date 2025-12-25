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
        $laporan = LaporanKerusakan::with('fasilitas', 'user')
            ->latest()
            ->paginate(10);
        
        return view('admin.laporan', compact('laporan'));
    }

    /**
     * Menampilkan detail laporan untuk dikelola (halaman kelola)
     */
    public function kelola(LaporanKerusakan $laporan)
    {
        
        
        return view('admin.laporan-kelola', compact('laporan'));
    }

    /**
     * Update status laporan
     */
    public function updateStatus(Request $request, LaporanKerusakan $laporan)
    {
        

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Tambah catatan penanganan
     */
    public function storeCatatan(Request $request, LaporanKerusakan $laporan)
    {
        

        return back()->with('success', 'Catatan penanganan berhasil ditambahkan.');
    }

    /**
     * Hapus catatan penanganan
     */
    public function destroyCatatan(PenangananLaporan $catatan)
    {
        
        
        return back()->with('success', 'Catatan berhasil dihapus.');
    }
}