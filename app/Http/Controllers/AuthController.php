<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Throwable;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                // User model sudah pakai cast "hashed" untuk password
                'password' => $validated['password'],
            ]);

            Log::info('User registered', ['user_id' => $user->id, 'email' => $user->email]);
        } catch (Throwable $e) {
            Log::error('Registration failed', [
                'email' => $request->input('email'),
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->withErrors(['email' => 'Registrasi gagal karena masalah server. Coba lagi.']);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
        
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // Auth::attempt otomatis cek password hash
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Login admin berhasil!');
    }

            return redirect()->route('anggota.dashboard')
                ->with('success', 'Login berhasil!');
        }

        Log::debug('Login failed', ['email' => $credentials['email']]);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout!');
    }
}
