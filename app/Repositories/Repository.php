<?php

namespace App\Repositories;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class Repository
{
    protected $database;

    protected $table;

    protected $model;

    public function __construct()
    {
        $this->database = app()->resolve('db');
    }

    public function find($id)
    {
        return $this->findBy('id', $id);
    }

    public function findBy($column, $value)
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE `{$column}` = ? LIMIT 1");
        $query->execute([$value]);

        $results = $query->fetchAll();

        return  count($results) > 0 ? $this->model($results[0]) : null;
    }

    public function findAllBy($column, $value)
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE `{$column}` = ?");
        $query->execute([$value]);

        $results = $query->fetchAll(PDO::FETCH_OBJ);

        return  $results;
    }

    public function findOrFail($id)
    {
        $model = $this->find($id);

        if (is_null($model)) {
            throw new HttpException(404, "{$this->model} with id {$id} not found");
        }
    }

    public function collection($source)
    {
        dd($source);
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