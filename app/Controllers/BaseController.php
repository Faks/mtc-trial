<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Validation\ValidatorFactory;
use HTMLPurifier;
use Illuminate\Validation\Factory;
use Jenssegers\Blade\Blade;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Csrf\Guard;

abstract class BaseController
{
    protected Blade $blade;

    protected Logger $logger;

    protected Guard $csrf;

    protected HTMLPurifier $purifier;

    protected Factory $validator;

    public function __construct(ContainerInterface $container)
    {
        $this->blade = $container->get('blade');
        $this->logger = $container->get('logger');
        $this->csrf = $container->get('csrf');
        $this->purifier = $container->get('purifier');
        $this->validator = (new ValidatorFactory())->factory;
    }

    /**
     * Custom Blade Integration
     *
     * Output rendered template
     *
     * @param ResponseInterface    $response
     * @param string               $view Template pathname relative to templates directory
     * @param array<string, mixed> $data Associative array of template variables
     * @param array<string, mixed> $mergeData Associative array of template variables
     *
     * @return ResponseInterface
     */
    public function render(
        ResponseInterface $response,
        string $view,
        array $data = [],
        array $mergeData = []
    ): ResponseInterface {
        $response->getBody()
            ->write(
                $this->blade
                    ->render($view, $data, $mergeData)
            );

        return $response;
    }

    public function isAuthenticated(Request $request): bool
    {
        return $request->getAttribute('session')['authenticated'] === false;
    }

    public function locationLogin(Response $response): Response
    {
        return $response->withHeader('Location', '/login');
    }
}
