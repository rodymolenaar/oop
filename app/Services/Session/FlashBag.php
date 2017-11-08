<?php

namespace App\Services\Session;

class FlashBag
{
    /**
     * Add a flash message to the session.
     * @param $key
     * @param $value
     * @return mixed
     */
    public function add($key, $value)
    {
        return $_SESSION['flash'][$key] = $value;
    }

    /**
     * Pull the key from the session.
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if ($this->has($key)) {
            $value = $_SESSION['flash'][$key];
        }

        $this->remove($key);

        return isset($value) ? $value : null;
    }

    /**
     * Check if the key exists in the flash namespace.
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION['flash'][$key]);
    }

    /**
     * Remove the key from the flash namespace.
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION['flash'][$key]);
    }

    /**
     * Clear all flash data.
     * @return array
     */
    public function clear()
    {
        return $_SESSION['flash'] = [];
    }
}