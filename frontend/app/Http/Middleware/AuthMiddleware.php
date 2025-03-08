<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user') || !session()->has('token')) {
            return redirect('/login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
