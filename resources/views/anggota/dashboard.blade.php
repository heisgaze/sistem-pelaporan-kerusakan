@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, ' . (auth()->user()->name ?? 'Preview User'))

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Reports -->
        <div class="lg:col-span-2 bg-card rounded-2xl border border-border shadow-sm">
            <div class="p-6 border-b border-border">
                <div class="flex items-center justify-between">
                    <h2 class="font-display font-bold text-lg">Laporan Terbaru</h2>
                    <a href="{{ route('anggota.laporan') }}" class="text-sm text-primary hover:text-primary/80">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="divide-y divide-border">
                @forelse($recentReports as $report)
                    <a href="{{ route('anggota.laporan.show', $report->id) }}" class="block p-4 hover:bg-muted/50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ $report->fasilitas->nama_fasilitas }}</p>
                                <p class="text-sm text-muted-foreground mt-1 line-clamp-1">{{ $report->deskripsi_kerusakan }}</p>
                                <p class="text-xs text-muted-foreground mt-2">{{ $report->created_at->diffForHumans() }}</p>
                            </div>
                            <x-status-badge :status="$report->status" />
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-muted-foreground">
                        <p>Belum ada laporan</p>
                        <a href="{{ route('anggota.laporan.buat') }}" class="text-primary hover:text-primary/80 text-sm mt-2 inline-block">
                            Buat laporan pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Announcements -->
        <div class="bg-card rounded-2xl border border-border shadow-sm">
            <div class="p-6 border-b border-border">
                <h2 class="font-display font-bold text-lg">Pengumuman</h2>
            </div>
            <div class="divide-y divide-border">
                @forelse($announcements as $announcement)
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary shrink-0">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-foreground">{{ $announcement->judul }}</p>
                                <p class="text-xs text-muted-foreground mt-1 line-clamp-2">{{ $announcement->konten }}</p>
                                <p class="text-xs text-muted-foreground mt-2">{{ $announcement->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-muted-foreground">
                        <p class="text-sm">Belum ada pengumuman</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection