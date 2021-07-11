<?php

declare(strict_types=1);

namespace App\Services;

use HTMLPurifier;
use Slim\Factory\AppFactory;

class PurifierService
{
    public static function clean($input): string
    {
        $app = AppFactory::create();
        /**
         * @var HTMLPurifier $purifier
         */
        $purifier = $app->getContainer()->get('purifier');

        return $purifier->purify($input);
    }
}