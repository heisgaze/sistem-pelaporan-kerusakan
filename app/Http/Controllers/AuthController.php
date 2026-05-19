<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Throwable;

class AuthController extends Controller
{
    private function dbContext(): array
    {
        $defaultConnection = config('database.default');

        try {
            return [
                'default_connection' => $defaultConnection,
                'driver' => DB::connection()->getDriverName(),
                'database' => DB::connection()->getDatabaseName(),
                'host' => config("database.connections.{$defaultConnection}.host"),
                'port' => config("database.connections.{$defaultConnection}.port"),
            ];
        } catch (Throwable $e) {
            return [
                'default_connection' => $defaultConnection,
                'db_context_error' => $e->getMessage(),
            ];
        }
    }

    // REGISTER
    public function register(Request $request)
    {
        Log::error('AUTH_DEBUG Register hit', [
            'email' => $request->input('email'),
            ...$this->dbContext(),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        try {
            Log::error('AUTH_DEBUG Register attempt', [
                'email' => $validated['email'],
                ...$this->dbContext(),
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                // User model sudah pakai cast "hashed" untuk password
                'password' => $validated['password'],
            ]);

            Log::error('AUTH_DEBUG Register success', [
                'user_id' => $user->id,
                'email' => $user->email,
                'password_hash_check' => Hash::check($validated['password'], $user->password),
                'password_length' => strlen((string) $user->password),
                ...$this->dbContext(),
            ]);
        } catch (Throwable $e) {
            Log::error('AUTH_DEBUG Register failed', [
                'email' => $request->input('email'),
                'error' => $e->getMessage(),
                ...$this->dbContext(),
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

        $user = User::query()->where('email', $credentials['email'])->first();
        Log::error('AUTH_DEBUG Login probe', [
            'email' => $credentials['email'],
            'user_found' => (bool) $user,
            'password_hash_check' => $user ? Hash::check($credentials['password'], (string) $user->password) : null,
            'password_length' => $user ? strlen((string) $user->password) : null,
            ...$this->dbContext(),
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

        Log::error('AUTH_DEBUG Login failed', [
            'email' => $credentials['email'],
            ...$this->dbContext(),
        ]);

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
