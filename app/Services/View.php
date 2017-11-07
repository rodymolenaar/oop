<?php

namespace App\Services;

use App\Base\Service;
use Jenssegers\Blade\Blade;
use Twig_Environment;
use Twig_Loader_Filesystem;

class View extends Service
{
    /**
     * A Blade instance is loaded into the application to allow templating.
     */
    public function boot()
    {

        $loader = new Twig_Loader_Filesystem($this->app->path('views'));
        $twig = new Twig_Environment($loader, [
            //
        ]);

        $this->app->bind('view', $twig);
    }
}