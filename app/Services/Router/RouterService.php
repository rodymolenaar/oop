<?php

namespace App\Services\Router;

use App\Base\Service;

class RouterService extends Service
{
    /**
     * Here a router object is created and bound to the container.
     * The routes file is also loaded into the application.
     */
    public function boot() {
        $router = new Router;

        require_once $this->app->path.'/app/routes.php';

        $this->app->bind('router', $router);
    }
}