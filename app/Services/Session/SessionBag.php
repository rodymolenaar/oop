<?php

namespace App\Services\Session;

class SessionBag
{
    protected $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function set($key, $value)
    {
        $_SESSION[$this->namespace][$key] = $value;

        return $this;
    }

    public function has($key)
    {
        return isset($_SESSION[$this->namespace][$key]) ? true : false;
    }

    public function get($key, $default = null)
    {
        if ($value = $_SESSION[$this->namespace][$key]) {
            return $value;
        }

        return $default;
    }

    public function clear()
    {
        $_SESSION[$this->namespace] = [];

        return $this;
    }
}