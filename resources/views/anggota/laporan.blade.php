@extends('layouts.app')

@section('title', 'Riwayat Laporan')
@section('page-title', 'Riwayat Laporan')
@section('page-subtitle', 'Lihat semua laporan yang telah dibuat')

@section('content')
<div class="space-y-6">
    <!-- Filter -->
    <div class="bg-card rounded-2xl border border-border shadow-sm p-6">
        <form action="{{ route('anggota.laporan') }}" method="GET" class="flex flex-wrap gap-4">
            <select 
                name="status" 
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                onchange="this.form.submit()"
            >
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>

    <!-- Reports Table -->
    <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Fasilitas</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Deskripsi</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Tanggal</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Status</th>
                        <th class="text-right px-6 py-4 font-medium text-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($laporan as $report)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $report->fasilitas->nama_fasilitas }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->fasilitas->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground line-clamp-2 max-w-xs">{{ $report->deskripsi_kerusakan }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground">{{ $report->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$report->status" />
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('anggota.laporan.show', $report->id) }}" class="p-2 text-muted-foreground hover:text-foreground transition-colors" title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    @if($report->status === 'pending')
                                        <form action="{{ route('anggota.laporan.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-destructive hover:text-destructive/80 transition-colors" title="Hapus">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                <svg class="h-16 w-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>Belum ada laporan</p>
                                <a href="{{ route('anggota.laporan.buat') }}" class="inline-block mt-4 gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all">
                                    Buat Laporan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($laporan->hasPages())
        <div class="flex justify-center">
            {{ $laporan->links() }}
        </div>
    @endif
</div>
@endsection