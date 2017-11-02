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

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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

    public function terminate()
    {
        foreach ($this->middleware as $middleware) {
            $middleware = $this->bootstrapMiddleware($middleware);

            if (method_exists($middleware, 'terminate')) {
                $middleware->terminate($this->request);
            }
        }
    }

    public function bootstrapMiddleware($middleware)
    {
        return new $middleware();
    }
}