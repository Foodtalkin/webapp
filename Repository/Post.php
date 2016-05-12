<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Post extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $post = null;
	public  $comments = null;
// 	public  $favourites = null;
	
	
	public function __construct($userId)
	{
		$postData['postId'] = $userId;		
		$data = $this->post(self::POST_GET, $postData);
		
		
		if($data['status'] == 'error'){
			$this->error = $data['errorCode'];
			// 			echo $userProfile['errorCode'];
			abort(404);
		}
		
		
		$this->post = $data['post'];
		$this->comments = $data['comments'];
// 		$this->favourites = $userProfile['favourites'];
		parent::__construct();
	}
	
// 	public static function nextPostPage($userId, $page = 2){		
// 		$postData['page'] = 2;
// 		return $posts = $this->post(self::USER_POST, $postData);
		
// 	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}