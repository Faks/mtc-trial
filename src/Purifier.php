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
 * Time: 15:15
 */

namespace src;

use HTMLPurifier;

/**
 * Class Purifier
 * @package src
 */
class Purifier
{
    /**
     * @param $html
     *
     * @return string
     */
    public static function clean($html)
    {
        $purifier = new HTMLPurifier(Purifier_Config::Config());
        return $purifier->purify($html);
    }
}