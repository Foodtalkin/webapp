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
	
	
	public function __construct($postData, $api = self::USER_PROFILE)
	{		
		
		parent::__construct($postData, $api);
		
		if(isset($this->apiResponse['profile']))
			$this->profile = $this->apiResponse['profile'];
		if(isset($this->apiResponse['imagePosts']))
			$this->posts = $this->apiResponse['imagePosts'];
		if(isset($this->apiResponse['favourites']))
			$this->favourites = $this->apiResponse['favourites'];
		
	}
	
	public static function profile($userId){
		
		$postData['selectedUserId'] = $userId;
		$user = new self($postData);
			
		return $user;
		
	}
		
	public static function nextPostPage($userId, $page = 2){
		
		$postData['selectedUserId'] = $userId;
		$postData['page'] = $page;
		$user = new self($postData, self::USER_POST);
		
		return $user;		
		
	}	
	
	public static function follow($userId){
		$postData['followedUserId'] = $userId;
		$obj = new self($postData, self::USER_FOLLOW);
		
		return $obj;
	}
	
	public static function unfollow($userId){
		$postData['followedUserId'] = $userId;
		$obj = new self($postData, self::USER_UNFOLLOW);
		
		return $obj; 
	}
     
}