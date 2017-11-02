<?php

/**
 * These helpers allow for accessing core services and features in
 * every corner of the application.
 */

if (! function_exists('app')) {
    function app($service = null) {
        global $app;

        if ($service) {
            return $app->resolve($service);
        }

        return $app;
    }
}