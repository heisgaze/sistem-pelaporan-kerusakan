# Konversi Blade Templates - Sistem Laporan Kerusakan Fasilitas

Berikut adalah template Laravel Blade yang siap digunakan untuk sistem ini.

---

## Struktur Folder Laravel

```
resources/views/
├── layouts/
│   ├── app.blade.php          (Layout utama dengan sidebar)
│   └── auth.blade.php         (Layout untuk login/register)
├── components/
│   ├── navbar.blade.php
│   ├── sidebar.blade.php
│   ├── stat-card.blade.php
│   └── status-badge.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── user/
│   ├── dashboard.blade.php
│   ├── fasilitas.blade.php
│   ├── laporan-buat.blade.php
│   ├── laporan.blade.php
│   └── laporan-detail.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── fasilitas.blade.php
    ├── laporan.blade.php
    ├── laporan-kelola.blade.php
    └── pengumuman.blade.php
```

---

## CSS (public/css/app.css)

```css
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');

@tailwind base;
@tailwind components;
@tailwind utilities;

:root {
    /* Telkom University Red Theme */
    --background: 0 0% 98%;
    --foreground: 220 20% 15%;
    --card: 0 0% 100%;
    --card-foreground: 220 20% 15%;
    --primary: 351 83% 49%;
    --primary-foreground: 0 0% 100%;
    --secondary: 220 14% 96%;
    --secondary-foreground: 220 20% 15%;
    --muted: 220 14% 96%;
    --muted-foreground: 220 10% 45%;
    --accent: 351 83% 95%;
    --accent-foreground: 351 83% 40%;
    --destructive: 0 84% 60%;
    --success: 142 71% 45%;
    --warning: 38 92% 50%;
    --info: 199 89% 48%;
    --border: 220 13% 91%;
    --ring: 351 83% 49%;
    --radius: 0.75rem;
    --sidebar-background: 220 20% 15%;
    --sidebar-foreground: 220 14% 96%;
    --sidebar-accent: 220 15% 22%;
}

.font-display { font-family: 'Outfit', sans-serif; }
.font-sans { font-family: 'Inter', sans-serif; }
.gradient-primary { background: linear-gradient(135deg, hsl(351, 83%, 49%) 0%, hsl(351, 83%, 35%) 100%); }
.gradient-header { background: linear-gradient(90deg, hsl(220, 20%, 15%) 0%, hsl(220, 20%, 25%) 100%); }
```

---

## 1. layouts/auth.blade.php

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Lapor Fasilitas Tel-U</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
```

---

## 2. auth/login.blade.php

```html
@extends('layouts.auth')

@section('title', 'Login')
@section('heading', 'Selamat Datang Kembali')
@section('subheading', 'Masuk ke akun Anda untuk melaporkan kerusakan fasilitas')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    
    <div class="space-y-2">
        <label for="email" class="text-sm font-medium text-foreground">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email') }}"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('email') border-destructive @enderror"
            placeholder="nama@student.telkomuniversity.ac.id"
            required
        >
        @error('email')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="password" class="text-sm font-medium text-foreground">Password</label>
        <input 
            type="password" 
            id="password" 
            name="password"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('password') border-destructive @enderror"
            placeholder="Masukkan password"
            required
        >
        @error('password')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-border text-primary focus:ring-primary">
            <span class="text-sm text-muted-foreground">Ingat saya</span>
        </label>
        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary/80 font-medium">
            Lupa password?
        </a>
    </div>

    <button type="submit" class="w-full gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/25">
        Masuk
    </button>

    <p class="text-center text-sm text-muted-foreground">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-primary hover:text-primary/80 font-medium">
            Daftar sekarang
        </a>
    </p>
</form>
@endsection
```

---

## 3. auth/register.blade.php

```html
@extends('layouts.auth')

@section('title', 'Register')
@section('heading', 'Buat Akun Baru')
@section('subheading', 'Daftar untuk mulai melaporkan kerusakan fasilitas kampus')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf
    
    <div class="space-y-2">
        <label for="name" class="text-sm font-medium text-foreground">Nama Lengkap</label>
        <input 
            type="text" 
            id="name" 
            name="name" 
            value="{{ old('name') }}"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('name') border-destructive @enderror"
            placeholder="Masukkan nama lengkap"
            required
        >
        @error('name')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="email" class="text-sm font-medium text-foreground">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email') }}"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('email') border-destructive @enderror"
            placeholder="nama@student.telkomuniversity.ac.id"
            required
        >
        @error('email')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="nim" class="text-sm font-medium text-foreground">NIM</label>
        <input 
            type="text" 
            id="nim" 
            name="nim" 
            value="{{ old('nim') }}"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nim') border-destructive @enderror"
            placeholder="Masukkan NIM"
            required
        >
        @error('nim')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="password" class="text-sm font-medium text-foreground">Password</label>
        <input 
            type="password" 
            id="password" 
            name="password"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('password') border-destructive @enderror"
            placeholder="Minimal 8 karakter"
            required
        >
        @error('password')
            <p class="text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="password_confirmation" class="text-sm font-medium text-foreground">Konfirmasi Password</label>
        <input 
            type="password" 
            id="password_confirmation" 
            name="password_confirmation"
            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
            placeholder="Ulangi password"
            required
        >
    </div>

    <button type="submit" class="w-full gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/25">
        Daftar
    </button>

    <p class="text-center text-sm text-muted-foreground">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium">
            Masuk di sini
        </a>
    </p>
</form>
@endsection
```

---

## 4. layouts/app.blade.php (Dashboard Layout)

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Lapor Fasilitas Tel-U</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-background text-foreground font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @include('components.navbar')

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-muted/30">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
```

---

## 5. components/sidebar.blade.php

```html
<aside class="w-64 bg-sidebar-background text-sidebar-foreground flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-sidebar-border">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-xl gradient-primary flex items-center justify-center">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h2 class="font-display font-bold">Lapor Fasilitas</h2>
                <p class="text-xs text-sidebar-foreground/60">Telkom University</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1">
        @if(auth()->user()->role === 'admin')
            <!-- Admin Menu -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.fasilitas') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.fasilitas*') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="font-medium">Fasilitas</span>
            </a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.laporan*') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium">Laporan</span>
            </a>
            <a href="{{ route('admin.pengumuman') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.pengumuman*') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <span class="font-medium">Pengumuman</span>
            </a>
        @else
            <!-- User Menu -->
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.dashboard') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('user.fasilitas') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.fasilitas*') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="font-medium">Daftar Fasilitas</span>
            </a>
            <a href="{{ route('user.laporan.buat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.laporan.buat') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">Buat Laporan</span>
            </a>
            <a href="{{ route('user.laporan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.laporan') && !request()->routeIs('user.laporan.buat') ? 'bg-sidebar-accent text-sidebar-primary' : 'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-foreground' }} transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">Riwayat Laporan</span>
            </a>
        @endif
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-sidebar-border">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-sidebar-accent flex items-center justify-center">
                <span class="font-semibold text-sm">{{ substr(auth()->user()->name, 0, 2) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-sm truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-sidebar-foreground/60 truncate">{{ auth()->user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 text-sidebar-foreground/60 hover:text-sidebar-foreground transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
```

---

## 6. components/navbar.blade.php

```html
<header class="h-16 border-b border-border bg-card flex items-center justify-between px-6">
    <div>
        <h1 class="font-display font-bold text-lg text-foreground">@yield('page-title', 'Dashboard')</h1>
        <p class="text-sm text-muted-foreground">@yield('page-subtitle', '')</p>
    </div>
    
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="p-2 text-muted-foreground hover:text-foreground transition-colors relative">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            @if($unreadNotifications > 0)
                <span class="absolute -top-1 -right-1 h-5 w-5 bg-primary text-white text-xs rounded-full flex items-center justify-center">
                    {{ $unreadNotifications }}
                </span>
            @endif
        </button>
    </div>
</header>
```

---

## 7. components/stat-card.blade.php

```html
@props(['title', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'primary'])

@php
$colorClasses = [
    'primary' => 'bg-primary/10 text-primary',
    'success' => 'bg-green-100 text-green-600',
    'warning' => 'bg-amber-100 text-amber-600',
    'info' => 'bg-blue-100 text-blue-600',
    'danger' => 'bg-red-100 text-red-600',
];
@endphp

<div class="bg-card rounded-2xl p-6 border border-border shadow-sm">
    <div class="flex items-start justify-between mb-4">
        <div class="p-3 rounded-xl {{ $colorClasses[$color] ?? $colorClasses['primary'] }}">
            {!! $icon !!}
        </div>
        @if($trend)
            <div class="flex items-center gap-1 text-sm {{ $trendUp ? 'text-green-600' : 'text-red-600' }}">
                @if($trendUp)
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7m0 10H7"/>
                    </svg>
                @else
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l-9.2 9.2M7 7v10m0-10h10"/>
                    </svg>
                @endif
                <span>{{ $trend }}</span>
            </div>
        @endif
    </div>
    <h3 class="text-3xl font-display font-bold text-foreground">{{ $value }}</h3>
    <p class="text-sm text-muted-foreground mt-1">{{ $title }}</p>
</div>
```

---

## 8. components/status-badge.blade.php

```html
@props(['status'])

@php
$statusConfig = [
    'pending' => ['class' => 'bg-amber-100 text-amber-700 border-amber-200', 'label' => 'Pending'],
    'diproses' => ['class' => 'bg-blue-100 text-blue-700 border-blue-200', 'label' => 'Diproses'],
    'selesai' => ['class' => 'bg-green-100 text-green-700 border-green-200', 'label' => 'Selesai'],
    'ditolak' => ['class' => 'bg-red-100 text-red-700 border-red-200', 'label' => 'Ditolak'],
    'draft' => ['class' => 'bg-gray-100 text-gray-700 border-gray-200', 'label' => 'Draft'],
    'aktif' => ['class' => 'bg-green-100 text-green-700 border-green-200', 'label' => 'Aktif'],
    'arsip' => ['class' => 'bg-gray-100 text-gray-700 border-gray-200', 'label' => 'Arsip'],
];
$config = $statusConfig[$status] ?? $statusConfig['pending'];
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $config['class'] }}">
    {{ $config['label'] }}
</span>
```

---

## 9. user/dashboard.blade.php

```html
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, ' . auth()->user()->name)

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
                    <a href="{{ route('user.laporan') }}" class="text-sm text-primary hover:text-primary/80">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="divide-y divide-border">
                @forelse($recentReports as $report)
                    <a href="{{ route('user.laporan.show', $report->id) }}" class="block p-4 hover:bg-muted/50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ $report->fasilitas->nama }}</p>
                                <p class="text-sm text-muted-foreground mt-1 line-clamp-1">{{ $report->deskripsi }}</p>
                                <p class="text-xs text-muted-foreground mt-2">{{ $report->created_at->diffForHumans() }}</p>
                            </div>
                            <x-status-badge :status="$report->status" />
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-muted-foreground">
                        <p>Belum ada laporan</p>
                        <a href="{{ route('user.laporan.buat') }}" class="text-primary hover:text-primary/80 text-sm mt-2 inline-block">
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
```

---

## 10. user/fasilitas.blade.php

```html
@extends('layouts.app')

@section('title', 'Daftar Fasilitas')
@section('page-title', 'Daftar Fasilitas')
@section('page-subtitle', 'Lihat semua fasilitas yang tersedia')

@section('content')
<div class="space-y-6">
    <!-- Search & Filter -->
    <div class="bg-card rounded-2xl border border-border shadow-sm p-6">
        <form action="{{ route('user.fasilitas') }}" method="GET" class="flex flex-col md:flex-row gap-4">
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
```

---

## 11. user/laporan-buat.blade.php

```html
@extends('layouts.app')

@section('title', 'Buat Laporan')
@section('page-title', 'Buat Laporan Kerusakan')
@section('page-subtitle', 'Laporkan kerusakan fasilitas kampus')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-card rounded-2xl border border-border shadow-sm">
        <div class="p-6 border-b border-border">
            <h2 class="font-display font-bold text-lg">Form Laporan Kerusakan</h2>
            <p class="text-sm text-muted-foreground mt-1">Isi form berikut untuk melaporkan kerusakan fasilitas</p>
        </div>

        <form action="{{ route('user.laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="fasilitas_id" class="text-sm font-medium text-foreground">Fasilitas</label>
                <select 
                    id="fasilitas_id" 
                    name="fasilitas_id"
                    class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('fasilitas_id') border-destructive @enderror"
                    required
                >
                    <option value="">Pilih fasilitas</option>
                    @foreach($fasilitas as $item)
                        <option value="{{ $item->id }}" {{ old('fasilitas_id', request('fasilitas_id')) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} - {{ $item->lokasi }}
                        </option>
                    @endforeach
                </select>
                @error('fasilitas_id')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="deskripsi" class="text-sm font-medium text-foreground">Deskripsi Kerusakan</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi"
                    rows="5"
                    class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none @error('deskripsi') border-destructive @enderror"
                    placeholder="Jelaskan kerusakan secara detail..."
                    required
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="foto" class="text-sm font-medium text-foreground">Foto Kerusakan</label>
                <div class="border-2 border-dashed border-border rounded-xl p-8 text-center hover:border-primary/50 transition-colors">
                    <input 
                        type="file" 
                        id="foto" 
                        name="foto"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(this)"
                    >
                    <label for="foto" class="cursor-pointer">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="preview-image" class="max-h-48 mx-auto rounded-lg" alt="Preview">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="h-12 w-12 mx-auto mb-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-muted-foreground">Klik untuk upload foto</p>
                            <p class="text-xs text-muted-foreground mt-1">PNG, JPG max 2MB</p>
                        </div>
                    </label>
                </div>
                @error('foto')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <a href="{{ route('user.laporan') }}" class="flex-1 text-center py-3 px-4 rounded-xl border border-border text-foreground font-medium hover:bg-muted transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/25">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
```

---

## 12. user/laporan.blade.php (Riwayat)

```html
@extends('layouts.app')

@section('title', 'Riwayat Laporan')
@section('page-title', 'Riwayat Laporan')
@section('page-subtitle', 'Lihat semua laporan yang telah dibuat')

@section('content')
<div class="space-y-6">
    <!-- Filter -->
    <div class="bg-card rounded-2xl border border-border shadow-sm p-6">
        <form action="{{ route('user.laporan') }}" method="GET" class="flex flex-wrap gap-4">
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
                    @forelse($reports as $report)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $report->fasilitas->nama }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->fasilitas->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground line-clamp-2 max-w-xs">{{ $report->deskripsi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground">{{ $report->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$report->status" />
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('user.laporan.show', $report->id) }}" class="p-2 text-muted-foreground hover:text-foreground transition-colors" title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    @if($report->status === 'pending')
                                        <form action="{{ route('user.laporan.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
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
                                <a href="{{ route('user.laporan.buat') }}" class="inline-block mt-4 gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all">
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
    @if($reports->hasPages())
        <div class="flex justify-center">
            {{ $reports->links() }}
        </div>
    @endif
</div>
@endsection
```

---

## 13. user/laporan-detail.blade.php

```html
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
```

---

## 14. admin/dashboard.blade.php

```html
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
```

---

## 15. admin/fasilitas.blade.php

```html
@extends('layouts.app')

@section('title', 'Manajemen Fasilitas')
@section('page-title', 'Manajemen Fasilitas')
@section('page-subtitle', 'Kelola data fasilitas kampus')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <form action="{{ route('admin.fasilitas') }}" method="GET" class="flex gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                placeholder="Cari fasilitas..."
            >
        </form>
        <button 
            type="button" 
            onclick="openModal('create')"
            class="gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all flex items-center gap-2"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Fasilitas
        </button>
    </div>

    <!-- Facilities Table -->
    <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Gambar</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Nama</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Lokasi</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Jenis</th>
                        <th class="text-right px-6 py-4 font-medium text-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($fasilitas as $item)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="h-12 w-16 rounded-lg bg-muted overflow-hidden">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-muted-foreground">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $item->nama }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-muted-foreground">{{ $item->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-lg bg-primary/10 text-primary text-xs font-medium">
                                    {{ $item->jenis }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button 
                                        type="button" 
                                        onclick="openModal('edit', {{ json_encode($item) }})"
                                        class="p-2 text-muted-foreground hover:text-foreground transition-colors"
                                    >
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-destructive hover:text-destructive/80 transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                Belum ada fasilitas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($fasilitas->hasPages())
        <div class="flex justify-center">
            {{ $fasilitas->links() }}
        </div>
    @endif
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-2xl border border-border shadow-xl w-full max-w-lg relative">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h2 id="modal-title" class="font-display font-bold text-lg">Tambah Fasilitas</h2>
                <button type="button" onclick="closeModal()" class="text-muted-foreground hover:text-foreground">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="modal-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <div class="space-y-2">
                    <label for="nama" class="text-sm font-medium text-foreground">Nama Fasilitas</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="lokasi" class="text-sm font-medium text-foreground">Lokasi</label>
                    <input 
                        type="text" 
                        id="lokasi" 
                        name="lokasi"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="jenis" class="text-sm font-medium text-foreground">Jenis</label>
                    <select 
                        id="jenis" 
                        name="jenis"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                        <option value="">Pilih jenis</option>
                        <option value="Ruangan">Ruangan</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Sanitasi">Sanitasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="gambar" class="text-sm font-medium text-foreground">Gambar</label>
                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar"
                        accept="image/*"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                    >
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 px-4 rounded-xl border border-border text-foreground font-medium hover:bg-muted transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('modal');
    const form = document.getElementById('modal-form');
    const title = document.getElementById('modal-title');
    const method = document.getElementById('form-method');
    
    if (mode === 'create') {
        title.textContent = 'Tambah Fasilitas';
        form.action = '{{ route("admin.fasilitas.store") }}';
        method.value = 'POST';
        form.reset();
    } else {
        title.textContent = 'Edit Fasilitas';
        form.action = `/admin/fasilitas/${data.id}`;
        method.value = 'PUT';
        document.getElementById('nama').value = data.nama;
        document.getElementById('lokasi').value = data.lokasi;
        document.getElementById('jenis').value = data.jenis;
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
@endsection
```

---

## 16. admin/laporan.blade.php

```html
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
                    @forelse($reports as $report)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $report->user->name }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-foreground">{{ $report->fasilitas->nama }}</p>
                                <p class="text-sm text-muted-foreground">{{ $report->fasilitas->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-muted-foreground line-clamp-2 max-w-xs">{{ $report->deskripsi }}</p>
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

    @if($reports->hasPages())
        <div class="flex justify-center">
            {{ $reports->links() }}
        </div>
    @endif
</div>
@endsection
```

---

## 17. admin/laporan-kelola.blade.php

```html
@extends('layouts.app')

@section('title', 'Kelola Laporan')
@section('page-title', 'Kelola Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.laporan') }}" class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Report Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
                @if($report->foto)
                    <div class="aspect-video bg-muted">
                        <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto Kerusakan" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="p-6 space-y-4">
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

                    <div class="grid grid-cols-2 gap-4 text-sm pt-4 border-t border-border">
                        <div>
                            <p class="text-muted-foreground">Pelapor</p>
                            <p class="font-medium text-foreground">{{ $report->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-muted-foreground">Tanggal Laporan</p>
                            <p class="font-medium text-foreground">{{ $report->created_at->format('d F Y') }}</p>
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
                        <p class="text-center text-muted-foreground py-4">Belum ada riwayat penanganan</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Status Form -->
        <div class="space-y-6">
            <div class="bg-card rounded-2xl border border-border shadow-sm">
                <div class="p-6 border-b border-border">
                    <h3 class="font-display font-bold text-lg">Update Status</h3>
                </div>
                <form action="{{ route('admin.laporan.update', $report->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-medium text-foreground">Status</label>
                        <select 
                            id="status" 
                            name="status"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            required
                        >
                            <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ $report->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $report->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ $report->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="catatan" class="text-sm font-medium text-foreground">Catatan Penanganan</label>
                        <textarea 
                            id="catatan" 
                            name="catatan"
                            rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                            placeholder="Tambahkan catatan penanganan..."
                            required
                        ></textarea>
                    </div>

                    <button type="submit" class="w-full gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/25">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## 18. admin/pengumuman.blade.php

```html
@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')
@section('page-title', 'Manajemen Pengumuman')
@section('page-subtitle', 'Kelola pengumuman perbaikan fasilitas')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <form action="{{ route('admin.pengumuman') }}" method="GET" class="flex gap-4">
            <select 
                name="status" 
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                onchange="this.form.submit()"
            >
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="arsip" {{ request('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
            </select>
        </form>
        <button 
            type="button" 
            onclick="openModal('create')"
            class="gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all flex items-center gap-2"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Pengumuman
        </button>
    </div>

    <!-- Announcements Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pengumuman as $item)
            <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <x-status-badge :status="$item->status" />
                        <div class="flex items-center gap-1">
                            <button 
                                type="button" 
                                onclick="openModal('edit', {{ json_encode($item) }})"
                                class="p-1.5 text-muted-foreground hover:text-foreground transition-colors"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-destructive hover:text-destructive/80 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="font-display font-bold text-foreground mb-2">{{ $item->judul }}</h3>
                    <p class="text-sm text-muted-foreground line-clamp-3 mb-4">{{ $item->konten }}</p>
                    <p class="text-xs text-muted-foreground">{{ $item->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-muted-foreground">
                <svg class="h-16 w-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <p>Belum ada pengumuman</p>
            </div>
        @endforelse
    </div>

    @if($pengumuman->hasPages())
        <div class="flex justify-center">
            {{ $pengumuman->links() }}
        </div>
    @endif
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-2xl border border-border shadow-xl w-full max-w-lg relative">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h2 id="modal-title" class="font-display font-bold text-lg">Buat Pengumuman</h2>
                <button type="button" onclick="closeModal()" class="text-muted-foreground hover:text-foreground">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="modal-form" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <div class="space-y-2">
                    <label for="judul" class="text-sm font-medium text-foreground">Judul</label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="konten" class="text-sm font-medium text-foreground">Konten</label>
                    <textarea 
                        id="konten" 
                        name="konten"
                        rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                        required
                    ></textarea>
                </div>

                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium text-foreground">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                        <option value="draft">Draft</option>
                        <option value="aktif">Aktif</option>
                        <option value="arsip">Arsip</option>
                    </select>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 px-4 rounded-xl border border-border text-foreground font-medium hover:bg-muted transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('modal');
    const form = document.getElementById('modal-form');
    const title = document.getElementById('modal-title');
    const method = document.getElementById('form-method');
    
    if (mode === 'create') {
        title.textContent = 'Buat Pengumuman';
        form.action = '{{ route("admin.pengumuman.store") }}';
        method.value = 'POST';
        form.reset();
    } else {
        title.textContent = 'Edit Pengumuman';
        form.action = `/admin/pengumuman/${data.id}`;
        method.value = 'PUT';
        document.getElementById('judul').value = data.judul;
        document.getElementById('konten').value = data.konten;
        document.getElementById('status').value = data.status;
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
@endsection
```

## 18. admin/pengumuman.blade.php
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-background">

  {{-- Header --}}
  <header class="sticky top-0 z-50 w-full border-b bg-card/95 backdrop-blur">
    <div class="container flex h-16 items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-xl gradient-primary flex items-center justify-center">
          {{-- Building Icon --}}
          <svg class="h-5 w-5 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

  {{-- Hero --}}
  <section class="relative overflow-hidden py-20 lg:py-32">
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-accent/50 to-background"></div>

    <div class="container">
      <div class="max-w-3xl mx-auto text-center space-y-8">

        <div class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">
          {{-- Shield --}}
          <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
          <a href="{{ route('register') }}"
             class="inline-flex items-center gap-2 px-8 py-3 text-base rounded-lg bg-primary text-primary-foreground hover:opacity-90 transition">
            Mulai Laporkan
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

  {{-- Features --}}
  <section class="py-20 bg-card border-y">
    <div class="container">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-display font-bold">
          Mengapa Menggunakan Sistem Ini?
        </h2>
        <p class="text-muted-foreground mt-3 max-w-xl mx-auto">
          Solusi terpadu untuk pelaporan dan penanganan kerusakan fasilitas kampus
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @php
          $features = [
            ['title' => 'Pelaporan Mudah', 'desc' => 'Buat laporan kerusakan dengan beberapa langkah sederhana.'],
            ['title' => 'Pantau Status', 'desc' => 'Lacak status laporan Anda secara real-time.'],
            ['title' => 'Transparan', 'desc' => 'Semua laporan tercatat dengan baik dan terdokumentasi.'],
          ];
        @endphp

        @foreach($features as $feature)
        <div class="p-8 rounded-2xl border bg-background hover:shadow-lg transition">
          <h3 class="text-xl font-display font-semibold mb-3">
            {{ $feature['title'] }}
          </h3>
          <p class="text-muted-foreground">
            {{ $feature['desc'] }}
          </p>
        </div>
        @endforeach

      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="py-20">
    <div class="container">
      <div class="gradient-primary rounded-3xl p-8 md:p-12 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-primary-foreground mb-4">
          Siap Membantu Menjaga Fasilitas Kampus?
        </h2>
        <p class="text-primary-foreground/80 text-lg mb-6">
          Daftar sekarang dan mulai laporkan kerusakan fasilitas.
        </p>
        <a href="{{ route('register') }}"
           class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-secondary text-secondary-foreground">
          Daftar Sekarang →
        </a>
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <footer class="border-t py-8">
    <div class="container flex flex-col md:flex-row justify-between gap-4">
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

---

## Routes (routes/web.php)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FasilitasController;
use App\Http\Controllers\User\LaporanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFasilitasController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminPengumumanController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/laporan/buat', [LaporanController::class, 'create'])->name('laporan.buat');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Fasilitas CRUD
    Route::get('/fasilitas', [AdminFasilitasController::class, 'index'])->name('fasilitas');
    Route::post('/fasilitas', [AdminFasilitasController::class, 'store'])->name('fasilitas.store');
    Route::put('/fasilitas/{id}', [AdminFasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [AdminFasilitasController::class, 'destroy'])->name('fasilitas.destroy');
    
    // Laporan Management
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/kelola', [AdminLaporanController::class, 'kelola'])->name('laporan.kelola');
    Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])->name('laporan.update');
    
    // Pengumuman CRUD
    Route::get('/pengumuman', [AdminPengumumanController::class, 'index'])->name('pengumuman');
    Route::post('/pengumuman', [AdminPengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [AdminPengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [AdminPengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});
```


---

## Tailwind Config (tailwind.config.js)

```javascript
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        background: 'hsl(var(--background))',
        foreground: 'hsl(var(--foreground))',
        card: 'hsl(var(--card))',
        'card-foreground': 'hsl(var(--card-foreground))',
        primary: 'hsl(var(--primary))',
        'primary-foreground': 'hsl(var(--primary-foreground))',
        secondary: 'hsl(var(--secondary))',
        'secondary-foreground': 'hsl(var(--secondary-foreground))',
        muted: 'hsl(var(--muted))',
        'muted-foreground': 'hsl(var(--muted-foreground))',
        accent: 'hsl(var(--accent))',
        'accent-foreground': 'hsl(var(--accent-foreground))',
        destructive: 'hsl(var(--destructive))',
        border: 'hsl(var(--border))',
        ring: 'hsl(var(--ring))',
        'sidebar-background': 'hsl(var(--sidebar-background))',
        'sidebar-foreground': 'hsl(var(--sidebar-foreground))',
        'sidebar-accent': 'hsl(var(--sidebar-accent))',
        'sidebar-border': 'hsl(var(--sidebar-border))',
        'sidebar-primary': 'hsl(var(--sidebar-primary))',
      },
      fontFamily: {
        display: ['Outfit', 'sans-serif'],
        sans: ['Inter', 'sans-serif'],
      },
      borderRadius: {
        xl: '0.75rem',
        '2xl': '1rem',
      },
    },
  },
  plugins: [],
}
```

---

Dokumentasi lengkap ini berisi semua Blade templates yang dibutuhkan untuk sistem Laporan Kerusakan Fasilitas dengan:
- 2 role (User/Mahasiswa & Admin)
- Layout auth dan dashboard dengan sidebar
- Komponen reusable (stat-card, status-badge)
- Form dengan validasi error
- CRUD fasilitas, laporan, pengumuman
- Filter dan pagination
- Modal untuk create/edit
- Riwayat penanganan laporan
