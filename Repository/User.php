<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class User extends BaseRepository
{

	public  $profile = null;
	public  $imgePost = null;
	public  $favourites = null;
	
	
	public function __construct($userId)
	{
		$postData['selectedUserId'] = $userId;		
		$userProfile = $this->post(self::USER_PROFILE, $postData);
		
		$this->profile = $userProfile['profile'];
		$this->imgePost = $userProfile['imagePosts'];
		$this->favourites = $userProfile['favourites'];
		
	}
	
	public static function nextPostPage($userId, $page = 2){		
		$postData['page'] = 2;
		return $posts = $this->post(self::USER_POST, $postData);
		
	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}