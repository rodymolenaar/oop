<?php

namespace App\Services\Session;

class Session
{
    protected $flash;

    /**
     * Set a reference to the FlashBag.
     */
    public function __construct()
    {
        $this->flash = new FlashBag;
    }

    /**
     * Start the session.
     */
    public function start()
    {
        session_start();
    }

    /**
     * Write a key to the session.
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * Retrieve a key from session.
     * @param $key
     * @param string $default
     * @return string
     */
    public function get($key, $default = '')
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    /**
     * Check if the given key has been set in the session.
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove the given key from the session.
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Symfony compatible way to retrieve the FlashBag.
     * @return FlashBag
     */
    public function getFlashBag()
    {
        return $this->flash;
    }
}