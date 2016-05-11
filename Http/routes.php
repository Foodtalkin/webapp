<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\RestaurantController;


session_start();
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

	$app->get('favicon.ico', function ()  {
		return '404';
	});
	
	
// 		$app->get('/twig', function ()  {
// 			$loader = new Twig_Loader_Filesystem('/var/www/html/webapp/resources/views');				
// 			$twig = new Twig_Environment($loader, array(
// // 					'cache' => '/var/www/html/webapp/storage/twig_cache',
// 			));
// 			echo $twig->render('tests.html', array('name' => 'Fabien', 'dir'=>__DIR__));
// // 			return view('test', ['name' => 'James']);
// 		});

// 		$app->post('user/{id}/{ptype:participation|rsvp}','UserController@participation');

$app->get('redirect',[ 'uses' =>'LoginController@redirect']);

$app->get('login',[ 'uses' =>'LoginController@index']);
$app->post('login',[ 'uses' =>'LoginController@login']);

$app->get('signup',[ 'uses' =>'LoginController@signup']);
$app->post('signup',[ 'uses' =>'LoginController@dosignup']);

$app->get('tour',[ 'uses' =>'LoginController@tour']);

$app->get('logout',[ 'uses' =>'LoginController@logout']);


$app->post('search',[ 'uses' =>'SearchController@search']);
$app->get('search',[ 'uses' =>'SearchController@index']);


$app->group([
		'middleware' => 'getlocation',
		'prefix' => 'dish',
		'namespace' => 'App\Http\Controllers'
], function($app)
{
	$app->get('{id}',[ 'uses' =>'DishController@profile']);
});


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
		