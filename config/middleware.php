<?php

declare(strict_types=1);

use App\Middleware\PaginationMiddleware;
use App\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(PaginationMiddleware::class);
};
