<?php
namespace App\Repository\Base;


class BaseRepository
{
	
	public $repository = null;
	public $error = null;
	public $status = null;
	protected $apiResponse = null;
	
	const  USER_AUTH = 'auth/signin';
	
	const  USER_PROFILE = 'user/getProfile';
	const  USER_POST = 'user/getImagePosts';
	const  USER_FOLLOW = 'follower/follow';
	const  USER_UNFOLLOW = 'follower/unfollow';
	const  USER_HOME_FEEDS = 'post/list';
	
	
	const  RESTAURANT_PROFILE = 'restaurant/getProfile';
	const  RESTAURANT_POST = 'restaurant/getImagePosts';
	
	
	const  POST_GET = 'post/get';
	const  DISH_POST = 'post/getImageCheckInPosts';
// 	const  DISCOVER_POST = 'post/getImageCheckInPosts';
	
	
	
	const  RESTAURANT_SEARCH ='restaurant/list';
	const  DISH_SEARCH = 'dish/search';
	const  USER_SEARCH = 'user/listNames';
	
	const  LIST_REGIONS = 'region/list';
	
// 	const  USER_PROFILE = 'user/Profile';
	
	
	public function __construct($postData, $api){

		
		if(isset($_GET['city']) && strlen($_GET['city'])>0)
			$postData['region'] = $_GET['city'];
		
		$result = $this->post($api, $postData);
		
		if($result['status'] == 'error'){
			$this->error = $result['errorCode'];
			
			if($this->error == '6'){
				session_destroy();
				header("Refresh:0");
			}
			
			if($result['errorCode'] !='23000')
				abort(404);
		}
		$this->status = $result['status'];
		
		$this->apiResponse = $result;
		$this->repository = get_called_class();
		
	}
	
	
	
	public static final function  get($url, $headder=[]){
		
		$json = file_get_contents($url);
		return json_decode($json, true);
		
	}
	
	public static final  function post($api , array $postData, $authRequired = true, $tojson = true) {

		if($authRequired)
			if(isset($_SESSION['sessionId']) && empty(!$_SESSION['sessionId']))
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