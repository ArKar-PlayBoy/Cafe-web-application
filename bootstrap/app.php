<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
<<<<<<< HEAD
=======
        api: __DIR__.'/../routes/api.php',
>>>>>>> 5b466fb (more reliable and front-end changes)
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        //
=======
        // Exclude the Stripe webhook from CSRF verification
        $middleware->validateCsrfTokens(except: [
            '/webhook/stripe',
        ]);

        // Append global security headers to every web response
        $middleware->web(append: [
            App\Http\Middleware\SecurityHeaders::class,
        ]);

        // Append ban check to authenticated web routes
        $middleware->appendToGroup('web', [
            App\Http\Middleware\EnsureUserIsNotBanned::class,
        ]);
>>>>>>> 5b466fb (more reliable and front-end changes)
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
