<?php
declare( strict_types = 1 );

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckCanModifyThread
 * @package App\Http\Middleware
 */
class CheckCanModifyThread
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle ($request, Closure $next)
	{
		$thread = $request->route('thread');

		if ($thread->user_id === \Auth::user()->id)
			return $next($request);
		else
			return redirect('profile');
	}
}
