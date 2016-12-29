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

$app->get('/', function () use ($app) {
		return redirect('/index.html');
});


$app->get('favicon.ico', function ()  {
	return '404';
});

$app->group([
		'middleware' => ['detectMobile'],
		'namespace' => 'App\Http\Controllers'
], function($app)
{

$app->get('signup',[ 'uses' =>'LoginController@signup']);
$app->post('signup',[ 'uses' =>'LoginController@dosignup']);
$app->get('logout',[ 'uses' =>'LoginController@logout']);
$app->post('login',[ 'uses' =>'LoginController@login']);

});

$app->group([
		'middleware' => ['logincheck', 'detectMobile'],
		'namespace' => 'App\Http\Controllers'
], function($app)
{
	
	$app->get('home',[ 'uses' =>'UserController@feeds']);
	
	$app->get('store',[ 'uses' =>'UserController@store']);
	$app->get('purchases',[ 'uses' =>'UserController@purchases']);
	$app->get('store/offer/{id}',[ 'uses' =>'UserController@offer']);
	$app->post('/storeItem/{id}/purchase',[ 'uses' =>'UserController@purchase']);
	
	
// 	$app->get('discover',[ 'middleware' => ['getlocation'], 'uses' =>'DiscoverController@profile']);
// 	$app->get('discover/page/{page}',[ 'middleware' => ['getlocation'], 'uses' =>'DiscoverController@profile']);

	$app->get('home/page/{page}',[ 'uses' =>'UserController@feeds']);
	
	$app->get('redirect',[ 'uses' =>'LoginController@redirect']);
	$app->get('login',['middleware' => 'logincheck', 'uses' =>'LoginController@index']);
	$app->get('tour',[ 'uses' =>'LoginController@tour']);
	
	$app->get('search',[ 'uses' =>'SearchController@search']);
// 	$app->post('search',[ 'uses' =>'SearchController@search']);
// 	$app->get('search',[ 'uses' =>'SearchController@index']);

	$app->get('dish/{id}',[
// 			'middleware' => ['getlocation'], 
			'uses' =>'DishController@profile'
	]);
	$app->get('dish/{id}/page/{page}',[
// 			'middleware' => ['getlocation'],
			'uses' =>'DishController@profile'
	]);
	
	$app->post('post/{id}/like/{action:add|remove}','PostController@like');
	$app->post('post/{id}/comment','PostController@comment');
	$app->post('post/{id}/report','PostController@report');
	
	$app->post('post/{id}/bookmark/{action:add|remove}','PostController@bookmark');
	
	$app->post('follow/{id}','UserController@follow');
	
	
	$app->get('post/{id}/{for}','PostController@profile');
	$app->get('post/{id}','PostController@profile');
	
	$app->post('follow/{id}','UserController@follow');
	$app->post('unfollow/{id}','UserController@unfollow');
	
	
	$app->get('/{id}/page/{page}', function (Request $request, $id, $page) {
	
		$ctrl = getContrller($id);
		return $ctrl->profile($id, $page);
	
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
		