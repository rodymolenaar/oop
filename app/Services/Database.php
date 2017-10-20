<?php

namespace App\Services;

use App\Base\Service;

class Database extends Service
{
    public function boot() {
        $connectionString = sprintf('%s:host=%s;dbname=%s', env('DB_DRIVER'), env('DB_HOST'), env('DB_NAME'));

        $this->app->bind('db', new \PDO($connectionString, env('DB_USERNAME'), env('DB_PASSWORD')));
    }
}