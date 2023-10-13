<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Logout;
use App\Events\LogoutEvent;

class ActivityLogger
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $ip = $request->ip();
            $browser = $request->header('User-Agent');

            Activity::create([
                'type' => 'activity',
                'message' => 'User logged in: ' . $user->username,
                'ip' => $ip,
                'user_agent' => $browser,
            ]);
        }

        $response = $next($request);

        return $response;
    }
}
