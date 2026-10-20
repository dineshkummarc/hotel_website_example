<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\RoomNotAvailableException;
use App\Http\Middleware\AdminMiddleware;
use App\Exceptions\BookingException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (
            RoomNotAvailableException $e,
            $request
        ) {
            return back()->withErrors([
                'room' => $e->getMessage(),
            ]);
        });

        $exceptions->render(function (
            BookingException $e,
            $request
        ) {
            return back()->withErrors([
                'booking' => $e->getMessage(),
            ]);
        });
    })
    ->create();
