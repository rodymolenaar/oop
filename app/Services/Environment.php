<?php

namespace App\Services;

use App\Base\Service;
use Dotenv\Dotenv;

class Environment extends Service
{
    /**
     * Here a new Dotenv instance is registered and loaded.
     * This allows for keeping configuration out of version control.
     */
    public function boot() {
        $dotenv = new Dotenv($this->app->path);
        $dotenv->load();

        $this->app->bind('env', $dotenv);
    }
}