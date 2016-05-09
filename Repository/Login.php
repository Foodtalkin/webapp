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
	
	
	public function __construct($user)
	{
		
		$result = $this->post(self::USER_AUTH, $user, false);
		
		if (isset($result['profile'])){
			$this->profile = $result['profile'];
			$_SESSION['user'] = $this->profile;
			$_SESSION['sessionId'] = $result['sessionId'];
				
		}else {
			
			return self::logout();
		}
		
		
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