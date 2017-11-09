<?php

/**
 * These helpers allow for accessing core services and features in
 * every corner of the application.
 */

use Illuminate\Support\Str;

if (! function_exists('app')) {
    function app($service = null) {
        global $app;

        if ($service) {
            return $app->resolve($service);
        }

        return $app;
    }
}

if (! function_exists('csrf_token')) {
    function csrf_token() {
        return app('session')->get('token');
    }
}

if (! function_exists('url')) {
    function url($uri) {
        if (Str::startsWith($uri, env('APP_BASEPATH'))) {
            return $uri;
        }

        return env('APP_BASEPATH', '') . $uri;
    }
}

if (! function_exists('env')) {
    function env(...$args) {
        return getenv(...$args);
    }
}