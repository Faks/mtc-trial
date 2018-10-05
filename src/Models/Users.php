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
	 * Time: 15:30
	 */
	
	namespace src\Models;
	
	
	use Illuminate\Database\Eloquent\Model;
	use src\Helpers\Helpers;
	
	/**
	 * Class Users
	 * @package src\Models
	 */
	class Users extends Model
	{
		use Helpers;
		
		/**
		 * @var string
		 */
		protected $table = 'users';
		
		protected $fillable = ['username' , 'password'];
		
		protected $hidden = ['id'];
	}