<?php

namespace App\Services\Middleware;

use Symfony\Component\HttpFoundation\Request;

class MiddlewareManager
{
    protected $middleware = [
        \App\Middleware\CaptureIntendedUrl::class,
        \App\Middleware\CaptureOldInput::class,
        \App\Middleware\GenerateCsrfToken::class,
        \App\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * MiddlewareManager constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Run all middleware's handle methods.
     * @return Request
     */
    public function run()
    {
        foreach ($this->middleware as $middleware) {
            $middleware = $this->bootstrapMiddleware($middleware);

            if (method_exists($middleware, 'handle')) {
                $middleware->handle($this->request, function (Request $request) {
                    $this->request = $request;
                });
            }
        }

        return $this->request;
    }

    /**
     * Run all middleware's terminate methods.
     */
    public function terminate()
    {
        foreach ($this->middleware as $middleware) {
            $middleware = $this->bootstrapMiddleware($middleware);

            if (method_exists($middleware, 'terminate')) {
                $middleware->terminate($this->request);
            }
        }
    }

    /**
     * Instantiate a middleware object.
     * @param $middleware
     * @return mixed
     */
    public function bootstrapMiddleware($middleware)
    {
        return new $middleware();
    }
}