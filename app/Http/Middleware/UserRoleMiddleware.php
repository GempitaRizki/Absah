<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            if ($request->input('login_as') == 'user') {
                Auth::user()->update(['role' => 'user']);
            } elseif ($request->input('login_as') == 'seller') {
                Auth::user()->update(['role' => 'seller']);
            } elseif ($request->input('login_as') == 'mitra') {
                Auth::user()->update(['role' => 'mitra']);
            } elseif ($request->input('login_as') == 'admin') {
                Auth::user()->update(['role' => 'admin']);
            }
        }
        
        return $next($request);
    }    
}
