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
	 * Date: 2018.10.06.
	 * Time: 3:43
	 */
	
	namespace src\Helpers;
	
	
	/**
	 * Trait IntervalExtend
	 * @package src\Helpers
	 */
	trait IntervalExtend
	{
		/**
		 * Set the execution time to every Five Minutes.
		 *
		 * @return self
		 */
		public function everyFiveMinutes()
		{
			return $this->at('*/5 * * * *');
		}
	}