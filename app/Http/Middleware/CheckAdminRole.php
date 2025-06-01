<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        // Asumsikan user memiliki field 'role' atau 'is_admin'
        // Sesuaikan dengan struktur database Anda
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}