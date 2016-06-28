<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Dish extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $posts = null;
	
	public function __construct($postData, $api = self::DISH_POST)
	{
		$dishName = str_replace('-', ' ',$postData['dishId'] );
// 		$postData['search'] = $dishName;
		$postData['recordCount'] = 15;
		
		if(isset($_COOKIE['location'])){
			$location = json_decode($_COOKIE['location']);
			$postData['longitude'] = $location->longitude;
			$postData['latitude'] = $location->latitude;
		}
		
		parent::__construct($postData, $api);
		
		$this->profile['dishName'] = $dishName;
		$this->profile['dishUrl'] = $postData['dishId'];
		
		if(isset($this->apiResponse['posts'])){
			
			$this->posts = $this->apiResponse['posts'];
			if(isset($this->posts[0]['dishName']))
				$this->profile['dishName'] = $this->posts[0]['dishName'];
			
		}
		
	}
	
	public static function profile($Id){
		
		$postData['dishId'] = $Id;
		$postData['page'] = 1;
		
		$obj = new self($postData);
			
		return $obj;
	}
	public static function nextPostPage($Id, $page = 2){
		
		$postData['dishId'] = $Id;
		$postData['page'] = $page;
		
		$obj = new self($postData);
			
		return $obj;
	}
	
     
}