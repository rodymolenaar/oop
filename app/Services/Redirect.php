<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect
{
    public static function to($url)
    {
        return (new RedirectResponse(url($url)))->send();
    }

    public static function back()
    {
        $session = app()->resolve('session');

        static::to($session->get('app/intended'));
    }
}
