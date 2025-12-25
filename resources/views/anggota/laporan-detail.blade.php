@extends('layouts.app')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('user.laporan') }}" class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>

    <!-- Report Details -->
    <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
        @if($report->foto)
            <div class="aspect-video bg-muted">
                <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto Kerusakan" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6 space-y-6">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="font-display font-bold text-xl text-foreground">{{ $report->fasilitas->nama }}</h2>
                    <p class="text-muted-foreground flex items-center gap-2 mt-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $report->fasilitas->lokasi }}
                    </p>
                </div>
                <x-status-badge :status="$report->status" />
            </div>

            <div>
                <h3 class="font-medium text-foreground mb-2">Deskripsi Kerusakan</h3>
                <p class="text-muted-foreground">{{ $report->deskripsi }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-muted-foreground">Tanggal Laporan</p>
                    <p class="font-medium text-foreground">{{ $report->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Pelapor</p>
                    <p class="font-medium text-foreground">{{ $report->user->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Handling History -->
    <div class="bg-card rounded-2xl border border-border shadow-sm">
        <div class="p-6 border-b border-border">
            <h3 class="font-display font-bold text-lg">Riwayat Penanganan</h3>
        </div>
        <div class="p-6">
            @if($report->penanganan->count() > 0)
                <div class="space-y-4">
                    @foreach($report->penanganan as $penanganan)
                        <div class="flex gap-4">
                            <div class="w-3 h-3 rounded-full bg-primary mt-1.5 shrink-0"></div>
                            <div class="flex-1 pb-4 {{ !$loop->last ? 'border-b border-border' : '' }}">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="font-medium text-foreground">{{ $penanganan->admin->name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ $penanganan->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <p class="text-sm text-muted-foreground">{{ $penanganan->catatan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted-foreground py-8">Belum ada riwayat penanganan</p>
            @endif
        </div>
    </div>
</div>
@endsection