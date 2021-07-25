<?php

declare(strict_types=1);

namespace App\Middleware;

use Illuminate\Pagination\Paginator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use function strtok;

class PaginationMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        // Set up a current path resolver so the paginator can generate proper links
        Paginator::currentPathResolver(
            function () {
                return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
            }
        );

        // Set up a current page resolver
        Paginator::currentPageResolver(
            function ($pageName = 'page') {
                return $_REQUEST[$pageName] ?? 1;
            }
        );

        return $handler->handle($request);
    }
}