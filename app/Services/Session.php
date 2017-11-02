<?php

namespace App\Services;

use App\Base\Service;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session extends Service
{
    public function boot() {
        $session = new SymfonySession();
        $session->start();

        $this->app->bind('session', $session);
    }
}