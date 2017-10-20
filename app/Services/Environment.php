<?php

namespace App\Services;

use App\Base\Service;
use Dotenv\Dotenv;

class Environment extends Service
{
    public function boot() {
        $dotenv = new Dotenv($this->app->path);
        $dotenv->load();

        $this->app->bind('env', $dotenv);
    }
}