@extends('layouts.app')

@section('title', 'Daftar Fasilitas')
@section('page-title', 'Daftar Fasilitas')
@section('page-subtitle', 'Lihat semua fasilitas yang tersedia')

@section('content')
<div class="space-y-6">
    <!-- Search & Filter -->
    <div class="bg-card rounded-2xl border border-border shadow-sm p-6">
        <form action="{{ route('anggota.fasilitas') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                    placeholder="Cari fasilitas..."
                >
            </div>
            <select 
                name="jenis" 
                class="px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
            >
                <option value="">Semua Jenis</option>
                @foreach($jenisOptions as $jenis)
                    <option value="{{ $jenis }}" {{ request('jenis') === $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="gradient-primary text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all">
                Cari
            </button>
        </form>
    </div>

    <!-- Facilities Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($fasilitas as $item)
            <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden group">
                <div class="aspect-video bg-muted overflow-hidden">
                    @if($item->gambar)
                        <img 
                            src="{{ asset('storage/' . $item->gambar) }}" 
                            alt="{{ $item->nama }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center text-muted-foreground">
                            <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-display font-bold text-foreground">{{ $item->nama }}</h3>
                        <span class="px-2 py-1 rounded-lg bg-primary/10 text-primary text-xs font-medium">
                            {{ $item->jenis }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-muted-foreground mb-4">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $item->lokasi }}</span>
                    </div>
                    <a 
                        href="{{ route('user.laporan.buat', ['fasilitas_id' => $item->id]) }}" 
                        class="block w-full text-center gradient-primary text-white font-semibold py-2.5 rounded-xl hover:opacity-90 transition-all"
                    >
                        Laporkan Kerusakan
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-muted-foreground">
                <svg class="h-16 w-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p>Tidak ada fasilitas ditemukan</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($fasilitas->hasPages())
        <div class="flex justify-center">
            {{ $fasilitas->links() }}
        </div>
    @endif
</div>
@endsection