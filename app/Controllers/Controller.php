<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function __construct()
    {
        //
    }

    public function view($view)
    {
        return new Response(app('view')->render($view), 200, [
            'Content-Type' => 'text/html'
        ]);
    }
}