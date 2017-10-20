<?php

namespace App\Services\Exceptions;

use Exception;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Throwable;

class Handler
{
    protected $dontReport = [
        //
    ];

    protected function shouldReport(Exception $e)
    {
        return ! $this->shouldNotReport($e);
    }

    protected function shouldNotReport(Exception $e)
    {
        foreach ($this->dontReport as $type) {
            if ($e instanceof $type) {
                return true;
            }
        }

        return false;
    }

    public function report(Exception $e)
    {
        if ($this->shouldReport($e)) {
            //
        }
    }

    public function render(Throwable $e)
    {
        if ($e instanceof Exception) {
            $this->report($e);
        }

        (new SymfonyDisplayer)->handle($e);
    }
}