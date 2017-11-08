<?php

namespace App\Services\Auth;

use App\Base\Service;
use App\Repositories\UserRepository;

class AuthService extends Service
{
    /**
     * Bind the Auth service.
     */
    public function boot()
    {
        $this->app->bind('auth', new Auth());
    }
}