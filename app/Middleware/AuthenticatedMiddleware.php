<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use function dd;

class AuthenticatedMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {

        if ($request->getAttribute('session')['authenticated'] === false) {
            $requests = $request->withHeader('Location', '/login');
        }

        dd($requests);

        return $handler->handle($request);
    }
}