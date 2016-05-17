<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;

class UserController extends Controller{
  
	
		
	public function profile($userName, $page=1){
		
		if($this->ajax)
			$obj  = User::nextPostPage($userName, $page);
		else 
			$obj = User::profile($userName);
		
		return  $this->render('user/get', (array) $obj , self::SUCCESS_OK);
			
	}
	
	public function feeds($page=1){
		
		$obj = User::feeds($page);
		return  $this->render('user/feeds', (array) $obj , self::SUCCESS_OK);
		
	}
	
	
	public function follow($id){
	
		$obj = User::follow($id);
		return $obj->status;
	}
  
	public function unfollow($id){
		
		$obj = User::unfollow($id);
		return $obj->status;
	}
}
?>