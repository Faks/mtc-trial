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
		 * @return self
		 */
		public static function init()
		{
			return new self();
		}
	}