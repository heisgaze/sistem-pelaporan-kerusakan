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
        $fasilitas = Fasilitas::all();
        return view('anggota.laporan-buat', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'deskripsi_kerusakan' => 'required|min:5',
            'bukti_foto' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('bukti_foto')) {
            $validated['bukti_foto'] = $request->file('bukti_foto')
                ->store('laporan', 'public');
        }

        LaporanKerusakan::create($validated);

        return redirect()->route('anggota.laporan')
            ->with('success', 'Laporan kerusakan berhasil dikirim.');
    }

    public function show(LaporanKerusakan $id)
    {
        $laporan = $id;
        return view('anggota.laporan-detail', compact('laporan'));
    }


    public function edit(LaporanKerusakan $id)
    {
        

        if ($id->status !== 'pending') {
            return back()->withErrors('Laporan hanya dapat diedit jika status masih pending.');
        }

        $fasilitas = Fasilitas::all();
        $laporan = $id;
        return view('anggota.laporan-edit', compact('laporan', 'fasilitas'));
    }

    public function update(Request $request, LaporanKerusakan $id)
    {
        

        if ($id->status !== 'pending') {
            return back()->withErrors('Laporan hanya dapat diperbarui jika status masih pending.');
        }

        $validated = $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'deskripsi_kerusakan' => 'required|min:5',
            'bukti_foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_foto')) {
            if ($id->bukti_foto) {
                Storage::disk('public')->delete($id->bukti_foto);
            }

            $validated['bukti_foto'] = $request->file('bukti_foto')
                ->store('laporan', 'public');
        }

        $id->update($validated);

        return redirect()->route('anggota.laporan')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(LaporanKerusakan $id)
    {
        

        if ($id->status !== 'pending') {
            return back()->withErrors('Laporan hanya bisa dihapus jika status masih pending.');
        }

        if ($id->bukti_foto) {
            Storage::disk('public')->delete($id->bukti_foto);
        }

        $id->delete();

        return redirect()->route('anggota.laporan')
            ->with('success', 'Laporan berhasil dihapus.');
    }

}
