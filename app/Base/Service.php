<?php

namespace App\Base;

/**
 * Base service class
 * @package App\Base
 */
abstract class Service
{
    /**
     * Service constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Here all logic to load a service into the application is put.
     * @return mixed
     */
    abstract public function boot();
}