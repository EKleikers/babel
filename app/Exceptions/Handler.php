<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {

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
     * @param  \Exception  $e
     * @return void
     */
    public function report(Throwable $e) {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e) {
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect($request->fullUrl())->withErrors(trans('login.formexpired'));
        }
        if ($this->isHttpException($e)) {
            if ($e->getStatusCode() == 404) {
                $client = \DB::table('appsforce_client')->first();
                if ($client != null) {
                    $frontapp = $client->frontapp;
                    if ($frontapp != 'NULL' && $frontapp != '') {
                        $urlrequest = $_SERVER['REQUEST_URI'];
                        return response()->view('front', ['urlrequest' => $urlrequest], 500);
                    } 
                }
            }
        }
        if ($e instanceof \Illuminate\Database\QueryException) {
            return redirect($request->fullUrl())->withErrors(trans('notific8.databaseexception'));
        }   
        return parent::render($request, $e);
    }
}
