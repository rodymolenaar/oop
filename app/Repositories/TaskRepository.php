<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends Repository
{
    protected $table = 'tasks';

    protected $model = Task::class;
}