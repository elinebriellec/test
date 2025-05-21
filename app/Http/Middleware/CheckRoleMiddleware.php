<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$role): Response
    {
        $current_role = session('current_role');
        if(in_array($current_role, $role)){
            return $next($request);
        }
        return redirect()->route('dashboard')->with('error', 'Akses ditolak, role tidak sesuai');
    }
}
