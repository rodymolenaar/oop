<?php

namespace App\Services\Router;

use App\Base\Service;

class RouterService extends Service
{
    public function boot() {
        $router = new Router;

        require_once $this->app->path.'/app/routes.php';

        $this->app->bind('router', $router);
    }
}