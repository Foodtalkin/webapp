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


$app->get('favicon.ico', function ()  {
	return '404';
});
	
$app->get('signup',[ 'uses' =>'LoginController@signup']);
$app->post('signup',[ 'uses' =>'LoginController@dosignup']);
$app->get('logout',[ 'uses' =>'LoginController@logout']);
$app->post('login',[ 'uses' =>'LoginController@login']);

$app->group([
		'middleware' => ['logincheck'],
		'namespace' => 'App\Http\Controllers'
], function($app)
{
	
	$app->get('redirect',[ 'uses' =>'LoginController@redirect']);
	$app->get('login',['middleware' => 'logincheck', 'uses' =>'LoginController@index']);
	$app->get('tour',[ 'uses' =>'LoginController@tour']);
	
	$app->post('search',[ 'uses' =>'SearchController@search']);
	$app->get('search',[ 'uses' =>'SearchController@index']);

	$app->get('dish/{id}',[	'middleware' => ['getlocation'], 'uses' =>'DishController@profile']);
	
	$app->get('post/{id}','PostController@profile');
	
	$app->get('/{id}/page/{page}', function (Request $request, $id, $page) {
	
		$ctrl = getContrller($id);
		return $ctrl->profile($id);
	
	});
	
	$app->get('/{id}', function (Request $request, $id) {
					
		$ctrl = getContrller($id);
		return $ctrl->profile($id);
	
	});
});
	

function getContrller($id){
	if(is_numeric($id)){
		return new RestaurantController();
	}else 
	 	return new UserController();
}
		
// 	$app->get('user','UserController@profile');
		