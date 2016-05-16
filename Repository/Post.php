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
	
     
}