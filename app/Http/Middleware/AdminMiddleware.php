<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie que l'utilisateur est connecté ET que son rôle est 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            if (Auth::check() && Auth::user()->role == 'seller') {
                return redirect()->route('seller.dashboard.index');
            }

            if (Auth::check() && Auth::user()->role == 'buyer') {
                return redirect()->route('home.index');
            }

            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
