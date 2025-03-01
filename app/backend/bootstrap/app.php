<?php

use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias(['auth:sanctum' => EnsureFrontendRequestsAreStateful::class]);
    })
    ->withExceptions(function ($exceptions) {
        $exceptions->register(function (AuthenticationException $e, $request) {
            return response()->json(['message' => 'Unauthorized'], 401);
        });
    })
    ->create();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
