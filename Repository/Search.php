<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Search extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $users = null;
	public  $dishes = null;
	public  $restaurants = null;
	public  $searchTxt = NULL;
	
	
	public function __construct($Id)
	{
		$this->searchTxt = $Id;
		
		$userpostData['searchText'] = $Id;		
		$user = $this->post(self::USER_SEARCH, $userpostData);
		$this->users = $user['users'];
		
		$dishpostData['search'] = $Id;
		$dishes = $this->post(self::DISH_SEARCH, $dishpostData);
		$this->dishes = $dishes['result'];
		
		$restaurantspostData['searchText'] = $Id;
		$restaurants = $this->post(self::RESTAURANT_SEARCH, $restaurantspostData);
		$this->restaurants = $restaurants['restaurants'];
		
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