<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\Redirect;
use App\Traits\ValidationController;
use PDO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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

        dd($user);

        $query = app('db')->prepare("SELECT * FROM tasks WHERE `user_id` = {$user} ORDER BY `done`, `created_at` DESC");
        $query->execute();

        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $this->view('task.index', [
            'tasks' => $tasks
        ]);
    }

    public function edit($id)
    {
        return $this->view('task.edit', [
            'task' => $this->findTask($id),
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

        $file =  $this->request->files->get('attachment') !== null ? file_get_contents($this->request->files->get('attachment')->getPathName()) : null;
        $file_name = $this->request->files->get('attachment') !== null ? $this->request->files->get('attachment')->getClientOriginalName() : null;

        $query = app('db')->prepare("UPDATE tasks SET `title` = :title, `description` = :description, `assigned` = :assigned, `file` = :file, `file_name` = :file_name WHERE `id` = {$id} AND `user_id` = {$user}");
        $query->execute([
            ':title' => $data['title'],
            ':description' => isset($data['description']) ? $data['description'] : null,
            ':file' => $file,
            ':file_name' => $file_name,
            ':assigned' => isset($data['assigned']) ? $data['assigned'] : null,
        ]);

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly saved task.', 'type' => 'success']);

        Redirect::to('/');
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

        $file =  $this->request->files->get('attachment') !== null ? file_get_contents($this->request->files->get('attachment')->getPathName()) : null;
        $file_name = $this->request->files->get('attachment') !== null ? $this->request->files->get('attachment')->getClientOriginalName() : null;

        $query = app('db')->prepare("INSERT INTO tasks (user_id, title, description, assigned, file, file_name) VALUES (:user_id, :title, :description, :assigned, :file, :file_name)");
        $query->execute([
            ':user_id' => app('auth')->user()->id,
            ':title' => $data['title'],
            ':description' => isset($data['description']) ? $data['description'] : null,
            ':file' => $file,
            ':file_name' => $file_name,
            ':assigned' => isset($data['assigned']) ? $data['assigned'] : null,
        ]);

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly saved task.', 'type' => 'success']);

        Redirect::back();
    }

    public function destroy($id)
    {
        $user = app('auth')->user()->id;

        $query = app('db')->prepare("DELETE FROM tasks WHERE `user_id` = {$user} AND `id` = {$id}");
        $query->execute();

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly deleted task.', 'type' => 'danger']);

        Redirect::back();
    }

    public function attachment($id)
    {
        $task = $this->findTask($id);

        $response = new Response($task->file);

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $task->file_name
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }


    public function done($id)
    {
        $user = app('auth')->user()->id;

        $task = $this->findTask($id);

        $query = app('db')->prepare("UPDATE tasks SET `done` = :status WHERE `id` = {$task->id} AND `user_id` = {$user}");
        $query->execute([
            ':status' => (int) ! $task->done,
        ]);

        app('session')->getFlashBag()->add('message', ['text' => 'Successfuly saved task.', 'type' => 'success']);

        Redirect::to('/');
    }

    public function findTask($id)
    {
        $user = app('auth')->user()->id;

        $query = app('db')->prepare("SELECT * FROM tasks WHERE `user_id` = {$user} AND `id` = {$id} LIMIT 1");
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if (! count($results) > 0) {
            throw new HttpException(404, 'Task not found');
        }

        return $results[0];
    }
}