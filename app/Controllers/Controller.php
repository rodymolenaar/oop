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

    /**
     * Return a view response.
     * @param $view
     * @param array $attributes
     * @return Response
     */
    public function view($view, $attributes = [])
    {
        $attributes['errors'] = app('session')->getFlashBag()->has('errors') ? app('session')->getFlashBag()->get('errors') : [];
        $attributes['csrf_token'] = csrf_token();

        $view = app('view')->render(str_replace('.', '/', $view).'.twig', $attributes);

        return new Response($view, 200, [
            'Content-Type' => 'text/html'
        ]);
    }

    /**
     * Return a redirect response.
     * @param null $url
     * @return $this|Redirect
     */
    public function redirect($url = null)
    {
        $redirect = new Redirect();

        if (! empty($url)) {
            return $redirect->to($url);
        }

        return $redirect;
    }
}