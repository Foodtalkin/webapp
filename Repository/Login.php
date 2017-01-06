<?php namespace App\Repository;
  
// use Illuminate\Database\Eloquent\Model;
// use App\Models\Base\BaseModel;
use App\Repository\Base\BaseRepository;

class Login extends BaseRepository
{

	const REPOSITORY = __CLASS__;
	public  $profile = null;
	public  $isNewUser = false;
	
	
	public static function logout(){
		session_destroy();
		return redirect('/login');
	}
	
	
	public function __construct($postData, $api = self::USER_AUTH)
	{
		parent::__construct($postData, $api);
		
		if(isset($this->apiResponse['profile'])){			
			$this->profile = $this->apiResponse['profile'];
			$_SESSION['user'] = $this->profile;
			$_SESSION['sessionId'] = $this->apiResponse['sessionId'];
			
			if(isset($postData['email']))
				$_SESSION['user']['email'] = $postData['email'];
			
			if(isset($this->profile['cityId']))
				$_SESSION['user']['cityId'] = $this->profile['cityId'];
			
				
		}
		
		
		if(isset($this->apiResponse['isNewUser']))
			$this->isNewUser = (boolval($this->apiResponse['isNewUser']));
		
	}

	public static function doLogin($user){
		
		$obj = new self($user);
		return $obj;
		
	}
     
}