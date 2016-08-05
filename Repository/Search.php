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
	public  $searchCity = 'delhi';
	public  $regionList = null;
	
	
	public function __construct($Id)
	{
		$this->searchTxt = $Id;
		
		if(isset($_GET['city']) && $_GET['city']!='')
			$this->searchCity = $_GET['city'];
		
		
		$region = $this->post(self::LIST_REGIONS, array());
		$this->regionList = $region['regions'];
		
		
		$userpostData['searchText'] = $Id;		
		$userpostData['region'] = $this->searchCity;
		$user = $this->post(self::USER_SEARCH, $userpostData);
		$this->users = $user['users'];
		
		$dishpostData['search'] = $Id;
		$dishpostData['region'] = $this->searchCity;
		$dishes = $this->post(self::DISH_SEARCH, $dishpostData);
		$this->dishes = $dishes['result'];
		
		$restaurantspostData['searchText'] = $Id;
		$restaurantspostData['region'] = $this->searchCity;
		$restaurants = $this->post(self::RESTAURANT_SEARCH, $restaurantspostData);
		$this->restaurants = $restaurants['restaurants'];
		
		$this->repository = self::REPOSITORY;
	}
	
     
}