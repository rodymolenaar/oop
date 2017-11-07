<?php

namespace App\Services\Session;

use App\Base\Service;

class SessionService extends Service
{
    public function boot() {
        $session = new Session;
        $session->start();

        $this->app->bind('session', $session);
    }
}