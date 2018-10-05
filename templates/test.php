
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
	 * Time: 15:27
	 */
	
	use src\Purifier;
	use src\Helpers\Currency;
	use src\Controllers\APIController;
	
	$build_extract_array = [];
	
	foreach ((array)json_decode(APIController::init()->API(),true) as $item => $key)
	{
		foreach ((array)$key as $car_item => $car_key)
		{
			$build_extract_array[] =
			[
				'model_make_id' => Purifier::clean($car_key['model_make_id']),
				'model_name' => Purifier::clean($car_key['model_name']),
				'model_trim' => Purifier::clean($car_key['model_trim']),
				'model_year' => Purifier::clean((integer)$car_key['model_year']),
				'model_body' => Purifier::clean($car_key['model_body']),
				'model_engine_position' => Purifier::clean($car_key['model_engine_position']),
				'model_engine_type' => Purifier::clean($car_key['model_engine_type']),
				'model_engine_compression' => Purifier::clean($car_key['model_engine_compression']),
				'model_engine_fuel' => Purifier::clean($car_key['model_engine_fuel']),
				'make_country' => Purifier::clean($car_key['make_country']),
				'model_make_display' => Purifier::clean($car_key['model_make_display']),
				'model_weight_kg' => Purifier::clean($car_key['model_weight_kg']),
				'model_transmission_type' => Purifier::clean($car_key['model_transmission_type']),
				'model_price' => Purifier::clean("<script>alert('xss')</script>" . Currency::Formatted())
			];
		}
	}

	echo "<pre>";
	var_dump($build_extract_array);
	echo "</pre>";
?>