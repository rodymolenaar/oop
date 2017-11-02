<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;

class MiddlewareManager
{
    protected $middleware = [
        VerifyCsrfToken::class,
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function run(Request $request)
    {
        return (new static($request))->runRequestThroughMiddleware();
    }

    public function runRequestThroughMiddleware()
    {
        foreach ($this->middleware as $middleware) {
            $this->bootstrapMiddleware($middleware)->handle($this->request, function (Request $request) {
                $this->request = $request;
            });
        }

        return $this->request;
    }

    public function bootstrapMiddleware($middleware)
    {
        return new $middleware();
    }
}