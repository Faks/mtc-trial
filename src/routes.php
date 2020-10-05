<?php

use Slim\Http\Request;
use Slim\Http\Response;
use src\Controllers\APIController;
use src\Controllers\AuthController;
use src\Controllers\HomeController;
use src\Purifier;

// Routes
$app->get(
    '/',
    function (Request $request, Response $response, array $args) {
        $model = HomeController::init()->ShowCarsSearchListing();
        $model_tags = HomeController::init()->TagsFilter();

        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        return $this->blade->render(
            $response,
            'office_user.index',
            compact('model', 'model_tags', 'nameKey', 'valueKey', 'name', 'value')
        );
    }
)->setName('home');


$app->get(
    '/name/filter',
    function (Request $request, Response $response, array $args) {
        return HomeController::init()->NameFilterAjax();
    }
)->setName('name-filter');


$app->get(
    '/price/filter',
    function (Request $request, Response $response, array $args) {
        return HomeController::init()->PriceFilterAjax();
    }
)->setName('price-filter');


$app->get(
    '/country/filter',
    function (Request $request, Response $response, array $args) {
        return HomeController::init()->CountryFilterAjax();
    }
)->setName('country-filter');


$app->get(
    '/login',
    function ($request, $response, $args) use ($app) {
        // CSRF token name and value
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        $errors = false;

        return $this->blade->render($response, 'login', compact('errors', 'nameKey', 'valueKey', 'name', 'value'));
    }
)->setName('login');


$app->get(
    '/logout',
    function ($request, $response, $args) use ($app) {
        AuthController::init()->DoLogout();

        return $response->withRedirect($this->router->pathFor('login'));
    }
)->setName('logout');


$app->post(
    '/login',
    function ($request, $response, $args) use ($app) {
        $validator = AuthController::init()->Validator($request, AuthController::$rules_login);

        if ($validator->passes()) {
            if (AuthController::init()->DoLogin($request) === true) {
                return $response->withRedirect('/office/dashboard');
            }
        } else {
            $errors = $validator->errors(); // errors collection
        }

        return $this->blade->render($response, 'login', compact('errors'));
    }
)->setName('do-login');


$app->get(
    '/office/dashboard',
    function ($request, $response, $args) use ($app) {
        if (! empty($_SESSION['auth'])) {
            return $this->blade->render($response, 'office.dashboard.index');
        } else {
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }
)->setName('office-dashboard');


$app->get(
    '/office/dashboard/cars',
    function ($request, $response, $args) use ($app) {
        if (! empty($_SESSION['auth'])) {
            $model = HomeController::init()->ShowCarsListing();

            return $this->blade->render($response, 'office.cars.index', compact('model'));
        } else {
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }
)->setName('office-dashboard-cars');


$app->get(
    '/office/dashboard/cars/create',
    function ($request, $response, $args) use ($app) {
        if (! empty($_SESSION['auth'])) {
            // CSRF token name and value
            $nameKey = $this->csrf->getTokenNameKey();
            $valueKey = $this->csrf->getTokenValueKey();
            $name = $request->getAttribute($nameKey);
            $value = $request->getAttribute($valueKey);

            return $this->blade->render(
                $response,
                'office.cars.create',
                compact('model', 'nameKey', 'valueKey', 'name', 'value')
            );
        } else {
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }
)->setName('office-dashboard-create-car');


$app->post(
    '/office/dashboard/cars/create',
    function ($request, $response, $args) use ($app) {
        $validator = HomeController::init()->Validator($request, HomeController::$create_rules);

        if ($validator->passes()) {
            HomeController::init()->DoCreateCar($request, $response);

            return $response->withRedirect($this->router->pathFor('office-dashboard-cars'));
        } else {
            $errors = $validator->errors(); // errors collection

            return $this->blade->render($response, 'office.cars.create', compact('errors'));
        }
    }
)->setName('office-dashboard-create-car-store');


$app->get(
    '/office/dashboard/car/update/{id}',
    function ($request, $response, $args) use ($app) {
        if (! empty($_SESSION['auth'])) {
            $model = HomeController::init()->ShowUpdateCar($args['id']);

            // CSRF token name and value
            $nameKey = $this->csrf->getTokenNameKey();
            $valueKey = $this->csrf->getTokenValueKey();
            $name = $request->getAttribute($nameKey);
            $value = $request->getAttribute($valueKey);

            return $this->blade->render(
                $response,
                'office.cars.update',
                compact('model', 'nameKey', 'valueKey', 'name', 'value', 'args')
            );
        } else {
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }
)->setName('office-dashboard-update-car');


$app->post(
    '/office/dashboard/car/update',
    function ($request, $response, $args) use ($app) {
        $validator = HomeController::init()->Validator($request, HomeController::$update_rules);

        if ($validator->passes()) {
            #Model
            HomeController::init()->DoUpdateCar($request);

            return $response->withRedirect($this->router->pathFor('office-dashboard-cars'));
        } else {
            $errors = $validator->errors(); // errors collection

            return $this->blade->render($response, 'office.cars.update', compact('errors'));
        }
    }
)->setName('office-dashboard-update-car-store');


$app->get(
    '/office/dashboard/car/destroy/{id}',
    function ($request, $response, $args) use ($app) {
        HomeController::init()->DoDestroyCar($args['id']);

        return $response->withRedirect($this->router->pathFor('office-dashboard-cars'));
    }
);


$app->get(
    '/office/dashboard/api/create/cars',
    function ($request, $response, $args) use ($app) {
        if (! empty($_SESSION['auth'])) {
            APIController::init()->DoCreateCars();

            return $response->withRedirect($this->router->pathFor('office-dashboard-cars'));
        } else {
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }
)->setName('office-dashboard-api-cars-create');