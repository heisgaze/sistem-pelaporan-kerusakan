@extends('layouts.app')

@section('title', 'Manajemen Laporan')
@section('page-title', 'Manajemen Laporan')
@section('page-subtitle', 'Kelola semua laporan kerusakan')

@section('content')
<div class="space-y-6">
    <!-- Filter -->
    <div class="bg-card rounded-2xl border border-border shadow-sm p-6">
        <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-wrap gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                class="flex-1 min-w-[200px] px-4 py-2 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                placeholder="Cari pelapor atau fasilitas..."
            >
            <select 
                name="status" 
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
            >
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="gradient-primary text-white font-semibold py-2 px-6 rounded-xl hover:opacity-90 transition-all">
                Filter
            </button>
        </form>
    </div>

    <!-- Reports Table -->
    <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Pelapor</th>
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
                                <p class="font-medium text-foreground">{{ $report->user->name }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-foreground">{{ $report->fasilitas->nama_fasilitas }}</p>
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
                                    <a href="{{ route('admin.laporan.show', $report->id) }}" class="p-2 text-muted-foreground hover:text-foreground transition-colors" title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.laporan.kelola', $report->id) }}" class="p-2 text-primary hover:text-primary/80 transition-colors" title="Kelola">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-muted-foreground">
                                Tidak ada laporan ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($laporan->hasPages())
        <div class="flex justify-center">
            {{ $reports->links() }}
        </div>
    @endif
</div>
@endsection