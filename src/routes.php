<?php

	use Slim\Http\Request;
	use Slim\Http\Response;
	use src\Controllers\Auth;
	use src\Controllers\HomeController;

	// Routes
	$app->get('/', function (Request $request, Response $response, array $args)
	{
	    // Sample log message
	//    $this->logger->info("Slim-Skeleton '/' route");
		#Debug API
	    // Render index view
	    return $this->renderer->render($response, 'test.php', $args);
	})->setName('home');
	

	$app->get('/debug', function ($request, $response, $args)
	{
		$test = HomeController::init()->debug();
		return $this->blade->render($response, 'debug', compact('test' , 'args'));
	})->setName('profile');
	
	
	
	$app->get('/login', function ($request, $response, $args) use ($app)
	{
		$errors = false;
		
		return $this->blade->render($response, 'login' , compact('errors'));
	})->setName('login');
	
	
	$app->get('/logout', function ($request, $response, $args) use ($app)
	{
		Auth::init()->DoLogout();
		
		return $response->withRedirect($this->router->pathFor('login'));
	})->setName('logout');
	
	
	$app->post('/login', function ($request, $response, $args) use($app)
	{
		$validator = Auth::init()->Validator($request);
		
		if (!is_null(Auth::init()->DoLogin($request)))
		
		if ($validator->passes())
		{
			if (Auth::init()->DoLogin($request) === true)
			{
				return $response->withRedirect('/office/dashboard' );
			}
		}
		else
		{
			$errors = $validator->errors(); // errors collection
		}
		
		return $this->blade->render($response, 'login' , compact('errors'));

	})->setName('do-login');
	
	
	$app->get('/office/dashboard', function ($request, $response, $args) use ($app)
	{
		if (!empty($_SESSION['auth']))
		{
			return $this->blade->render($response, 'office.dashboard.index');
		}
		else
		{
			return $response->withRedirect($this->router->pathFor('login'));
		}
		
	})->setName('office-dashboard');
	
	
	#$_POST
	#$request->getParam('username')
	//		echo '<pre>';
	//		dd($request->getParams());
	//		echo '</pre>';