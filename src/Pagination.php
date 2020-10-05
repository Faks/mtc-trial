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
 * Time: 20:50
 */

namespace src;

class Pagination
{
    /**
     * @param $request
     * @param $response
     * @param $next
     *
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        \Illuminate\Pagination\Paginator::currentPageResolver(
            function () use ($request) {
                return $request->getParam('page');
            }
        );

        return $next($request, $response);
    }
}