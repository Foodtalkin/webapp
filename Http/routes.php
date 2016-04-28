<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\RestaurantController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->version();
// });


// $app->get('/', function() use ($app) {

// 	return response( '{"message":"welcom to '.$_SERVER['HTTP_HOST'].'"}', 200, ['Content-type'=>'application/json']);
// });

// 	$app->get('/', function ()  {
// 		return view('test', ['name' => 'James']);
// 	});
	
	
// 		$app->get('/twig', function ()  {
// 			$loader = new Twig_Loader_Filesystem('/var/www/html/webapp/resources/views');				
// 			$twig = new Twig_Environment($loader, array(
// // 					'cache' => '/var/www/html/webapp/storage/twig_cache',
// 			));
// 			echo $twig->render('tests.html', array('name' => 'Fabien', 'dir'=>__DIR__));
// // 			return view('test', ['name' => 'James']);
// 		});

// 		$app->post('user/{id}/{ptype:participation|rsvp}','UserController@participation');


	$app->get('post/{id}','PostController@profile');
	
	$app->get('/{id}', function (Request $request, $id) {
					
		$ctrl = getContrller($id);
		return $ctrl->profile($id);
	
	});

	$app->get('/{id}/page/{page}', function (Request $request, $id, $page) {
	
		$ctrl = getContrller($id);
		return $ctrl->profile($id);
	
	});


function getContrller($id){
	if(is_numeric($id)){
		return new RestaurantController();
	}else 
	 	return new UserController();
}
		
// 	$app->get('user','UserController@profile');
		