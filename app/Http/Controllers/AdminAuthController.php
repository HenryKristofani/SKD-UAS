<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    /**
     * Show the login form for admin (redirect to Vue route).
     */
    public function showLoginForm()
    {
        // Arahkan ke halaman Vue Login.vue dengan Inertia (untuk Laravel SPA)
        return redirect()->route('login'); // Pastikan ini mengarah ke halaman Vue Login.vue
    }

    /**
     * Handle an admin login request.
     */
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi admin menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Jika login berhasil, kembalikan respons JSON untuk Vue
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => url('/admin/dashboard') // Berikan URL dashboard untuk redirect di Vue
            ]);
        }

        // Jika login gagal, kembalikan respons JSON dengan pesan error
        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    /**
     * Handle an admin logout request.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Invalidate session dan regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembalikan respons JSON untuk mengarahkan ke halaman login setelah logout
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
            'redirect' => url('/') // URL beranda atau login
        ]);
    }
}
