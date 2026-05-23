<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\LaporanKerusakan;
use App\Models\PenangananLaporan;
use App\Models\Pengumuman;

class ApiController extends Controller
{
    public function fasilitas()
    {
        return response()->json(Fasilitas::all());
    }

    public function laporanIndex()
    {
        return LaporanKerusakan::with(['user', 'fasilitas'])->get();
    }

    public function laporanShow($id)
    {
        return LaporanKerusakan::with(['user', 'fasilitas'])->findOrFail($id);
    }

    public function pengumuman()
    {
        return Pengumuman::where('status', 'aktif')->get();
    }

    public function penanganan($laporan_id)
    {
        return PenangananLaporan::where('laporan_id', $laporan_id)
                ->with('admin')
                ->get();
    }
}
