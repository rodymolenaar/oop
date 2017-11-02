<?php

namespace App\Controllers;

use App\Services\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app()->request();
    }

    public function view($view, $attributes = [])
    {
        $view = app('view')->make($view, $attributes);

        return new Response($view->render(), 200, [
            'Content-Type' => 'text/html'
        ]);
    }

    public function redirect($url = null)
    {
        $redirect = new Redirect();

        if (! empty($url)) {
            return $redirect->to($url);
        }

        return $redirect;
    }
}