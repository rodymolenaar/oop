<?php

namespace App\Middleware;

use App\Services\Redirect;

class CheckIfUser
{
    public function handle($request, $next)
    {
        if (! app('auth')->check()) {
            Redirect::to('/signin');
        }
    }
}