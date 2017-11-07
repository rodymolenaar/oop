<?php

namespace App\Services\Session;

class FlashBag
{
    public function add($key, $value)
    {
        return $_SESSION['flash'][$key] = $value;
    }

    public function get($key)
    {
        if ($this->has($key)) {
            $value = $_SESSION['flash'][$key];
        }

        $this->remove($key);

        return isset($value) ? $value : null;
    }

    public function has($key)
    {
        return isset($_SESSION['flash'][$key]);
    }

    public function remove($key)
    {
        unset($_SESSION['flash'][$key]);
    }

    public function clear()
    {
        return $_SESSION['flash'] = [];
    }
}