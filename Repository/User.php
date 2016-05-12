<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class User extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $posts = null;
	public  $favourites = null;
	
	
	public function __construct($userId)
	{
		$postData['selectedUserId'] = $userId;		
		$userProfile = $this->post(self::USER_PROFILE, $postData);
		
		if($userProfile['status'] == 'error'){
			$this->error = $userProfile['errorCode'];
// 			echo $userProfile['errorCode'];
			abort(404);
		}
		
		$this->profile = $userProfile['profile'];
		$this->posts = $userProfile['imagePosts'];
		$this->favourites = $userProfile['favourites'];
		parent::__construct();
	}
	
	public static function nextPostPage($userId, $page = 2){		
		$postData['page'] = 2;
		return $posts = $this->post(self::USER_POST, $postData);
		
	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}