<?php

namespace App\Middleware;

class CaptureOldInput
{
    protected $session;

    public function __construct()
    {
        $this->session = app()->resolve('session');
    }

    public function terminate($request)
    {
        $this->session->getFlashBag()->add('old', $request->request);
    }
}