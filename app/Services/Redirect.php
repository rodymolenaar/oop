<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect
{
    /**
     * Send a redirect response to the given URL.
     * @param $url
     * @return $this
     */
    public static function to($url)
    {
        return (new RedirectResponse(url($url)))->send();
    }

    /**
     * Redirect back to the previous URL saved in session.
     */
    public static function back()
    {
        $session = app()->resolve('session');

        static::to($session->get('app/intended'));
    }
}
