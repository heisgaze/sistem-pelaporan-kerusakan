<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Fasilitas;
use App\Models\LaporanKerusakan;

class DaftarFasilitasController extends Controller
{
    public function index()
    {
        // List pilihan jenis untuk filter dropdown
    $jenisOptions = [
        'Ruangan',
        'Elektronik',
        'Furniture',
        'Sanitasi',
        'Lainnya',
    ];

    // Data fasilitas
    $fasilitas = \App\Models\Fasilitas::latest()->paginate(9);

    return view('anggota.fasilitas', compact('jenisOptions', 'fasilitas'));
        // Implement the logic for displaying the list of facilities
        return view('anggota.fasilitas', compact('jenisOptions'));
    }
}