<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

include_once 'database.php';

// Global Settings Object
return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
        [
            'settings' => [
                // Base path
                'base_path' => '/',
                'displayErrorDetails' => true,  // set to false in production
                'addContentLengthHeader' => false, // Allow the web server to send the content-length header
                // Is debug mode
                'debug' => (getenv('APPLICATION_ENV') !== 'production'),
                // 'Temporary directory
                'temporary_path' => __DIR__ . '/../storage/tmp',
                // Route cache
                'route_cache' => __DIR__ . '/../storage/framework/routes',
                // Eloquent configuration
                'db' => [
                    'driver' => 'mysql',
                    'host' => DB_HOST,
                    'port' => DB_PORT,
                    'database' => DB_NAME,
                    'username' => DB_USER,
                    'password' => DB_PASSWORD,
                    'charset' => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix' => '',
                    'strict' => false,
                ],
                // View settings
                'view' => [
                    'template_path' => __DIR__ . '/../resources/templates/',
                    'blade_template_path' => __DIR__ . '/../resources/views/',
                    // String or array of multiple paths
                    'blade_cache_path' => __DIR__ . '/../storage/framework/views/',
                ],
                // monolog settings
                'logger' => [
                    'name' => 'app',
                    'path' => getenv('docker') ? 'php://stdout' : __DIR__ . '../storage/logs/app.log',
                    'level' => (getenv('APPLICATION_ENV') !== 'production') ? Logger::DEBUG : Logger::INFO,
                ],
                'purifier' => [
                    'config' => [
                        'Core.Encoding' => 'UTF-8',
                        'HTML.Doctype' => 'XHTML 1.0 Strict',
                        'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
                        'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
                        'AutoFormat.AutoParagraph' => false,
                        'AutoFormat.RemoveEmpty' => true,
                    ],
                    'cache' => __DIR__ . '/../storage/purify/',
                ]
            ],
        ]
    );

    if (getenv('APPLICATION_ENV') === 'production') { // Should be set to true in production
        $containerBuilder->enableCompilation(__DIR__ . '../storage/framework/cache');
    }
};

