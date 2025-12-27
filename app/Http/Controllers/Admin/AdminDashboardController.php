<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;
use App\Models\LaporanKerusakan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik laporan user
        $stats = [
            'total'    => LaporanKerusakan::count(),
            'pending'  => LaporanKerusakan::where('status', 'pending')->count(),
            'diproses' => LaporanKerusakan::where('status', 'diproses')->count(),
            'selesai'  => LaporanKerusakan::where('status', 'selesai')->count(),
        ];

        // Laporan terbaru user
        $recentReports = LaporanKerusakan::with(['user', 'fasilitas'])
            ->latest()
            ->take(5)
            ->get();

        // Pengumuman aktif terbaru
        $announcements = Pengumuman::where('status', 'aktif')
                            ->latest()
                            ->take(5)
                            ->get();
    

        return view('admin.dashboard', compact('stats', 'recentReports', 'announcements'));
    }
}
