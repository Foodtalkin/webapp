<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Restaurant extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $posts = null;
	
	
	public function __construct($Id)
	{
		$postData['restaurantId'] = $Id;		
		
		$userProfile = $this->post(self::RESTAURANT_PROFILE, $postData);
		

		if($userProfile['status'] == 'error'){
			$this->error = $userProfile['errorCode'];
// 			echo $userProfile['errorCode'];
			abort(404);
		}
		
		$this->profile = $userProfile['restaurantProfile'];
		$this->posts = $userProfile['images'];
		parent::__construct();
	}
	
	public function getImagePostnext($page = 2, $userId){
		
	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}