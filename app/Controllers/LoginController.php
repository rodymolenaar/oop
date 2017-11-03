<?php

namespace App\Controllers;

use App\Services\Redirect;
use App\Traits\ValidationController;

class LoginController extends Controller
{
    use ValidationController;

    public $middleware = [
        \App\Middleware\CheckIfGuest::class => ['showLoginForm', 'login']
    ];

    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    public function login()
    {
        $data = $this->validate($this->request, [
            'required' => ['username', 'password']
        ]);

        $auth = app('auth');

        $auth->authenticate($data['username'], $data['password']);

        if ($auth->check()) {
            Redirect::to('/');
        }

        Redirect::back();
    }

    public function logout()
    {
        app('auth')->reset();

        Redirect::to('/');


    }
}