<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\Redirect;
use App\Traits\ValidationController;
use PDO;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TasksController extends Controller
{
    use ValidationController;

    public $middleware = [
        \App\Middleware\CheckIfUser::class => ['index', 'show', 'edit', 'update', 'create', 'store', 'delete']
    ];

    public function index()
    {
        $user = app('auth')->user()->id;

        $query = app('db')->prepare("SELECT * FROM tasks WHERE `user_id` = {$user} ORDER BY `created_at` DESC");
        $query->execute();

        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $this->view('task.index', [
            'tasks' => $tasks
        ]);
    }

    public function edit($id)
    {
        $user = app('auth')->user()->id;

        $query = app('db')->prepare("SELECT * FROM tasks WHERE `user_id` = {$user} AND `id` = {$id} LIMIT 1");
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if (! count($results) > 0) {
            throw new HttpException(404, 'Task not found');
        }

        return $this->view('task.edit', [
            'task' => $results[0]
        ]);
    }

    public function update($id)
    {
        $user = app('auth')->user()->id;

        $data = $this->validate($this->request, [
            'required' => ['title'],
            'max' => [
                ['title' => 30],
                ['description' => 900],
            ],
        ]);

        $query = app('db')->prepare("UPDATE tasks SET `title` = :title, `description` = :description WHERE `id` = {$id} AND `user_id` = {$user}");
        $query->execute([
            ':title' => $data['title'],
            ':description' => isset($data['description']) ? $data['description'] : null,
        ]);

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly saved task.', 'type' => 'success']);

        Redirect::back();
    }

    public function store()
    {
        $data = $this->validate($this->request, [
            'required' => ['title'],
            'max' => [
                ['title' => 30],
                ['description' => 900],
            ],
        ]);

        $query = app('db')->prepare("INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)");
        $query->execute([
            ':user_id' => app('auth')->user()->id,
            ':title' => $data['title'],
            ':description' => isset($data['description']) ? $data['description'] : null,
        ]);

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly saved task.', 'type' => 'success']);

        Redirect::back();
    }

    public function delete()
    {
        //
    }
}