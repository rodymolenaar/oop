<?php

namespace App\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyCsrfToken
{
    public function handle($request, $next)
    {
        if ($request->isMethod('POST') && $request->get('csrf_token') !== 'hi') {
            throw new HttpException(500, 'CSRF token does not match');
        }

        $next($request);
    }
}