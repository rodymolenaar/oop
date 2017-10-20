<?php

namespace App\Services\Router;

use AltoRouter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Router
{
    protected $instance;

    protected $match;

    public function __construct()
    {
        $this->instance = new AltoRouter();
    }

    public function match()
    {
        $this->match = $this->instance->match();
    }

    public function get($router, $target, $name = null)
    {
        $this->instance->map('GET', $router, $target, $name);
    }

    public function post($router, $target, $name = null)
    {
        $this->instance->map('POST', $router, $target, $name);
    }

    public function put($router, $target, $name = null)
    {
        $this->instance->map('PUT', $router, $target, $name);
    }

    public function patch($router, $target, $name = null)
    {
        $this->instance->map('PATCH', $router, $target, $name);
    }

    public function delete($router, $target, $name = null)
    {
        $this->instance->map('DELETE', $router, $target, $name);
    }

    public function call()
    {
        if ($this->match && is_callable($this->match['target']) && ! is_array($this->match['target'])) {
            return call_user_func_array($this->match['target'], $this->match['params']);
        }

        if ($this->match && is_array($this->match['target'])) {
            $controller = $this->match['target'][0];
            $method = $this->match['target'][1];

            return call_user_func_array([new $controller, $method], $this->match['params']);
        }

        throw new NotFoundHttpException;
    }

    public function dispatch(): Response
    {
        $this->match();

        $response = $this->call();

        if (! $response instanceof Response) {
            return new JsonResponse($response);
        }

        return $response;
    }
}