<?php
	
	use Slim\Http\Request;
	use Slim\Http\Response;
	use src\Controllers\AuthController;
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
		// CSRF token name and value
		$nameKey = $this->csrf->getTokenNameKey();
		$valueKey = $this->csrf->getTokenValueKey();
		$name = $request->getAttribute($nameKey);
		$value = $request->getAttribute($valueKey);
		
		$errors = false;
		
		return $this->blade->render($response, 'login' , compact('errors' , 'nameKey' ,'valueKey' , 'name' , 'value'));
	})->setName('login');
	
	
	$app->get('/logout', function ($request, $response, $args) use ($app)
	{
		AuthController::init()->DoLogout();
		
		return $response->withRedirect($this->router->pathFor('login'));
	})->setName('logout');
	
	
	$app->post('/login', function ($request, $response, $args) use($app)
	{
		$validator = AuthController::init()->Validator($request , AuthController::$rules_login);
		
		if ($validator->passes())
		{
			if (AuthController::init()->DoLogin($request) === true)
			{
				return $response->withRedirect('/office/dashboard' );
			}
		}
		else
		{
			$errors = $validator->errors(); // errors collection
		}
		
		return $this->blade->render($response, 'login' , compact('errors' ));

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
	
	
	$app->get('/office/dashboard/cars', function ($request, $response, $args) use ($app)
	{
		if (!empty($_SESSION['auth']))
		{
			return $this->blade->render($response, 'office.cars.index');
		}
		else
		{
			return $response->withRedirect($this->router->pathFor('login'));
		}
		
	})->setName('office-dashboard-cars');
	
	
	$app->get('/office/dashboard/cars/create', function ($request, $response, $args) use ($app)
	{
		if (!empty($_SESSION['auth']))
		{
			return $this->blade->render($response, 'office.cars.create' , compact('model'));
		}
		else
		{
			return $response->withRedirect($this->router->pathFor('login'));
		}
		
	})->setName('office-dashboard-create-car');
	
	$app->post('/office/dashboard/cars/create' , function ($request, $response, $args) use($app)
	{
		$validator = HomeController::init()->Validator($request , HomeController::$create_rules);
		
		if ($validator->passes())
		{
			HomeController::init()->DoCreateCar($request);
			
			return $response->withRedirect($this->router->pathFor('office-dashboard-cars'));
			
		}
		else
		{
			$errors = $validator->errors(); // errors collection
			
			return $this->blade->render($response, 'office.cars.create' , compact('errors' ));
		}
		
	})->setName('office-dashboard-create-car-store');
	
	#$_POST
	#$request->getParam('username')
	//		echo '<pre>';
	//		dd($request->getParams());
	//		echo '</pre>';
	
//	echo '<pre>';
//	dd($_SERVER['PATH_INFO']);
//	echo '</pre>';