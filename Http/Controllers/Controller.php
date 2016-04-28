<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	
	const SUCCESS_OK = 200; // 200 => 'OK',
	const UN_AUTHORIZED = 401;	// 401 => 'Unauthorized',
	// 402 => 'Payment Required',
	const FORBIDDEN = 403; // 403 => 'Forbidden',
	const NOT_FOUND = 404; // 404 => 'Not Found',
	// 405 => 'Method Not Allowed',
	const NOT_ACCEPTABLE = 406; // 404 => 'Not Found',
	
	
	public function __construct()
	{
		//
	}
	
// 	public function renderTwig($view, array $data = []){
		
// 		require_once '/var/www/html/webapp/vendor/twig/twig/lib/Twig/Autoloader.php';
// 		Twig_Autoloader::register();
		
	
// 		$loader = new Twig_Loader_Filesystem('/var/www/html/webapp/app/resources/views');
// 		$twig = new Twig_Environment($loader, array(
// 				// 					'cache' => '/var/www/html/webapp/storage/twig_cache',
// 		));
// 		// 		echo $twig->render('tests.html', array('name' => 'Fabien', 'dir'=>__DIR__));
	
// 		return  $twig->render($view.'.html', $data);
// 	}
	
	protected final function render($view, array $data = [], $status = self::SUCCESS_OK, $message = null){
		
		return response(
				renderTwig($view, $data), 
				$status
				);		
	}	
	
}
