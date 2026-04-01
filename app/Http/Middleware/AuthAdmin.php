<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek apakah ada session admin_id dan apakah role-nya 'admin'
        if (!Session::has('admin_id') || Session::get('role') !== 'admin') {
            
            // Jika aksesnya via AJAX/API, kasih pesan error json
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }

            // Tendang ke halaman login admin
            return redirect()->route('admin.login')->with('error', 'Akses khusus Admin!');
        }

        return $next($request);
    }
}