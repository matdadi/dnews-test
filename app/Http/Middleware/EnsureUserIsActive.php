<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('exception', 'Akun anda tidak aktif, silahkan hubungi administrator');
        }
        return $next($request);
    }
}
