<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Comment extends BaseRepository
{

	const REPOSITORY = __CLASS__;
// 	public  $post = null;
	public  $comment = null;
// 	public  $favourites = null;
	
	
	public function __construct($postData, $api = self::POST_GET)
	{
		
		parent::__construct($postData, $api);
		
// 		if(isset($this->apiResponse['post']))		
// 			$this->post = $this->apiResponse['post'];
		if(isset($this->apiResponse['comment']))
			$this->comment = $this->apiResponse['comment'];
		
	}
	
	public static function addComment($postId, $comment, $users = array()){
		$postData['postId'] = $postId;
		$postData['comment'] = base64_encode($comment);
		$obj = new self($postData, self::COMMENT_ADD);
		return $obj;
	}
	
}