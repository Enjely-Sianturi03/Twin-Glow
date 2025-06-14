<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    // 👉 Cek jika user diblokir
    if ($user->is_blocked) {
        return back()->withErrors([
            'email' => 'Akun Anda telah diblokir oleh admin.',
        ])->onlyInput('email');
    }

    Auth::login($user);
    $request->session()->regenerate();

    if ($user->email === 'red@gmail.com') {
        return redirect('/admin');
    }

    return redirect()->intended('/');
// =======
//     $this->validate($request, [
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     $credentials = $request->only('email', 'password');
//     $user = User::where('email', $request->email)->first();

//     if ($user && $user->is_blocked) {
//         return back()->withErrors(['email' => 'Akun Anda telah diblokir. Silakan hubungi admin.']);
//     }

//     if (Auth::attempt($credentials, $request->filled('remember'))) {
//         $request->session()->regenerate();
//         return redirect()->intended('/'); 
//     }

//     return back()->withErrors([
//         'email' => 'Email atau password salah.',
//     ]);
// >>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 