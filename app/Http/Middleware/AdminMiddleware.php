<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (\Auth::guest() == false){
			$isAdminTrue = \Auth::user()->isadmin;
			if ($isAdminTrue === true){
				return $next($request);
			}
		}
		return redirect('/403');
    }
}
