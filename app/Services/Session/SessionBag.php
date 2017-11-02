<?php

namespace App\Services\Session;

class SessionBag
{
    protected $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;

        if (! isset($_SESSION[$this->namespace])) {
            $_SESSION[$this->namespace] = [];
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$this->namespace][$key] = $value;

        return $this;
    }

    public function has($key)
    {
        return isset($_SESSION[$this->namespace][$key]);
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $_SESSION[$this->namespace][$key];
        }

        return $default;
    }

    public function all()
    {
        return $_SESSION[$this->namespace];
    }

    public function clear()
    {
        $_SESSION[$this->namespace] = [];

        return $this;
    }
}