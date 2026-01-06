<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('admin.fasilitas', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'nama_fasilitas' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'jenis_fasilitas' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        Fasilitas::create($validated);

        return redirect()->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $id)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'jenis_fasilitas' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($id->gambar) {
                Storage::disk('public')->delete($id->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $id->update($validated);

        return redirect()->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $id)
    {
        if ($id->gambar) {
            Storage::disk('public')->delete($id->gambar);
        }

        $id->delete();

        return redirect()->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
