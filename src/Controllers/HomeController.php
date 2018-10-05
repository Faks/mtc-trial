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
	
	
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	use src\Helpers\Currency;
	use src\Helpers\Helpers;
	use src\Models\Cars;
	use src\Purifier;
	
	/**
	 * Class HomeController
	 * @package src\Controllers
	 */
	class HomeController
	{
		use Helpers;
		
		/**
		 * @var array
		 */
		public static $create_rules =
		[
			'Make' => 'required|string',
			'Name' => 'required|string',
		];
		
		/**
		 * @var array
		 */
		public static $update_rules =
		[
			'username' => 'required|alpha_dash',
			'password' => 'required|min:6',
		];
		
		/**
		 * @param $request
		 * @throws \Throwable
		 */
		public function DoCreateCar($request)
		{
			try
			{
				$do_create_car = new Cars();
				$do_create_car->Make = Purifier::clean($request->getParam('Make'));
				$do_create_car->Name = Purifier::clean($request->getParam('Name'));
				$do_create_car->Trim = Purifier::clean($request->getParam('Trim'));
				$do_create_car->Year = Purifier::clean($request->getParam('Year'));
				$do_create_car->Body = Purifier::clean($request->getParam('Body'));
				$do_create_car->Engine_Position = Purifier::clean($request->getParam('Engine_Position'));
				$do_create_car->Engine_Type = Purifier::clean($request->getParam('Engine_Type'));
				$do_create_car->Engine_Compression = Purifier::clean($request->getParam('Engine_Compression'));
				$do_create_car->Engine_Fuel = Purifier::clean($request->getParam('Engine_Fuel'));
				
				$do_create_car->Country = Purifier::clean($request->getParam('Country'));
				
				$do_create_car->Make_Display = Purifier::clean($request->getParam('Make_Display'));
				$do_create_car->Weight_KG = Purifier::clean($request->getParam('Weight_KG'));
				$do_create_car->Transmission_Type = Purifier::clean($request->getParam('Transmission_Type'));
				$do_create_car->Price = Purifier::clean($request->getParam('Price'));
				$do_create_car->saveOrFail();
				
				//$do_create_car->Image = Purifier::clean($request->getParam('Image')); #image to integrate intervention ...
				
			}
			catch (ModelNotFoundException $exception)
			{
				$_SESSION["errors"] =
				[
					Purifier::clean('Oop Something Went Wrong!')
				];
			}
		}
		
		
		public function DoUpdateCar($request)
		{
			
//			$do_create_car->Price = Purifier::clean(Currency::Formatted()); #update
		}
		
		
		#left over to remove
		/**
		 * @return string
		 */
		public function debug()
		{
			return 	$args = 'test';
		}
	}