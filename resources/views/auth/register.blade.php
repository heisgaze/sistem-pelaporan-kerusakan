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

    <!-- <div class="space-y-2">
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
    </div> -->

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