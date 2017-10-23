<?php

namespace App\Services\Session;

class FlashBag extends SessionBag
{
    protected $namespace = 'flash';

    public function __construct()
    {
        //
    }

    public function __destruct()
    {
        $this->clear();
    }
}