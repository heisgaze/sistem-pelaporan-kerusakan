@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-background">

    {{-- HEADER (KHUSUS LANDING) --}}
    <header class="sticky top-0 z-50 w-full border-b bg-card/95 backdrop-blur">
        <div class="container mx-auto flex h-16 items-center justify-between px-4">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl gradient-primary flex items-center justify-center">
                    <svg class="h-5 w-5 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M3 21h18M9 21V7l6-4v18"/>
                    </svg>
                </div>
                <div>
                    <span class="font-display font-bold text-foreground">
                        Lapor Fasilitas
                    </span>
                    <p class="text-[10px] text-muted-foreground">
                        Telkom University
                    </p>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-md text-sm hover:bg-muted transition">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="px-4 py-2 rounded-md bg-primary text-primary-foreground hover:opacity-90 transition">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    {{-- HERO --}}
    <section class="relative overflow-hidden py-20 lg:py-32">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-accent/50 to-background"></div>

        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center space-y-8">

                <div class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"/>
                    </svg>
                    Sistem Informasi Resmi Telkom University
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold">
                    Laporkan Kerusakan Fasilitas Kampus dengan
                    <span class="text-primary">Mudah</span>
                </h1>

                <p class="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto">
                    Platform digital untuk melaporkan kerusakan fasilitas kampus
                    secara cepat, terstruktur, dan dapat dipantau status
                    perbaikannya secara real-time.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 px-8 py-3 text-base rounded-lg bg-primary text-primary-foreground hover:opacity-90 transition">
                        Mulai Laporkan
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M5 12h14M13 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 px-8 py-3 text-base rounded-lg border hover:bg-muted transition">
                        Masuk ke Akun
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-20 bg-card border-y">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-display font-bold">
                    Mengapa Menggunakan Sistem Ini?
                </h2>
                <p class="text-muted-foreground mt-3 max-w-xl mx-auto">
                    Solusi terpadu untuk pelaporan dan penanganan kerusakan fasilitas kampus
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['Pelaporan Mudah', 'Buat laporan kerusakan dengan beberapa langkah sederhana.'],
                    ['Pantau Status', 'Lacak status laporan Anda secara real-time.'],
                    ['Transparan', 'Semua laporan tercatat dengan baik dan terdokumentasi.'],
                ] as [$title, $desc])
                    <div class="p-8 rounded-2xl border bg-background hover:shadow-lg transition">
                        <h3 class="text-xl font-display font-semibold mb-3">
                            {{ $title }}
                        </h3>
                        <p class="text-muted-foreground">
                            {{ $desc }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="gradient-primary rounded-3xl p-8 md:p-12 text-center">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-primary-foreground mb-4">
                    Siap Membantu Menjaga Fasilitas Kampus?
                </h2>
                <p class="text-primary-foreground/80 text-lg mb-6">
                    Daftar sekarang dan mulai laporkan kerusakan fasilitas.
                </p>
                <a href="#"
                   class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-secondary text-secondary-foreground">
                    Daftar Sekarang →
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="border-t py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between gap-4">
            <span class="text-sm text-muted-foreground">
                © 2024 Lapor Fasilitas - Telkom University
            </span>
            <span class="text-sm text-muted-foreground">
                Sistem Informasi Laporan Kerusakan Fasilitas Kampus
            </span>
        </div>
    </footer>

</div>
@endsection
