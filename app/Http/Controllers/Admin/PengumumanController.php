<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required|min:5',
            'status' => 'required|in:draft,aktif,arsip',
        ]);

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $id)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $id)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required|min:5',
            'status' => 'required|in:draft,aktif,arsip',
        ]);

        $id->update($validated);

        return redirect()->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $id)
    {
        $id->delete();

        return redirect()->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
