<?php

namespace App\Services;

use App\Base\Service;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

class ExceptionHandler extends Service
{
    /**
     * Here Whoop's ErrorHandler is added for easy debugging.
     * TODO: Add custom generic error pages.
     */
    public function boot() {
        $whoops = new Whoops;

        $whoops->pushHandler(new PrettyPageHandler);

        $whoops->register();
    }
}