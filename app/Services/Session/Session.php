<?php

namespace App\Services\Session;

class Session
{
    protected $flashBag;

    protected $bags = [];

    public function __construct()
    {
        $this->flashBag = new FlashBag();
        $this->applicationBag = new SessionBag('app');
        $this->generateCsrf();
    }

    public function start()
    {
        session_start();
    }

    public function bag($bag = null)
    {
        if (empty($bag)) {
            return $this->applicationBag;
        }

        if (isset($this->bags[$bag])) {
            return $this->bags[$bag];
        }

        $this->bags[$bag] = new SessionBag($bag);

        return $this->bags[$bag];
    }

    public function flash()
    {
        return $this->flashBag;
    }

    public function generateCsrf()
    {
        if (! $this->bag()->has('csrf')) {
            $this->bag()->set('csrf', bin2hex(random_bytes(32)));
        }
    }

    public function csrf()
    {
        return $this->bag()->get('csrf');
    }

    public function destroy()
    {
        session_destroy();
    }

    public function __call($name, $arguments)
    {
        $bag = $this->bag();

        if (method_exists($bag, $name)) {
            $bag->{$name}($arguments);
        }
    }
}