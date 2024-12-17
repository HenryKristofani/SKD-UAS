<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user terautentikasi dengan guard admin dan menggunakan email admin@gmail.com
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->email === 'admin@gmail.com') {
            return $next($request);
        }

        // Redirect ke halaman login jika bukan admin@gmail.com
        return redirect('/admin/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
