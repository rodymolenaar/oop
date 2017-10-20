<?php

namespace App\Services\Exceptions;

use App\Services\Service;
use Throwable;

class ExceptionHandler extends Service
{
    public function boot() {
        set_exception_handler(function (Throwable $e) {
            (new Handler)->render($e);
        });
    }
}