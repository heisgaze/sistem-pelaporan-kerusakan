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