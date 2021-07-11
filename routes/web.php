<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', 'App\Controllers\HomeController:index')->setName('home');

    $app->get('/login', 'App\Controllers\Auth\AuthController:login')->setName('login');
    $app->post('/login', 'App\Controllers\Auth\AuthController:show')->setName('login-store');
    $app->get('/logout', 'App\Controllers\Auth\AuthController:logout')->setName('logout');

    $app->group(
        '/office',
        function (Group $group) {
            $group->get('/dashboard', 'App\Controllers\OfficeController:index')->setName('dashboard-index');
            $group->get('/dashboard/cars', 'App\Controllers\OfficeCarsController:index')->setName('cars-index');
            $group->get('/dashboard/api/create/cars', 'App\Controllers\Api\CarsApiController:store')->setName('office-dashboard-api-cars-store');
        }
    );

    $app->group(
        '/api/v1',
        function (Group $group) {
            $group->get('/car-name', 'App\Controllers\Api\Filters\CarNameController:index')->setName('car-name');
            $group->get('/price', 'App\Controllers\Api\Filters\PriceController:index')->setName('price');
            $group->get('/country', 'App\Controllers\Api\Filters\CountryController:index')->setName('country');
        }
    );
};
