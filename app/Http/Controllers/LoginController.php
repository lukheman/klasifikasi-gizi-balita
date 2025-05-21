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

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return match (Role::from($user->role)) {
                Role::Admin => redirect()->route('filament.admin.pages.dashboard'),
                Role::AhliGizi => redirect()->route('filament.ahligizi.pages.dashboard'),
                Role::OrangTua => redirect()->route('filament.orangtua.pages.dashboard'),
                Role::Pimpinan => redirect()->route('filament.pimpinan.pages.dashboard'),
                default => redirect('/home'),
            };
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
