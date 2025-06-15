<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->email !== 'red@gmail.com' || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password yang dimasukkan tidak sesuai.',
            ]);
        }

        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->email !== 'red@gmail.com') {
            return redirect()->route('admin.login');
        }

        $bookings = Booking::with(['user', 'service'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function toggleBlock(User $user)
{
    $user->is_blocked = !$user->is_blocked;
    $user->save();

    return back()->with('success', 'Status user berhasil diperbarui.');
}

} 