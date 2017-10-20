<?php

namespace App\Services;

use App\Base\Service;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

class ExceptionHandler extends Service
{
    public function boot() {
        $whoops = new Whoops;

        $whoops->pushHandler(new PrettyPageHandler);

        $whoops->register();
    }
}