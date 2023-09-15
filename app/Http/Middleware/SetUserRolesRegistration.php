<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class SetUserRolesRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('login_as') == 'user') {
            Auth::user()->role = 'user';
        } elseif ($request->input('login_as') == 'seller') {
            Auth::user()->role = 'seller';
        } else {
            Auth::user()->role = 'mitra';
        }

        return $next($request);
    }
}
