<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Restaurant extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $posts = null;
	public  $for = 'resturant';
	
	
	public function __construct($postData, $api = self::RESTAURANT_PROFILE)
	{
		
		parent::__construct($postData, $api);
		
		if(isset($this->apiResponse['restaurantProfile']))
			$this->profile = $this->apiResponse['restaurantProfile'];
		if(isset($this->apiResponse['images']))
			$this->posts = $this->apiResponse['images'];
		
	}

	public static function profile($Id){

		$postData['restaurantId'] = $Id;
		$obj = new self($postData);
			
		return $obj;
	
	}
	
	public static function nextPostPage($Id, $page = 2){
		
		$postData['restaurantId'] = $Id;
		$postData['page'] = $page;
		
		$obj = new self($postData, self::RESTAURANT_POST);
		
		return $obj;
		
	}
	
}