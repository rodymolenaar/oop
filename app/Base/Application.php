<?php

namespace App\Base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application extends Container
{
    public $path;

    protected $request;


    /**
     * All the application's services.
     */
    public $services = [
        \App\Services\ExceptionHandler::class,
        \App\Services\Environment::class,
        \App\Services\Database::class,
        \App\Services\Router\RouterService::class
    ];

    /**
     * Boot an instance of the application.
     * @param String $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->request = Request::createFromGlobals();
    }

    /**
     * Run the application.
     */
    public function run(): void
    {
        $this->boot();

        $response = $this->handle();

        $response->send();
    }

    protected function handle(): Response
    {
        $router = $this->resolve('router');

        return $router->dispatch();
    }

    public function request(): Request
    {
        return $this->request;
    }
}