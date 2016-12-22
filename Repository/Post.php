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
	
	
	public function __construct($postData, $api = self::POST_GET)
	{
		
		parent::__construct($postData, $api);
		
		if(isset($this->apiResponse['post']))		
			$this->post = $this->apiResponse['post'];
		if(isset($this->apiResponse['comments']))
			$this->comments = $this->apiResponse['comments'];
		
	}
	
	public static function profile($Id){
	
		$postData['postId'] = $Id;
		$obj = new self($postData);
		return $obj;
	
	}
	
	public static function addLike($postId){
		$postData['postId'] = $postId;
		$obj = new self($postData, self::POST_LIKE);
		return $obj;
	}
	
	public static function removeLike($postId){
		$postData['postId'] = $postId;
		$obj = new self($postData, self::POST_UNLIKE);
		return $obj;
	} 
	
	public static function addBookmark($postId){
		$postData['postId'] = $postId;
		$obj = new self($postData, self::POST_BOOKMARK);
		return $obj;
	}
	
	public static function removeBookmark($postId){
		$postData['postId'] = $postId;
		$obj = new self($postData, self::POST_UNBOOKMARK);
		return $obj;
	}
	
	public static function report($postId){
		$postData['postId'] = $postId;
		$obj = new self($postData, self::POST_REPORT);
		return $obj;
	}
	
	
	public static function addComment($postId, $comment, $users = array()){
		$postData['postId'] = $postId;
		$postData['comment'] = base64_encode($comment);
		$obj = new self($postData, self::COMMENT_ADD);
		return $obj;
	}
	
}