<?php

namespace App\Http\Middleware;

use Closure;

class GetLocationMiddleware
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
    	
    	if(!isset($_COOKIE['location'])){
    		header('Location: https://store.foodtalk.in/tt.php');
    		exit(1);
    	}
    	
        return $next($request);
    }
}
