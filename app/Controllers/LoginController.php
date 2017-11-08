<?php

namespace App\Controllers;

use App\Services\Redirect;
use App\Traits\ValidationController;

class LoginController extends Controller
{
    use ValidationController; // Allow validating

    /**
     * All middlewares for this controller, is only run on given methods.
     * @var array
     */
    public $middleware = [
        \App\Middleware\CheckIfGuest::class => ['showLoginForm', 'login']
    ];

    /**
     * Show the user a login form.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    /**
     * Do the login action.
     */
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

    /**
     * Logout the user.
     */
    public function logout()
    {
        app('auth')->reset();

        Redirect::to('/');


    }
}