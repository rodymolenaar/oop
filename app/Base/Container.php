<?php

namespace App\Base;

class Container
{
    protected $binds;

    protected $recipes;


    /**
     * All the application's services.
     */
    protected $services = [];

    /**
     * Bootstrap the application.
     */
    public function boot()
    {
        foreach ($this->services as $service) {
            $service = new $service($this);
            $service->boot();
        }
    }

    /**
     *  Register a service.
     */
    public function bind($identifier, $service)
    {
        $this->binds[$identifier] = $service;
    }

    /**
     *  Resolve a service.
     */
    public function resolve($identifier)
    {
        return $this->binds[$identifier];
    }

    /**
     *  Add a recipe.
     */
    public function recipe($identifier, $recipe)
    {
        $this->recipes[$identifier] = $recipe;
    }

    /**
     *  Create an object according to the supplied recipe.
     */
    public function make($identifier)
    {
        return $this->recipes[$identifier]($this);
    }
}