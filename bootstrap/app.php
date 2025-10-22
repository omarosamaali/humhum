<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminRole::class,
            'auth.chef' => \App\Http\Middleware\ChefAuthMiddleware::class,
            'AuthChefLens' => \App\Http\Middleware\AuthChefLens::class,
            'auth.user' => \App\Http\Middleware\AuthUser::class,
            'check.user' => \App\Http\Middleware\CheckUser::class,
            'locale' => \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //

    })->create();
