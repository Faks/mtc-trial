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
	 * Time: 21:30
	 */
	
	namespace src\Helpers;
	
	
	/**
	 * Class Currency
	 * @package src\Helpers
	 */
	class Currency
	{
		/**
		 * @return string
		 */
		public static function Formatted()
		{
			setlocale(LC_MONETARY,"de_DE");
			
			return number_format( self::Rand() ,'2',".","," );
		}
		
		/**
		 * @return float
		 */
		public static function Rand()
		{
			return floatval(rand(6000 , 55000));
		}
	}