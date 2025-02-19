<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //web: __DIR__.'/../routes/web.php',
        //commands: __DIR__.'/../routes/console.php',
        //health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\ForceJsonResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'error'    => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'error' => 'Unauthenticated: Bearer token is missing or invalid.'
            ], 401);
        });

        $exceptions->render(function (AuthorizationException $e, Request $request) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        });

        $exceptions->render(function (\Throwable $e, Request $request) {
            return response()->json([
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ], 500);
        });
        
        $exceptions->render(function (HttpException $e, Request $request) {
            return response()->json([
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ], $e->getStatusCode());
        });
    })->create();
