<?php

declare(strict_types=1);

namespace App\Controllers\Api\Filters;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Cars;

use function json_encode;

use const JSON_THROW_ON_ERROR;

class PriceController
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     * @throws \JsonException
     */
    public function index(Request $request, Response $response, array $args = []): Response
    {
        $cars = Cars::query()
            ->select('Price')
            ->distinct('Price')
            ->groupBy('Price')
            ->get()
            ->pluck('Price');

        $payload = json_encode(
            $cars,
            JSON_THROW_ON_ERROR
        );

        $response->getBody()
            ->write(
                $payload
            );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}