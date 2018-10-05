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
	
	
	use src\Helpers\Helpers;
	
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
	}