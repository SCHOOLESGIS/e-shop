<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard'; // Redirection Breeze par défaut

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    public static function redirectToHome()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin' => route('admin.dashboard.stats'),
            'seller' => route('seller.boutique.index'),
            default => route('buyer.produit.index'),
        };
    }
}
