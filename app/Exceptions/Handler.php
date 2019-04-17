<?php

namespace App\Exceptions;

use Exception;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\ValidationExeption;
use Intervention\Image\Exception\NotReadableException as NotReadableException;
use UnexpectedValueException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport
        = [
            //
        ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash
        = [
            'password',
            'password_confirmation',
        ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json(['message' => 'Unauthorized: ' . $exception->getMessage()],
                '401');
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Wrong data: ' . $exception->getMessage()],
                '404');
        }

        if ($exception instanceof PermissionDeniedException) {
            return response()->json(['message' => $exception->getMessage()],
                '403');
        }

        if ($exception instanceof UnexpectedValueException) {
            return response()->json(['message' => $exception->getMessage()],
                '406');
        }

        if ($exception instanceof \InvalidArgumentException) {
            return response()->json(['message' => $exception->getMessage()],
                '406');
        }

        if ($exception instanceof NotReadableException) {
            return response()->json(['message' => $exception->getMessage()],
                '415');
        }
        if ($exception instanceof ErrorException) {
            return response()->json(['message' => $exception->getMessage()],
                '415');
        }
    }
}
