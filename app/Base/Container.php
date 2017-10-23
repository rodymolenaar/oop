<?php

namespace App\Base;

/**
 * The application's service container.
 * @package App\Base
 */
class Container
{
    /**
     * Array of services already loaded into the applications.
     * These are available to be resolved with resolve().
     * @var array
     */
    protected $binds;

    /**
     * Array of recipes for certain services.
     * These are used to construct a complex object with dependencies on the fly.
     * @var array<Callable>
     */
    protected $recipes;


    /**
     * All the application's service classes.
     * These classes are loaded into the application for later use.
     * They provide additional functionality and are easily added or removed.
     */
    protected $services = [];

    /**
     * Load all services from the services array into the application.
     * This method calls the boot() method on all service classes.
     */
    public function boot()
    {
        foreach ($this->services as $service) {
            $service = new $service($this);
            $service->boot();
        }
    }

    /**
     *  Registers a service class into the application by string key.
     */
    public function bind($identifier, $service)
    {
        $this->binds[$identifier] = $service;
    }

    /**
     *  Resolve a service by key from the registered services.
     */
    public function resolve($identifier)
    {
        return $this->binds[$identifier];
    }

    /**
     *  Add a recipe to the application container.
     */
    public function recipe($identifier, $recipe)
    {
        $this->recipes[$identifier] = $recipe;
    }

    /**
     *  Create an object according to the registered recipe.
     */
    public function make($identifier)
    {
        return $this->recipes[$identifier]($this);
    }
}