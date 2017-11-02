<?php

namespace App\Services;

use App\Base\Service;
use PDO;

class Database extends Service
{
    /**
     * Here a DSN is generated with environment variables.
     * Then the PDO connection is bound to the container.
     */
    public function boot() {
        $connectionString = sprintf('%s:host=%s;dbname=%s', env('DB_DRIVER'), env('DB_HOST'), env('DB_NAME'));

        $dbh = new PDO($connectionString, env('DB_USERNAME'), env('DB_PASSWORD'));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->app->bind('db', $dbh);
    }
}