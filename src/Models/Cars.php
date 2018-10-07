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
	use src\Purifier;
	
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
			'Country' , 'Make_Display', 'Weight_KG', 'Transmission_Type' , 'Tags' , 'Price' , 'Is_API'
		];
		
		
		public function ScopeFilter($query , $request)
		{
			if (!empty($request['Name']))
			{
				$query->where('Name' , Purifier::clean($request['Name']));
			}
			
			if (!empty($request['PriceFrom']) && empty($request['PriceTill']) )
			{
				$query->where('Price', 'like' , Purifier::clean($request['PriceFrom']).'%' );
			}
			
			if (!empty($request['PriceTill']) && empty($request['PriceFrom']))
			{
				$query->where('Price' , 'like' , Purifier::clean($request['PriceTill']).'%' );
			}
			
			if (!empty($request['PriceFrom']) && !empty($request['PriceTill']))
			{
				$query->whereBetween('Price' , [ Purifier::clean($request['PriceFrom']) , Purifier::clean($request['PriceTill']) ]);
			}
			
			if (!empty($request['Country']))
			{
				$query->where('Country' , 'like' , '%' . Purifier::clean($request['Country']) . '%' );
			}
			
			if (!empty($request['Tags']))
			{
				$query->where('Tags' , 'like' , '%' . Purifier::clean($request['Tags']) . '%' );
			}
		}
		
		public function ScopeNameFilter($query , $args)
		{
			$query->where('Name' , $args);
		}
		
		protected $hidden = ['id'];
	}