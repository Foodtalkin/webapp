<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Store;
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
		
		if($obj)
			return  $this->render('user/feeds', (array) $obj , self::SUCCESS_OK);
		else 
			return redirect('/login');
		
	}
	
	
	public function follow($id){
	
		$obj = User::follow($id);
		return $obj->status;
	}
  
	public function unfollow($id){
		
		$obj = User::unfollow($id);
		return $obj->status;
	}
	
	public function store(){
	
		$obj = Store::listAll();
		return  $this->render('store/items', (array) $obj , self::SUCCESS_OK);
			
	}
	
	public function offer($id){
	
		$obj = Store::offer($id);
		// 		var_dump( (array) $obj);
		return  $this->render('store/offer', (array) $obj , self::SUCCESS_OK);
			
	}
	
	public function purchase($id, Request $request){
	
		$obj = Store::purchase($id);
		// 		var_dump( (array) $obj);
// 		return json_encode($obj) ;
		return response()->json ( $obj );
		
// 		return  $this->render('store/offer', (array) $obj , self::SUCCESS_OK);
			
	}
	
	public function purchases(){
	
// 		$obj = array();
		$obj = Store::allPurchases();
		// 		var_dump( (array) $obj);
		return  $this->render('store/purchases', (array) $obj , self::SUCCESS_OK);
	}
	
}
?>