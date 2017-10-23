<?php

namespace App\Services\Session;

use App\Base\Service;

class SessionService extends Service
{
    /**
     * The Session service is responsible for handling our session data.
     */
    public function boot() {
        $session = new Session();
        $session->start();

        $this->app->bind('session', $session);
    }
}