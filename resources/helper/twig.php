<?php
function renderTwig($view, array $data = []) {
	$function = new Twig_SimpleFunction ( 'commentify', function ($comment) {
		
		$commentTxt = $comment ['comment'];
		
		foreach ( $comment ['userMentioned'] as $user ) {
			
			$commentTxt = str_replace ( "@" . $user ['userName'], '@<p class="user-name"><a href="/' . $user ['userName'] . '">' . $user ['userName'] . '</a></p>', $commentTxt );
		}
		return $commentTxt;
	} );
	
	$filter = new Twig_SimpleFilter ( 'commentit', function ($comment, $userMentioned) {
		
		return $comment;
	} );
	
	$postTitle = new Twig_SimpleFunction ( 'postTitle', function ($post, $repository = false) {
		
		switch ($repository) {
			case 'App\Repository\User' :
				$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
				break;
			
			case 'App\Repository\Dish' :
				$title = 'by <a href="/' . $post ['userName'] . '">' . $post ['userName'] . '</a>';
				break;
			
			case 'App\Repository\Restaurant' :
				$title = '<a href="/dish/' . str_replace ( ' ', '-', strtolower ( $post ['dishName'] ) ) . '">' . $post ['dishName'] . '</a>';
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
	
	$loader = new Twig_Loader_Filesystem ( env('APP_ROOT').'app/resources/views' );

	$twig = new Twig_Environment ( $loader, array () )
	// 'cache' => '/var/www/html/webapp/storage/twig_cache',
	;
	
	$twig->addFunction ( $loginStatus );
	$twig->addFunction ( $postTitle );
	$twig->addFunction ( $function );
	
	$twig->addFilter ( $filter );
	
	return $twig->render ( $view . '.html', $data );
}
