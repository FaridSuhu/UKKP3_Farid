<?php
/**
 * Middleware RoleMiddleware
 * Membatasi akses route berdasarkan role user yang login
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle request: cek apakah user memiliki salah satu role yang diizinkan
     * @param string ...$roles daftar role yang boleh akses
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak. Role Anda tidak diizinkan.');
        }

        return $next($request);
    }
}