<?php

namespace App\Services;

use App\Base\Service;
use Jenssegers\Blade\Blade;

class View extends Service
{
    /**
     * A Blade instance is loaded into the application to allow templating.
     */
    public function boot() {

        $blade = new Blade($this->app->path('views'), $this->app->path('cache/views'));

        $blade->share('errors', app('session')->getFlashBag()->get('errors'));

        $this->app->bind('view', $blade);
    }
}