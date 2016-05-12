<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Dish extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $posts = null;
	
	
	public function __construct($Id)
	{
		$dishName = str_replace('-', ' ',$Id);
		$postData['search'] = $dishName;
		$postData['recordCount'] = 15;
		
		if(isset($_COOKIE['location'])){
			$location = json_decode($_COOKIE['location']);
			$postData['longitude'] = $location->longitude;
			$postData['latitude'] = $location->latitude;
		}
		
// 		abort(404, 'newsas');
		
		$result = $this->post(self::DISH_POST, $postData);
		
		if($result['status'] == 'error'){
			$this->error = $result['errorCode'];
			abort(404);
		}
		
		
		$this->profile['dishName'] = $dishName;
		$this->profile['dishUrl'] = $Id;
		
		$this->posts = $result['posts'];
		parent::__construct();
	}
	
	public function getImagePostnext($page = 2, $userId){
		
	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}