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
	 * Time: 23:51
	 */
	
	namespace src\Controllers;
	
	use src\Helpers\Helpers;
	use src\Helpers\ValidatorFactory;
	use Slim\Views\Blade;
	use Psr\Container\ContainerInterface;
	
	
	/**
	 * Class HomeController
	 * @package src\Controllers
	 */
	class HomeController
	{
		use Helpers;
		
		public function debug()
		{
			return 	$args = 'test';
		}
	}