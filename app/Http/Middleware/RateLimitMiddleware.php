<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->header('X-Forwarded-For') ?? $request->ip();
        $sessionId = Session::getId();
        $previousSession = Session::get('ip_sessions.' . $ip);
    
        // dump('IP Address: ' . $ip);
        // dump('Current Session ID: ' . $sessionId);
        // dump('Previous Session ID: ' . $previousSession);
    
        if ($previousSession !== $sessionId) {
            // If a different session exists for the same IP address, clear it
            Session::forget('ip_sessions.' . $ip);
            Session::put('ip_sessions.' . $ip, $sessionId); // Update previous session ID
            return redirect('/prompt-for-previous-session');
        }
    
        // Store session ID based on IP address
        if (!$previousSession) {
            Session::put('ip_sessions.' . $ip, $sessionId);
        }
    
        return $next($request);
    }
    
     
}
