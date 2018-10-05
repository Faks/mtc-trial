<?php
	/**
	 * Created by PhpStorm.
	 * User: Faks
	 * GitHub: https://github.com/Faks
	 *******************************************
	 * Company Name: Solum DeSignum
	 * Company Website: http://solum-designum.com
	 * Company GitHub: https://github.com/SolumDeSignum
	 ********************************************************
	 * Date: 2018.10.04.
	 * Time: 21:34
	 */
	
	namespace src\Controllers;
	
	
	use Slim\Views\Blade;
	
	/**
	 * Class BaseController
	 * @package src\Controllers
	 */
	class BaseController
	{
		
		/**
		 * @var
		 */
//		protected $view;
		
		

		public function __construct($config)
		{
			$viewsPath = [__DIR__ . '../../views/'];
			$cachePath = __DIR__ . '../../cache/views/';
			
			$app = new \Slim\App($config);

			// Fetch DI Container
			$container = $app->getContainer();

			// Register Blade View helper
			$container['view'] = function ($container)
			{
				return new Blade
				(
					$container['settings']['renderer'][__DIR__ . '../../views/'],
					$container['settings']['renderer'][__DIR__ . '../../cache/views/']
				);
			};
			
//			$blade = new Blade($viewsPath, $cachePath);
		
		}
	}
	
//	$app = new \Slim\App($config);
//
//// Fetch DI Container
//	$container = $app->getContainer();
//
//// Register Blade View helper
//	$container['view'] = function ($container) {
//		return new \Slim\Views\Blade(
//			$container['settings']['renderer']['blade_template_path'],
//			$container['settings']['renderer']['blade_cache_path']
//		);
//	};