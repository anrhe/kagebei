<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        info('Incoming Request: ', [
            'method' => $request->method(),
            'url' => $request->url(),
            'input' => $request->all(),
            'role' => Auth::check() ? Auth::user()->role : 'Guest',
            'username' => Auth::check() ? Auth::user()->name : 'Guest',
            'ip_address' => $request->ip(),
        ]);
    
        return $next($request);
    }
}
