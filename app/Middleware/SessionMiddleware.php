<?php

declare(strict_types=1);

namespace App\Middleware;

use ArrayAccess;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class SessionMiddleware implements Middleware, ArrayAccess
{
    private $storage;

    public function __construct()
    {
        session_start();
        $this->storage = &$_SESSION;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (! isset($this->storage['authenticated'])) {
            $this->storage['authenticated'] = false;
        }

        $request = $request->withAttribute('session', $this);
        $request = $request->withAttribute(
            'user',
            array_key_exists('user', $this->storage) ? $this->storage['user'] : null
        );
        return $handler->handle($request);
    }

    /**
     * ArrayAccess for storage
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->storage[] = $value;
        } else {
            $this->storage[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->storage[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
    }

    public function &offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->storage[$offset];
        }

        $response = null;

        return $response;
    }
}
