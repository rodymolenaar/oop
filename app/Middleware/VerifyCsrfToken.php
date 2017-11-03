<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyCsrfToken
{
    protected $session;

    public function __construct()
    {
        $this->session = app()->resolve('session');
    }

    public function handle($request, $next)
    {
        if ($request->isMethod('POST')) {
            $this->validateToken($request);
        }

        $next($request);
    }

    protected function validateToken(Request $request)
    {
        if ($this->session->has('token') && (time() - $this->session->get('token_time')) < 5000) {
            return;
        }

        if ($request->get('csrf_token') !== $this->session->get('token')) {
            throw new HttpException(500, 'CSRF token does not match');
        }
    }
}