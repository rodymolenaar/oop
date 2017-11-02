<?php

namespace App\Base;

use App\Middleware\MiddlewareManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Application class
 * @package App\Base
 */
class Application extends Container
{
    /**
     * The application's root directory.
     * @var String
     */
    public $path;

    /**
     * The current request.
     * @var Request
     */
    protected $request;

    protected $response;


    /**
     * All the application's service classes.
     * These classes are loaded into the application for later use.
     * They provide additional functionality and are easily added or removed.
     */
    public $services = [
        \App\Services\ExceptionHandler::class,
        \App\Services\Environment::class,
        \App\Services\Database::class,
        \App\Services\Session\SessionService::class,
        \App\Services\Router\RouterService::class,
        \App\Services\View::class,
        \App\Services\Auth\AuthService::class,
    ];

    /**
     * Boot an instance of the application.
     * @param String $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->request = Request::createFromGlobals(); // Here we populate a Request object with the global variables. e.g. $_GET, $_FILES, $_POST
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

    /**
     * Here the main tasks are performed to transform the request
     * into a valid response.
     * @return Response
     */
    protected function handle(): Response
    {
        $this->dispatchToMiddleware($this->request);

        $router = $this->resolve('router'); // Here the router is retrieved from the service container.

        return $router->dispatch(); // Here the router takes over and returns a Response object.
    }

    /**
     * @param Request $request
     */
    protected function dispatchToMiddleware(Request $request)
    {
        MiddlewareManager::run($request);
    }

    /**
     * Stops the application process and sends an error response.
     * @param integer $code
     * @param string $message
     * @param array $headers
     * @return void
     */
    public function abort($code, $message = '', array $headers = [])
    {
        if ($code == 404) {
            throw new NotFoundHttpException($message);
        }

        throw new HttpException($code, $message, null, $headers);
    }

    /**
     * The current request.
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }
}