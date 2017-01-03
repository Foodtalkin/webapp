<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller{
  
	
	
	public function profile($restaurantId, $page=1){
		
		
		
		if($this->ajax)
			$obj  = Restaurant::nextPostPage($restaurantId, $page);
		else
			$obj = Restaurant::profile($restaurantId);
		
		
		return  $this->render('restaurant/get', (array)$obj , self::SUCCESS_OK);
		
	}
	
	
	public function report($id,$type){
	
	}
	
	public function nextPostPage(){
		
// 		return  $this->render('restaurant/get', $data , self::SUCCESS_OK);
		
	}
	
  
// 	public function listAll() {
				
// 		$contact = Contact::orderBy('created_at', 'desc')->paginate ($this->pageSize);
// 		return $this->sendResponse ( $contact );
// 	}
	
// 	// gets a user with id
// 	public function get(Request $request, $id,$type, $with = false) {
		
// 		$contact = Contact::find ( $id );		
// 		return $this->sendResponse ( $contact );
// 	}
  
//     public function create(Request $request){

//     	$attributes = $this->getResponseArr ( $request );
//     	$contact = Contact::create ( $attributes );
//     	return $this->sendResponse ( $contact );
    	
//     }
  
// 	public function delete($id) {
// 		$contact = Contact::find ( $id );
		
// 		if ($contact) {
// 			$contact->delete ();
// 			return $this->sendResponse ( true, self::REQUEST_ACCEPTED, 'entity deleted' );
// 		} else {
// 			return $this->sendResponse ( null );
// 		}
// 	}
  
//     public function update(Request $request,$id){
//     	$contact = Contact::find ( $id );
    	
//     	if ($contact) {
//     		$contact->update ( $this->getResponseArr ( $request ) );
//     		return $this->sendResponse ( $contact );
    			
//     	} else {
//     		return $this->sendResponse ( null );
//     	}
//     }
  
}
?>