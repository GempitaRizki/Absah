<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $role) {
            if ($request->input('login_as') == 'user') {
                Auth::user()->update(['role' => 'user']);
            } elseif ($request->input('login_as') == 'seller') {
                Auth::user()->update(['role' => 'seller']);
            } elseif ($request->input('login_as') == 'mitra') {
                Auth::user()->update(['role' => 'mitra']);
            } elseif ($request->input('login_as') == 'admin') {
                Auth::user()->update(['role' => 'admin']);
            }
            
            return $next($request);
        }
        
        return response()->json(['message' => 'Anda tidak memiliki akses pada halaman ini!!'], 403);
    }
    
}