<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected $table = 'users';

    protected $model = User::class;
}