<?php

namespace App\Middleware;

class CaptureIntendedUrl
{
    protected $session;

    public function __construct()
    {
        $this->session = app()->resolve('session');
    }

    public function handle($request, $next)
    {
        if ($request->isMethod('GET')) {
            $this->session->set('app/intended', $request->getRequestUri());
        }

        $next($request);
    }
}