<?php

namespace App\Middleware;

class GenerateCsrfToken
{
    protected $session;

    public function __construct()
    {
        $this->session = app()->resolve('session');
    }

    public function handle($request, $next)
    {
        if ($request->isMethod('GET')) {
            if ($this->session->has('token') && (time() - $this->session->get('token_time')) < 5000) {
                $next($request);
            }
            $token = md5(uniqid(rand(), true));
            $this->session->set('token', $token);
            $this->session->set('token_time', time());
        }

        $next($request);
    }
}