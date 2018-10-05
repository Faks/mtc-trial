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
	 * Time: 15:07
	 */
	
	namespace src;
	
	
	use HTMLPurifier_Config;
	
	/**
	 * Class Purifier_Config
	 * @package src
	 */
	class Purifier_Config extends HTMLPurifier_Config
	{
		/**
		 * @var array
		 */
		public static $ConfigArray =
		[
			'Core.Encoding' => 'UTF-8',
			'HTML.Doctype' => 'XHTML 1.0 Strict',
			'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
			'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
			'AutoFormat.AutoParagraph' => false,
			'AutoFormat.RemoveEmpty' => true
		];
		
		/**
		 * @return HTMLPurifier_Config
		 */
		public static function Config()
		{
			$config = HTMLPurifier_Config::createDefault();
			$config->loadArray(self::$ConfigArray);
			
			return $config;
		}
	}