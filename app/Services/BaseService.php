<?php

namespace App\Services;

use App\Repositories\BaseRepository;

abstract class BaseService
{
    protected BaseRepository $baseRepository;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->baseRepository = $baseRepository;
    }

    public function all()
    {
        return $this->baseRepository->all();
    }

    public function find(string $id)
    {
        return $this->baseRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->baseRepository->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->baseRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->baseRepository->delete($id);
    }
}
