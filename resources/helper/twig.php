<?php
function renderTwig($view, array $data = []) {
	$function = new Twig_SimpleFunction ( 'commentify', function ($comment) {
		
		$commentTxt = $comment ['comment'];
		
		foreach ( $comment ['userMentioned'] as $user ) {
			
			$commentTxt = str_replace ( "@" . $user ['userName'], '<p class="user-name"><a href="/' . $user ['userName'] . '">' . $user ['userName'] . '</a></p>', $commentTxt );
		}
		return $commentTxt;
	} );
	
	$filter = new Twig_SimpleFilter ( 'commentit', function ($comment, $userMentioned) {
		
		return $comment;
	} );
	
	$postTitle = new Twig_SimpleFunction ( 'postTitle', function ($post, $repository = false) {
		
		$withUser = false;
		$title = '';
		
		switch ($repository) {
			case 'App\Repository\User' :
				$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
				break;
			
			case 'App\Repository\Dish' :
				$title = 'by <a href="/' . $post ['userName'] . '">' . $post ['userName'] . '</a>';
				break;
			
			case 'App\Repository\Restaurant' :
				
				if ($post ['checkedInRestaurantId'] > 0)
					if ($post ['restaurantIsActive'] == '1') {
				$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
// 						$title .= ' @ <a href="/' . $post ['checkedInRestaurantId'] . '">' . $post ['restaurantName'] . '</a>';
					} else {
						$title = $post ['dishName'];
					}
				
				break;
				
			default:
				
				if ($post ['checkedInRestaurantId'] > 0)
					if ($post ['restaurantIsActive'] == '1') {
				$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
// 						$title .= ' @ <a href="/' . $post ['checkedInRestaurantId'] . '">' . $post ['restaurantName'] . '</a>';
					} else {
						$title = $post ['dishName'];
					}
				else	
					$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
				
				
				$withUser = true;
				break;
		}
		// $title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
		if ($repository == 'App\Repository\Restaurant')
			$title .= ' by <a href="/' . $post ['userName'] . '">' . $post ['userName'] . '</a>';
		else if ($post ['checkedInRestaurantId'] > 0)
			if ($post ['restaurantIsActive'] == '1') {
				$title .= ' @ <a href="/' . $post ['checkedInRestaurantId'] . '">' . $post ['restaurantName'] . '</a>';
			} else {
				$title .= ' @ ' . $post ['restaurantName'];
			}
		if($withUser){
// 			$title .= ' by <a href="/' . $post ['userName'] . '">' . $post ['userName'] . '</a>';
		}
		
		return $title;
	} );
	
	$loginStatus = new Twig_SimpleFunction ( 'loginStatus', function () {
		
		if (isset ( $_SESSION ['user'] )) {
			$html = '<a href="/' . $_SESSION ['user'] ['userName'] . '" class="logo" title="My home"> <span class="title">FOODTALK</span>';
			$html .= '</a> <a href="/logout" class="button login special small">Logout</a>';
		} else {
			$html = '<a href="/index.html" class="logo" title="My home"> <span class="title">FOODTALK</span>';
			$html .= '</a> <a href="/login" class="button login special small">Login</a>';
		}
		
		return $html;
	} );
	
	
		$isajax = new Twig_SimpleFunction ( 'isajax', function () {
		
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
				return true;
			else	
			return false;
		} );
	
		
		$islogin = new Twig_SimpleFunction ( 'islogin', function ($getinfo) {
			if (isset ( $_SESSION ['user'] ) and !empty($_SESSION ['user'])) {
				if($getinfo)
					return $_SESSION ['user'];
				else
					return true;
			}
			else
			return false;	
		} );
		
		
	$loader = new Twig_Loader_Filesystem ( env('APP_ROOT').'app/resources/views' );

	$twig = new Twig_Environment ( $loader, array () )
	// 'cache' => '/var/www/html/webapp/storage/twig_cache',
	;
	
	$twig->addFunction ( $loginStatus );
	$twig->addFunction ( $postTitle );
	$twig->addFunction ( $function );
	$twig->addFunction ( $isajax );
	$twig->addFunction ( $islogin );
	
	
	$twig->addFilter ( $filter );
	
	return $twig->render ( $view . '.html', $data );
}
