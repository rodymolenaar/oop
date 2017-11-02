<?php

/**
 * These routes are loaded in app\Services\Router\RouterService.php
 */

use App\Services\Redirect;

$router->get('/', function () {
    Redirect::to('/tasks');
});

$router->get('/tasks', [App\Controllers\TasksController::class, 'index']);
$router->post('/tasks/create', [App\Controllers\TasksController::class, 'store']);
$router->get('/tasks/[i:id]', [App\Controllers\TasksController::class, 'edit']);
$router->post('/tasks/[i:id]', [App\Controllers\TasksController::class, 'update']);
$router->get('/signin', [App\Controllers\LoginController::class, 'showLoginForm']);
$router->post('/signin', [App\Controllers\LoginController::class, 'login']);