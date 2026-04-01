<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('pelanggan_id')) {
            return redirect()->route('user.login')->withErrors(['Silakan login terlebih dahulu.']);
        }

        if (Session::get('role') !== 'user') {
            return redirect()->route('/');
        }

        return $next($request);
    }
}

