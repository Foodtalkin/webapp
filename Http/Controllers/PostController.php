<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Post;
use App\Repository\Comment;
// use Illuminate\Http\JsonResponse;

class PostController extends Controller{
  
	
	
	public function profile($id){
		
		$obj = Post::profile($id);
		return  $this->render('post/get', (array)$obj , self::SUCCESS_OK);
		
	}	
  
	public function like($id, $action){
		
		if($action == 'add')
			$obj = Post::addLike($id);
		
		if($action == 'remove')
			$obj = Post::removeLike($id);
		
		return $obj->status;
		
	}

	
	public function bookmark($id, $action){
		
		if($action == 'add')
			$obj = Post::addBookmark($id);
		if($action == 'remove')
			$obj = Post::removeBookmark($id);
		return $obj->status;
	
	}
	
	
	public function report($id){
		
			$obj = Post::report($id);
			return $obj->status;
	}
	
	public function comment($id, Request $request){
		$comment = $request->input('comment');
		$obj = Comment::addComment($id, $comment);
		return  $this->render('post/comment', (array)$obj , self::SUCCESS_OK);
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