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
	 * Time: 21:38
	 */
	
	namespace src\Controllers;
	
	
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	use src\Helpers\Helpers;
	use src\Models\Cars;
	use src\Purifier;
	use src\Helpers\Currency;
	
	/**
	 * Class APIController
	 * @package src\Controllers
	 */
	class APIController
	{
		use Helpers;
		
		/**
		 * @var string
		 */
		public static $API_URL = "https://www.carqueryapi.com/api/0.3/?cmd=getTrims&year=2018";
		
		/**
		 * @return mixed
		 */
		public function API()
		{
			$url = self::$API_URL;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec ($ch);
			curl_close ($ch);
			
			return $result;
		}
		
		public function DoCreateCars()
		{
			foreach ((array)json_decode($this->API(),true) as $item => $key)
			{
				foreach ((array)$key as $car_item => $car_key)
				{
					try
					{
						
						Cars::updateOrCreate
						([
							'Make' => Purifier::clean($car_key['model_make_id']),
							'Name' => Purifier::clean($car_key['model_name']),
							'Trim' => Purifier::clean($car_key['model_trim']),
							'Year' => Purifier::clean((integer)$car_key['model_year']),
							'Body' => Purifier::clean($car_key['model_body']),
							'Engine_Position' => Purifier::clean($car_key['model_engine_position']),
							'Engine_Type' => Purifier::clean($car_key['model_engine_type']),
							'Engine_Compression' => Purifier::clean($car_key['model_engine_compression']),
							'Engine_Fuel' => Purifier::clean($car_key['model_engine_fuel']),
							'Country' => Purifier::clean($car_key['make_country']),
							'Make_Display' => Purifier::clean($car_key['model_make_display']),
							'Weight_KG' => Purifier::clean($car_key['model_weight_kg']),
							'Transmission_Type' => Purifier::clean($car_key['model_transmission_type']),
							'Price' => Purifier::clean(Helpers::Formatted()),
							'Tags' => Purifier::clean(Helpers::RandNames()),
							'Is_API' => 'yes'
						]);
					}
					catch (ModelNotFoundException $exception)
					{
						die('api save failed');
					}
				}
			}
		}
	}