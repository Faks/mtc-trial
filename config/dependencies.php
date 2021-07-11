<?php

declare(strict_types=1);

use App\Middleware\SessionMiddleware;
use DI\ContainerBuilder;
use Jenssegers\Blade\Blade;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
        [
            'session' => function (ContainerInterface $container) {
                return new SessionMiddleware();
            },
            'csrf' => function (ContainerInterface $container) {
                $responseFactory = new ResponseFactory();
                return new Guard($responseFactory);
            },
            'blade' => function (ContainerInterface $container) {
                $settings = $container->get('settings');

                return new Blade(
                    [
                        $settings['view']['blade_template_path']
                    ],
                    $settings['view']['blade_cache_path']
                );
            },
            'purifier' => function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $config = HTMLPurifier_Config::createDefault();
                $config->set('Cache.SerializerPath', $settings['purifier']['cache']);
                $config->loadArray($settings['purifier']['config']);

                return new HTMLPurifier($config);
            },
            'logger' => function (ContainerInterface $container) {
                $settings = $container->get('settings');

                $loggerSettings = $settings['logger'];
                $logger = new Logger($loggerSettings['name']);

                $processor = new UidProcessor();
                $logger->pushProcessor($processor);

                $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
                $logger->pushHandler($handler);

                return $logger;
            },
            'capsule' => function (ContainerInterface $container) {
                $settings = $container->get('settings');

                $capsule = new Illuminate\Database\Capsule\Manager;
                $capsule->addConnection($settings['db']);
                $capsule->setAsGlobal();
                $capsule->bootEloquent();
                $capsule::schema('default');

                return $capsule;
            }
        ]
    );
};
