<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware; // Importa il middleware dei ruoli

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, // Usa il namespace corretto
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    // ->withMiddleware(function (Middleware $middleware) {
    //     $middleware->web(append: [
    //         \App\Http\Middleware\HandleInertiaRequests::class,
    //         \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
    //         \Spatie\Permission\Middleware\RoleMiddleware::class, // Aggiungi il middleware per i ruoli
    //     ]);

    // })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
