<?php

namespace App\Exceptions;

use Auth;
use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

	protected function unauthenticated($request, AuthenticationException $exception)
	{
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}
		$guard = array_get($exception->guards(), 0);
		switch ($guard) {
			case 'admin':
				$login = 'admin.login';
				break;
			default:
				$login = 'login';
				break;
		}
		return redirect()->guest(route($login));
	}

	/**
	 * @param         $request
	 * @param Closure $next
	 * @param null    $guard
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		switch ($guard) {
			case 'admin':
				if (Auth::guard($guard)->check()) {
					return redirect('/');
				}
				break;
			default:
				if (Auth::guard($guard)->check()) {
					return redirect('/');
				}
				break;
		}
		return $next($request);
	}
}
