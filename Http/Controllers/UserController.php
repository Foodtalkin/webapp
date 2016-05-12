<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;

class UserController extends Controller{
  
	
	
	public function profile($userName){
				
		$obj = new User($userName);
// 		$data = array (
// 				'profile' => $user->profile,
// 				'posts'=> $user->imgePost,
// 		);
		
		return  $this->render('user/get', (array) $obj , self::SUCCESS_OK);
			
	}
	
	public function nextPostPage($userName, $page){
		
		
		$posts = User::nextPostPage($userId, 2);
		
		return  $this->render('user/get', $data , self::SUCCESS_OK);
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