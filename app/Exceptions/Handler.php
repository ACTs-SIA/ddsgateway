<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {

        // Resource not found
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        // Validation error
        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Validation error',
                'messages' => $exception->errors()
            ], 422);
        }

        // HTTP exceptions (404, 405 etc.)
        if ($exception instanceof HttpException) {
            return response()->json([
                'error' => $exception->getMessage() ?: 'HTTP error'
            ], $exception->getStatusCode());
        }

        // Generic error
        return response()->json([
            'error' => 'Gateway server error',
            'message' => $exception->getMessage()
        ], 500);
    }
}