<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'customer',
    ]);

    Auth::login($user);

    $request->session()->regenerate();

    return redirect()
        ->route('dashboard')
        ->with('success', 'Register berhasil');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 AMAN + JELAS CEK ROLE
        if ($user && $user->role === 'admin') {

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login Admin berhasil');
        }

        return redirect('/dashboard')
            ->with('success', 'Login berhasil');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // PROFILE
    public function me()
    {
        return view('user.profile', [
            'user' => Auth::user()
        ]);
    }
}