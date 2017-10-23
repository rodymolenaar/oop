<?php

/**
 * These helpers allow for accessing core services and features in
 * every corner of the application.
 */

if (!function_exists('app')) {
    function app($service = null) {
        global $app;

        if ($service) {
            return $app->resolve($service);
        }

        return $app;
    }
}

if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('env')) {
    function env($key, $default = null) {
        return getenv($key) ?? $default; // getenv() is registered by php-dot-env
    }
}

if (!function_exists('dd')) {
    function dd() {
        die(var_dump(func_get_args()));
    }
}