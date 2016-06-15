<?php
namespace App\Http\Controllers;
  
// use DB;
// use App\Models\Contact;
use App\Repository\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

class LoginController extends Controller{
  
	
	
	public function index(){

		
		if(isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))>1 ){
			return redirect('/home');
		}
		
		
		
		if(isset($_SERVER['HTTP_REFERER'])){
		$pattern = '/foodtalk.in/';
			$isMatch = preg_match($pattern, $_SERVER['HTTP_REFERER']);
		}else 
			$isMatch = false;
		
		if($isMatch)
			$isFromIndex = preg_match('/foodtalk.in\/index.html/', $_SERVER['HTTP_REFERER']);
		else 
			$isFromIndex = false;
		
		
		
		if(isset($_SERVER['HTTP_REFERER']) and $isMatch and !$isFromIndex)
			$_SESSION['refral_url'] = $_SERVER['HTTP_REFERER'];
		else
			unset($_SESSION['refral_url']);
		
		return  $this->render('login/index', [] , self::SUCCESS_OK);
	}
	
	
	public function redirect(){
		
			if (isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))>1 ){
				
				if(isset($_SESSION['refral_url']))
					return redirect($_SESSION['refral_url']);
				else
					return redirect('/home');
				
			}else{
				return redirect('/signup');
			}
	}

	public function tour(){
		
		if( isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']) ) > 1 )
			return  $this->render('login/tour', $_SESSION['user'] , self::SUCCESS_OK);
		else
			return redirect('/login');
	}
	
	
	
	public function dosignup(Request $request){
		
		if( isset($_POST['userName']) and strlen(trim($_POST['userName']) ) > 1 )
			$user['userName'] = $request->input('userName');
		else{
			return redirect('/signup');
		}
		$user['fullName'] = $_SESSION['user']['fullName'];
		$user['facebookId'] = $_SESSION['user']['facebookId'];
		$user['deviceToken'] = 'web';
		$user['signInType'] = 'F';
		$user['image'] = 'https://graph.facebook.com/'.$_SESSION['user']['facebookId'].'/picture?type=large';
		
		if( isset($_POST['email']) and strlen(trim($_POST['email']) ) > 1 )
			$user['email'] = $request->input('email');
		else{
			$user['email'] = $_SESSION['user']['email'];
		}
		
		$webUser = Login :: doLogin($user);
		
		if($webUser->error){
			if($webUser->error =='23000'){
				$user['userNameNotAvilable'] = true;
			}
			return  $this->render('login/signup', $user , self::SUCCESS_OK);
		}
		return redirect('/tour');
	}
	
	
	public function signup(){
		
		if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
			
			if(isset($_SESSION['user']['userName']) and strlen(trim($_SESSION['user']['userName']))>1 ){
				return redirect('/redirect');
			}
			
			if(isset($_SESSION['user']['email']) and strlen(trim($_SESSION['user']['email']))>1 ){
			}
			else 	
				$user['nofbemail'] = true;
				
			return  $this->render('login/signup', $user , self::SUCCESS_OK);
			
		}else {
			return redirect('/login');
		}
	}
	
	public function login(Request $request){
		
		
		$user['fullName'] = $request->input('fullName');
		$user['gender'] = $request->input('gender');
		$user['facebookId'] = $request->input('facebookId');
		$user['email'] = $request->input('email');
		$user['latitude'] = $request->input('latitude');
		$user['longitude'] = $request->input('longitude');

		if( isset($_POST['userName']) and strlen(trim($_POST['userName']) ) > 1 )
			$user['userName'] = $request->input('userName');
		
		$user['signInType'] = 'F';
		$user['deviceToken'] = 'web';
		$user['image'] = 'https://graph.facebook.com/'.$request->input('facebookId').'/picture?type=large';
		
		$webUser = Login :: doLogin($user);
		
			return response ()->json ( $webUser );
	}
	
	
	
  
	public function logout() {
		return Login::logout();				
	}
}
?>