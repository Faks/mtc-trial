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

use Illuminate\Database\Eloquent\ModelNotFoundException;
use src\Helpers\Helpers;
use src\Models\Users;
use src\Purifier;

/**
 * Class Auth
 * @package src\Controllers
 */
class AuthController
{
    use Helpers;

    public static $rules_login =
        [
            'username' => 'required|alpha_dash',
            'password' => 'required|min:6',
        ];


    public function DoAddUser($request)
    {
        $store = new Users();
        $store->username = Purifier::clean($request->getParam('username'));
        $store->password = \hash('sha512', Purifier::clean($request->getParam('password')));
        $store->save();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function DoLogin($request)
    {
        try {
            $auth_user = Users::where(
                [
                    'username' => Purifier::clean($request->getParam('username')),
                    'password' => \hash('sha512', Purifier::clean($request->getParam('password')))
                ]
            )->firstOrFail();

            #Removing Error Text
            unset($_SESSION['errors']);

            #Session Initiate
            $_SESSION["auth"] =
                [
                    'username' => Purifier::clean($auth_user->username),
                    'password' => Purifier::clean($auth_user->password)
                ];

            return $status = true;
        } catch (ModelNotFoundException $exception) {
            $_SESSION["errors"] =
                [
                    Purifier::clean('Wrong Username or Password')
                ];

            return $status = false;
        }
    }

    /**
     * Session Cleanup
     */
    public function DoLogout()
    {
        session_unset();
        session_destroy();
    }
}