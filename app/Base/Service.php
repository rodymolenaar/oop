<?php

namespace App\Base;

abstract class Service
{
    public function __construct($app)
    {
        $this->app = $app;
    }

    abstract public function boot();
}