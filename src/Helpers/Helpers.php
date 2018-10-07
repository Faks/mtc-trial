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
	 * Time: 21:41
	 */
	
	namespace src\Helpers;
	
	
	/**
	 * Trait Helpers
	 * @package src\Helpers
	 */
	trait Helpers
	{
		/**
		 * @param $request
		 * @param $rules
		 * @return mixed
		 */
		public function Validator($request , array $rules)
		{
			$validatorFactory = new ValidatorFactory();
			
			$validator = $validatorFactory->make($request->getParams(), $rules);
		
			return $validator;
		}
		
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
		
		
		public static function RandNames()
		{
			$word = array_merge(range('a', 'z'), range('A', 'Z'));
			shuffle($word);
			return substr(implode($word), 0, 6);
		}
		
		/**
		 * Set the execution time to every Five Minutes.
		 *
		 * @return self
		 */
		public function everyFiveMinutes()
		{
			return $this->at('*/5 * * * *');
		}
		
		/**
		 * @return self
		 */
		public static function init()
		{
			return new self();
		}
	}