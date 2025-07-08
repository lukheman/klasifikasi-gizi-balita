<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Enums\Role;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login dengan guard 'web' (users)
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $request->session()->regenerate();

            return match (Role::from($user->role)) {
                Role::Admin => redirect()->route('filament.ahligizi.pages.dashboard'),
                Role::Kader => redirect()->route('filament.kader.pages.dashboard'),
                Role::Pimpinan => redirect()->route('filament.pimpinan.pages.dashboard'),
                default => redirect('/home'),
            };
        }

        // Coba login dengan guard 'orang_tua'
        if (Auth::guard('orang_tua')->attempt($credentials)) {
            $orangTua = Auth::guard('orang_tua')->user();
            $request->session()->regenerate();

            // Asumsi tabel orang_tua punya kolom role, sesuaikan jika tidak ada
            return redirect()->route('filament.orangtua.pages.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        // Logout dari kedua guard
        Auth::guard('web')->logout();
        Auth::guard('orang_tua')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
