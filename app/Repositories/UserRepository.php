<?php

namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
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
