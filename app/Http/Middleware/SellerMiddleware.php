<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est connecté et a le rôle 'seller'
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            if (Auth::check() && Auth::user()->role == 'buyer') {
                return redirect()->route('home.index');
            }

            if (Auth::check() && Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard.stats');
            }
            abort(403, 'Accès réservé aux vendeurs.');
        }

        return $next($request);
    }
}
