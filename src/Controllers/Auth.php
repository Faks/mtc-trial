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
	 * Time: 1:48
	 */
	
	namespace src\Controllers;
	
	
	
	use Illuminate\Contracts\Auth\Access\Authorizable;
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	use Illuminate\Support\Facades\Hash;
	use Slim\Middleware\Session;
	use src\Helpers\Helpers;
	use src\Helpers\ValidatorFactory;
	use src\Models\Users;
	use src\Purifier;
	
	
	class Auth
	{
		use Helpers;
		
		public function Validator($request)
		{
			$validatorFactory = new ValidatorFactory();
			
			$validator = $validatorFactory->make($request->getParams(),
			[
				'username' => 'required|alpha_dash',
				'password' => 'required|min:6',
			]);
			
			return $validator;
		}
		
		
		public function DoLogin($request)
		{
//			$store = new Users();
//			$store->username =  Purifier::clean($request->getParam('username'));
//			$store->password = \hash('sha512', Purifier::clean($request->getParam('password')) );
//			$store->save();
			
			
			try
			{
				$auth_user = Users::where(['username' => Purifier::clean($request->getParam('username')) , 'password' => \hash('sha512',Purifier::clean($request->getParam('password')) ) ])->firstOrFail();
				
				#Removing Error Text
				unset($_SESSION['errors']);
				
				#Session Initiate
				$_SESSION["auth"] =
				[
					'username' => Purifier::clean($auth_user->username) ,
					'password' => Purifier::clean($auth_user->password)
				];
				
				return $status = true;
			}
			catch (ModelNotFoundException $exception)
			{
				$errors[] = 'Wrong Username or Password';
				$_SESSION["errors"] =
				[
					Purifier::clean('Wrong Username or Password')
				];
				
				return $status = false;
			}
		}
		
		public function DoLogout()
		{
			session_unset();
			session_destroy();
		}
	}