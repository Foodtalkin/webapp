<?php
namespace App\Repository\Base;


class BaseRepository
{
	
	const  USER_PROFILE = 'user/getProfile';
	const  USER_POST = 'user/getImagePosts';
	
	const  RESTAURANT_PROFILE = 'restaurant/getProfile';
	
	const  POST_GET = 'post/get';
// 	const  USER_PROFILE = 'user/Profile';
// 	const  USER_PROFILE = 'user/Profile';
	
	
	
	
	public static final function  get($url, $headder=[]){
		
		$json = file_get_contents($url);
		return json_decode($json, true);
		
	}
	
	public static final  function post($api , array $postData, $tojson = true) {

		if(isset($_SESSION['sessionId']) && empty($_SESSION['sessionId']))
			$postData['sessionId'] = $_SESSION['sessionId'];
		else 
			$postData['sessionId'] = 'GUEST';
		
		$data_string = json_encode($postData, true);		
		$url = self::UrlFactory($api);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'FoodTalk webapp 1.0');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string))
		);
		 
		$response = curl_exec($ch);
		$err = curl_error($ch);		
		curl_close($ch);
		
		if ($err) {
			error_log("cURL Error # : " . $err);
			return array();
		} else {
			return  json_decode($response, true);
		}
		
	}
	
	public static final function UrlFactory($api) {
		$url = env('API_URL').$api;
		return $url;
	}
	
}