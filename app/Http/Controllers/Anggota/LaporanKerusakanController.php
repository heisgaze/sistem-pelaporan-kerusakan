<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\LaporanKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanKerusakanController extends Controller
{
    public function index()
    {
        $laporan = LaporanKerusakan::where('user_id', Auth::id())
                    ->with('fasilitas')
                    ->latest()
                    ->paginate(10);

        return view('anggota.laporan', compact('laporan'));
    }

    public function create()
    {
       
        return view('anggota.laporan-buat', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        

        return redirect()->route('anggota.laporan')
            ->with('success', 'Laporan kerusakan berhasil dikirim.');
    }

    public function show(LaporanKerusakan $laporan)
    {
        $this->authorizeLaporan($laporan);

        return view('anggota.laporan.show', compact('laporan'));
    }

    public function destroy(LaporanKerusakan $laporan)
    {
        

        return redirect()->route('anggota.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    private function authorizeLaporan(LaporanKerusakan $laporan)
    {
        if ($laporan->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
