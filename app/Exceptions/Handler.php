<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use PDOException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response|JsonResponse
     */
    public function render($request, Exception $exception)
    {
        Log::info($exception);

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response([
                    'message' => trans('errors.wrong_method')

                ], 405);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response([
                    'message' => trans('errors.resource_not_found')
                ], 404);
            }

            if ($exception instanceof ErrorException || $exception instanceof InvalidArgumentException || $exception instanceof PDOException) {
                return response([
                    'message' => trans('errors.internal_server_error')
                ], 500);
            }

            if ($exception instanceof UnauthorizedException) {

                if($exception->getMessage() == 'user'){
                    return response([
                        'message' => trans('errors.wrong_password')
                    ], 401);
                } else{
                    return response([
                        'message' => trans('errors.permission_denied')
                    ], 403);
                }
            }
        return parent::render($request, $exception);
    }
}
