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
    			return redirect('https://ad.apps.fm/jmXM2toyVlrwIvmv8VZDkPE7og6fuV2oOMeOQdRqrE125Vg6lhH50uF5NCjHXTL9ndN7N82s3TL60zJZOK6POUBYEUDp6GpykR5a_XD8NGKkdSPWlsFH6ajCbGh5uIRv');
//     			return redirect('/mobile.html');
    			break;
    		case 'Android': /*do something...*/
    			return redirect('https://ad.apps.fm/9MpxPO99wKQgBEPRqzDo815KLoEjTszcQMJsV6-2VnHFDLXitVHB6BlL95nuoNYfYvrzlFgS_zzkrHYzgzi8dsJvx-g4JaFUTDh_-g1MzffBHpUDVnJfCIp-45MBCvZW0EBbbxphpu_GHoB5DVgsXw');
//     			return redirect('/mobile.html');
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
