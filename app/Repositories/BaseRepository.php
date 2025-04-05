<?php

namespace App\Repositories;

use MongoDB\Laravel\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(string $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return null;
        }

        $item->update($data);
        return $item;
    }

    public function delete(string $id): bool
    {
        $item = $this->model->find($id);

        if (!$item) {
            return false;
        }

        return $item->delete();
    }
}
