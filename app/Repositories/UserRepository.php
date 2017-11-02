<?php

namespace App\Repositories;

use App\Services\Database;
use App\Models\User;
use PDO;

class UserRepository
{
    protected $database;

    protected $table = 'users';

    protected $model = User::class;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function find($id)
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE `id` = ? LIMIT 1");
        $query->execute([$id]);

        $results = $query->fetchAll();

        return  count($results) > 0 ? $this->model($results[0]) : null;
    }

    public function findBy($column, $value)
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE `{$column}` = ? LIMIT 1");
        $query->execute([$value]);

        $results = $query->fetchAll();

        return  count($results) > 0 ? $this->model($results[0]) : null;
    }

    public function collection($source)
    {
        if (is_array($source) && count($source) > 1) {
            return array_map(function ($attributes) {
                return $this->model($attributes);
            }, $source);
        }

        return new $this->model($source);
    }

    public function model($source)
    {
        return new $this->model($source);
    }
}