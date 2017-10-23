<?php

namespace App\Services\Router;

use AltoRouter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Router
 * @package App\Services\Router
 */
class Router
{
    /**
     * The AltoRouter instance.
     * @var AltoRouter
     */
    protected $instance;

    /**
     * The currently matched route.
     * @var mixed
     */
    protected $match;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->instance = new AltoRouter();
    }

    /**
     * Let AltoRouter find a match and register it.
     */
    public function match()
    {
        $this->match = $this->instance->match();
    }

    /**
     * Registers a GET route.
     * @param $route
     * @param $target
     * @param null $name
     */
    public function get($route, $target, $name = null)
    {
        $this->instance->map('GET', $route, $target, $name);
    }

    /**
     * Registers a POST route.
     * @param $route
     * @param $target
     * @param null $name
     */
    public function post($route, $target, $name = null)
    {
        $this->instance->map('POST', $route, $target, $name);
    }

    /**
     * Registers a PUT route.
     * @param $route
     * @param $target
     * @param null $name
     */
    public function put($route, $target, $name = null)
    {
        $this->instance->map('PUT', $route, $target, $name);
    }

    /**
     * Registers a PATCH route.
     * @param $route
     * @param $target
     * @param null $name
     */
    public function patch($route, $target, $name = null)
    {
        $this->instance->map('PATCH', $route, $target, $name);
    }

    /**
     * Registers a DELETE route.
     * @param $route
     * @param $target
     * @param null $name
     */
    public function delete($route, $target, $name = null)
    {
        $this->instance->map('DELETE', $route, $target, $name);
    }

    /**
     * Call the currently matched route's function or controller method.
     * @return mixed
     */
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

    /**
     * Run the router and return a Response.
     * If a response isn't returned we will automatically wrap the given content into a JSON response.
     * @return Response
     */
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