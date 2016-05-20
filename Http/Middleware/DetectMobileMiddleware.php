<?php

namespace App\Http\Middleware;

use Closure;

class DetectMobileMiddleware
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

    	
    	preg_match("/iPhone|Android|iPad|iPod|webOS/", $_SERVER['HTTP_USER_AGENT'], $matches);
    	$os = current($matches);
    	
    	
    	switch($os){
    		case 'iPhone': /*do something...*/
    		case 'iPad': /*do something...*/
    		case 'iPod': /*do something...*/ 
//     			return redirect('https://itunes.apple.com/in/app/food-talk-plus/id923340748?mt=8');
    			return redirect('/mobile.html');
    			break;
    		case 'Android': /*do something...*/
    			return redirect('/mobile.html');
    			break;
//     		case 'webOS': /*do something...*/ break;
    	}
//     	if(!isset($_COOKIE['location'])){
//     		header('Location: https://store.foodtalk.in/tt.php');
//     		exit(1);
//     	}
    	
        return $next($request);
    }
}
