<?php

namespace App\Services;

use App\Base\Service;
use duncan3dc\Laravel\BladeInstance;

class View extends Service
{
    /**
     * A Blade instance is loaded into the application to allow templating.
     */
    public function boot() {
        $this->app->bind('view', new BladeInstance(app()->path.'/views', app()->path.'cache/views'));
    }
}