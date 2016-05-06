<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Login extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $isNewUser = false;
	
	
	public function __construct($user)
	{
		
		$result = $this->post(self::USER_AUTH, $user, false);
		
		$this->profile = $result['profile'];
		
		if((boolval($result['isNewUser'])))
			$this->isNewUser = true;
		
		parent::__construct();
	}
	
	public function getImagePostnext($page = 2, $userId){
		
	}
	
// 	public function getProfile(){
// 		return $profile;
// 	}
	
	
     
}