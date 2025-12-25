<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Lapor Fasilitas Tel-U</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-background text-foreground font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Form -->
        <div class="flex-1 flex flex-col justify-center px-8 py-12 lg:px-16">
            <div class="mx-auto w-full max-w-md">
                <!-- Logo -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-12 w-12 rounded-xl gradient-primary flex items-center justify-center">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-display font-bold text-foreground">Lapor Fasilitas</h2>
                            <p class="text-xs text-muted-foreground">Telkom University</p>
                        </div>
                    </div>

                    <h1 class="text-2xl font-display font-bold text-foreground">@yield('heading')</h1>
                    @hasSection('subheading')
                        <p class="mt-2 text-sm text-muted-foreground">@yield('subheading')</p>
                    @endif
                </div>

                @yield('content')
            </div>
        </div>

        <!-- Right Side - Decorative -->
        <div class="hidden lg:flex lg:flex-1 gradient-primary items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <div class="relative z-10 text-center text-white max-w-md">
                <div class="mb-8">
                    <svg class="h-24 w-24 mx-auto mb-6 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold mb-4">Sistem Laporan Kerusakan Fasilitas</h3>
                <p class="text-white/80 leading-relaxed">
                    Laporkan kerusakan fasilitas kampus dengan mudah dan pantau status perbaikan secara real-time.
                </p>
            </div>

            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full"></div>
        </div>
    </div>
</body>
</html>
