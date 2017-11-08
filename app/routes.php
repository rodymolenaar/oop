<?php

/**
 * These routes are loaded in app\Services\Router\RouterService.php
 */

use App\Services\Redirect;


$router->get('', function () {
    Redirect::to('/tasks');
});

$router->get('/', function () {
    Redirect::to('/tasks');
});

$router->get('/tasks', [App\Controllers\TasksController::class, 'index']);
$router->post('/tasks/create', [App\Controllers\TasksController::class, 'store']);
$router->get('/tasks/[i:id]', [App\Controllers\TasksController::class, 'edit']);
$router->get('/tasks/[i:id]/attachment', [App\Controllers\TasksController::class, 'attachment']);
$router->post('/tasks/[i:id]/done', [App\Controllers\TasksController::class, 'done']);
$router->post('/tasks/[i:id]', [App\Controllers\TasksController::class, 'update']);
$router->post('/tasks/[i:id]/delete', [App\Controllers\TasksController::class, 'destroy']);
$router->get('/signin', [App\Controllers\LoginController::class, 'showLoginForm']);
$router->post('/signin', [App\Controllers\LoginController::class, 'login']);
$router->get('/register', [App\Controllers\RegisterController::class, 'showRegisterForm']);
$router->post('/register', [App\Controllers\RegisterController::class, 'register']);
$router->get('/logout', [App\Controllers\LoginController::class, 'logout']);