<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class BuyerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie que l'utilisateur est connecté ET que son rôle est 'buyer'
        if (!Auth::check() || Auth::user()->role !== 'buyer') {
            abort(403, 'Accès réservé aux acheteurs.');
        }

        return $next($request);
    }
}
