<?php

namespace App\Services\Middleware;

use App\Base\Service;

class MiddlewareService extends Service
{
    public function boot() {
        $this->app->bind('middleware', new MiddlewareManager($this->app->request()));
    }
}