<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    public $path;

    public $request;

    protected $registeredServices;


    /**
     * All the application's services.
     */
    public $services = [
        \App\Services\Exceptions\ExceptionHandler::class,
        \App\Services\Environment::class,
        \App\Services\Database::class
    ];

    /**
     * Boot an instance of the application.
     * @param String $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Bootstrap the application.
     */
    public function boot()
    {
        foreach ($this->services as $service) {
            $service = new $service($this);
            $service->boot();
        }
        
    }

    /**
     * Run the application.
     */
    public function run()
    {
        $this->boot();

        $this->request = Request::createFromGlobals();

        return new Response(require($this->path.'/views/index.view.php'), Response::HTTP_OK, [
            'content-type' => 'text/html'
        ]);
    }

    /**
     *  Register a service.
     */
    public function register($name, $service)
    {
        $this->registeredServices[$name] = $service;
    }

    /**
     *  Resolve a service.
     */
    public function resolve($name)
    {
        return $this->registeredServices[$name];
    }
}