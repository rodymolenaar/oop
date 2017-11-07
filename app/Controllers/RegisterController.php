<?php

namespace App\Controllers;

use App\Services\Redirect;
use App\Traits\ValidationController;

class RegisterController extends Controller
{
    use ValidationController;

    public $middleware = [
        \App\Middleware\CheckIfGuest::class => ['showRegisterForm', 'register']
    ];

    public function showRegisterForm()
    {
        return $this->view('auth.register');
    }

    public function register()
    {
        $data = $this->validate($this->request, [
            'required' => ['username', 'password', 'password_confirmation'],
            'equals' => [
                ['password', 'password_confirmation']
            ]
        ]);

        $query = app('db')->prepare("SELECT id FROM users WHERE `username` = ?");
        $query->execute([
            $data['username'],
        ]);

        if ($query->rowCount() > 0) {
            app('session')->getFlashBag()->add('errors', ['username' => ['Username already in use.']]);
            Redirect::back();
        }

        $query = app('db')->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $query->execute([
            $data['username'],
            password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        $auth = app('auth');

        $auth->setUser(app('db')->lastInsertId('id'));

        if ($auth->check()) {
            Redirect::to('/');
        }

        Redirect::back();
    }
}