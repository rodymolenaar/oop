<?php

namespace App\Services\Auth;

use App\Base\Service;
use App\Repositories\UserRepository;

class AuthService extends Service
{
    public function boot() {
        $database = $this->app->resolve('db');
        $session = $this->app->resolve('session');
        $repository = new UserRepository($database);

        $auth = new Auth($database, $session, $repository);
        $this->app->bind('auth', $auth);
    }
}