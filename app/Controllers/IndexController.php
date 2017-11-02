<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class IndexController extends Controller
{
    public function index()
    {
        $repo = new UserRepository(app('db'));

        dd($repo->find(1));

        return $this->view('index');
    }
}