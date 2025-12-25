@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Kelola laporan kerusakan fasilitas')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card 
            title="Total Laporan" 
            :value="$stats['total']"
            color="primary"
        >
            <x-slot name="icon">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card 
            title="Pending" 
            :value="$stats['pending']"
            color="warning"
        >
            <x-slot name="icon">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card 
            title="Diproses" 
            :value="$stats['diproses']"
            color="info"
        >
            <x-slot name="icon">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card 
            title="Selesai" 
            :value="$stats['selesai']"
            color="success"
        >
            <x-slot name="icon">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-slot>
        </x-stat-card>
    </div>

    <!-- Recent Reports -->
    <div class="bg-card rounded-2xl border border-border shadow-sm">
        <div class="p-6 border-b border-border flex items-center justify-between">
            <h2 class="font-display font-bold text-lg">Laporan Terbaru</h2>
            <a href="{{ route('admin.laporan') }}" class="text-sm text-primary hover:text-primary/80">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Pelapor</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Fasilitas</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Tanggal</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Status</th>
                        <th class="text-right px-6 py-4 font-medium text-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($recentReports as $report)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $report->user->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-foreground">{{ $report->fasilitas->nama }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->fasilitas->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground">{{ $report->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$report->status" />
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.laporan.kelola', $report->id) }}" class="text-primary hover:text-primary/80 font-medium text-sm">
                                    Kelola
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection