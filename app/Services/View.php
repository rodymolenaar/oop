<?php

namespace App\Services;

use App\Base\Service;
use Jenssegers\Blade\Blade;
use Twig_Environment;
use Twig_Filter;
use Twig_Loader_Filesystem;

class View extends Service
{
    /**
     * A Twig instance is loaded into the application to allow templating.
     */
    public function boot()
    {

        $loader = new Twig_Loader_Filesystem($this->app->path('views'));
        $twig = new Twig_Environment($loader, [
            //
        ]);

        // This filter allows the app to live in a subdirectory easily.
        $twig->addFilter(new Twig_Filter('url', function ($uri) {
            return url($uri);
        }));

        $this->app->bind('view', $twig);
    }
}