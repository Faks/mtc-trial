<?php

include_once 'Database.php';

return [
    'settings' => [
        'displayErrorDetails'    => true,  // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        
        // Renderer settings
        'renderer'               => [
            'template_path'       => __DIR__ . '/../templates/',
            'blade_template_path' => __DIR__ . '/../views/',       // String or array of multiple paths
            'blade_cache_path'    => __DIR__ . '/../cache/views/', // Mandatory by default, though could probably turn caching off for development
        ],
        'db'                     => [
            // Eloquent configuration
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'port'      => DB_PORT,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'sslmode'   => 'require',
            'options'   => extension_loaded('pdo_mysql') ? [
                PDO::MYSQL_ATTR_SSL_KEY                => '/var/www/ssl/mysql/client-key.pem',
                PDO::MYSQL_ATTR_SSL_CERT               => '/var/www/ssl/mysql/client-cert.pem',
                PDO::MYSQL_ATTR_SSL_CA                 => '/var/www/ssl/mysql/ca-cert.pem',
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            ] : [],
        ],
        // Monolog settings
        'logger'                 => [
            'name'  => 'slim-app',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
