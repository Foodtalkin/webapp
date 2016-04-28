<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Post extends BaseRepository
{

	public  $post = null;
	public  $comments = null;
// 	public  $favourites = null;
	
	
	public function __construct($userId)
	{
		$postData['postId'] = $userId;		
		$data = $this->post(self::POST_GET, $postData);
		
		$this->post = $data['post'];
		$this->comments = $data['comments'];
// 		$this->favourites = $userProfile['favourites'];
		
	}
	
// 	public static function nextPostPage($userId, $page = 2){		
// 		$postData['page'] = 2;
// 		return $posts = $this->post(self::USER_POST, $postData);
		
// 	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}