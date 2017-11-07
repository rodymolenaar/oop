<?php

namespace App\Services\Session;

class Session
{
    protected $flash;

    public function __construct()
    {
        $this->flash = new FlashBag;
    }

    public function start()
    {
        session_start();
    }

    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key, $default = '')
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function getFlashBag()
    {
        return $this->flash;
    }
}