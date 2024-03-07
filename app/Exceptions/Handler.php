<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.403', [], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() == 404) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() == 429) {
            return response()->view('errors.429', [], 429);
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
            return response()->view('errors.500', [], 500);
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() == 503) {
            return response()->view('errors.503', [], 503);
        }

        return parent::render($request, $exception);
    }
}
