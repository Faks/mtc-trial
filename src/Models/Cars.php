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
	 * Date: 2018.10.05.
	 * Time: 12:07
	 */
	
	namespace src\Models;
	
	
	use Illuminate\Database\Eloquent\Model;
	
	use Illuminate\Pagination;
	use Illuminate\Pagination\Paginator;
	use src\Helpers\Helpers;
	
	class Cars extends Model
	{
		use Helpers;
		
		/**
		 * @var string
		 */
		protected $table = 'cars';
		
		protected $fillable =
		[
			'Make' , 'Name' , 'Trim' , 'Year' , 'Body' , 'Engine_Position' ,
			'Engine_Type', 'Engine_Compression' , 'Engine_Fuel' , 'Image',
			'Country' , 'Make_Display', 'Weight_KG', 'Transmission_Type' , 'Price'
		];
		
		protected $hidden = ['id'];
	}