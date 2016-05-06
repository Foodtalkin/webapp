<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;

class LoginController extends Controller{
  
	
	
	public function index(){

		if(isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))>1 ){
			return redirect('/'.$_SESSION['user']['userName']);
		}
		
		
		if(isset($_SERVER['HTTP_REFERER']))
			$_SESSION['refral_url'] = $_SERVER['HTTP_REFERER'];
		else
			unset($_SESSION['refral_url']);
		
		return  $this->render('login/index', [] , self::SUCCESS_OK);
	}
	
	
	public function redirect(){
		
			if(isset($_SESSION['refral_url'])){
				return redirect($_SESSION['refral_url']);
			}elseif (isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))>1 )
				return redirect('/'.$_SESSION['user']['userName']);
			else 
				return redirect('/');
	}
	
	public function login(Request $request){
		
		
		$user['fullName'] = $request->input('fullName');
		$user['gender'] = $request->input('gender');
		$user['facebookId'] = $request->input('facebookId');
		$user['email'] = $request->input('gender');
		$user['latitude'] = $request->input('latitude');
		$user['longitude'] = $request->input('longitude');

		if( isset($_POST['userName']) and strlen(trim($_POST['userName']) ) > 1 )
			$user['userName'] = $request->input('userName');
		
		$user['signInType'] = 'F';
		$user['deviceToken'] = 'web';
		$user['image'] = 'https://graph.facebook.com/'.$request->input('facebookId').'/picture?type=large';
		
		$webUser = new Login($user);
// 		var_dump($login);
		
		if($webUser){
			$_SESSION['user'] = $webUser->profile;
		}
		
// 		$webUser = json_decode((array)$login, true);
		return response ()->json ( $webUser );
// 		return json_encode($webUser);
		
// 		$posts = User::nextPostPage($userId, 2);
		
// 		return  $this->render('user/get', $data , self::SUCCESS_OK);
	}
	
	
	
  
	public function logout() {
		
		unset($_SESSION);
// 		unset($_SESSION['refral_url']);
		session_destroy();
		return redirect('/login');
				
	}
	
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