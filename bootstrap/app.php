<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\RedirectByRoleIfAuthenticatedMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                "seller" => SellerMiddleware::class,
                "buyer" => BuyerMiddleware::class,
                "admin" => AdminMiddleware::class,
                "role.redirect" => RedirectByRoleIfAuthenticatedMiddleware::class,
            ]
            );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
