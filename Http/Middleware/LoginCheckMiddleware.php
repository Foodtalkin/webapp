<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheckMiddleware
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
    	if(isset($_SESSION['user']))
    		if(isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))<1 ){
    			return redirect('/signup');
    		}
        return $next($request);
    }
}
