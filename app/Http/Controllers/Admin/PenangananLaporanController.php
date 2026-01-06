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

    public function show(LaporanKerusakan $id)
    {
        $laporan = $id;
        $laporan->load('penanganan.admin', 'fasilitas', 'user');
        return view('admin.laporan-kelola', compact('laporan'));
    }

    /**
     * Update status laporan
     */
    public function update(Request $request, LaporanKerusakan $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak'
        ]);

        $id->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Tambah catatan penanganan
     */
    public function storeCatatan(Request $request, LaporanKerusakan $id)
    {
        $validated = $request->validate([
            'catatan_penanganan' => 'required|min:5'
        ]);

        PenangananLaporan::create([
            'laporan_id' => $id->id,
            'admin_id' => Auth::id(),
            'catatan_penanganan' => $validated['catatan_penanganan']
        ]);

        return back()->with('success', 'Catatan penanganan berhasil ditambahkan.');
    }

    /**
     * Hapus catatan penanganan
     */
    public function destroyCatatan(PenangananLaporan $catatan)
    {
        $catatan->delete();
        
        return back()->with('success', 'Catatan berhasil dihapus.');
    }
}