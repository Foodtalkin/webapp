<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;
use Illuminate\Support\Facades\Redirect;

class Store extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $storeItems = null;
	public  $storeOffer = null;
	public  $storePurchase = null;
	public  $news = null;
	
	
	
	public function __construct($postData=array(), $api = self::STORE_ITEMS)
	{		
		
		parent::__construct($postData, $api);
		
		if(isset($this->apiResponse['profile']))
			$this->profile = $this->apiResponse['profile'];
		
		if(isset($this->apiResponse['storeItems']))
			$this->storeItems = $this->apiResponse['storeItems'];
		
		if(isset($this->apiResponse['storeOffer']))
			$this->storeOffer = $this->apiResponse['storeOffer'];
		
		if(isset($this->apiResponse['storePurchase']))
			$this->storePurchase = $this->apiResponse['storePurchase'];
		
		if(isset($this->apiResponse['news']))
			$this->news = $this->apiResponse['news'];
		
		
	}
	
	public static function listAll(){
		$store = new self();
		return $store;
		
	}
	
	public static function news($id){
	
		$postData['id'] = $id;
		$result = new self($postData, self::NEWS_GET);
		return $result;
	
	}
	
	public static function offer($id){
		
		$postData['storeItemId'] = $id;
		$result = new self($postData, self::STORE_OFFER);
		return $result;	
	
	}
	
	public static function purchase($id){
	
		$postData['storeItemId'] = $id;
		$result = new self($postData, self::STORE_PURCHASE);
		return $result;
	
	}
	
	
	public static function allPurchases(){
	
		$result = new self([], self::STORE_ALLPURCHASES);
		return $result;
	
	}
	
	public static function nextPostPage($userId, $page = 2){
		
		$postData['selectedUserId'] = $userId;
		$postData['page'] = $page;
		$user = new self($postData, self::USER_POST);
		
		return $user;		
		
	}	
	
	public static function feeds($page=1, $user=1){
		
		if(!isset($_SESSION['user']['id'])){
			$postData['postUserId'] = $user;
// 			return false;
		}else 
			$postData['postUserId'] = $_SESSION['user']['id'];
			
			
		
		$postData['includeCount'] = '1';
		$postData['recordCount'] = '15';
		$postData['page'] = $page;
		$postData['includeFollowed'] = '1';
		$obj = new self($postData, self::USER_HOME_FEEDS);
		$obj->repository = '';
	
		return $obj;
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