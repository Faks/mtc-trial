<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function dd;

class DashboardController extends BaseController
{
    public function index(Request $request, Response $response, array $args = []): Response
    {
        if ($this->isAuthenticated($request)) {
            return $this->locationLogin($response);
        }

        return $this->render(
            $response,
            'office.dashboard.index',
        );
    }
}