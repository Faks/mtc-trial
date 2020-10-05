<?php
// DIC configuration

use Slim\Csrf\Guard;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

$container['blade'] = function ($container)
{
	return new \Slim\Views\Blade(
		$container['settings']['renderer']['blade_template_path'],
		$container['settings']['renderer']['blade_cache_path']
	);
};

$container['csrf'] = function ($c)
{
	$csrf = new Guard;
	$csrf->setPersistentTokenMode(true);
	$csrf->setFailureCallable(function ($request, $response, $next)
	{
		$request = $request->withAttribute("csrf_status", false);
		return $next($request, $response);
	});
	
	return $csrf;
};


// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
