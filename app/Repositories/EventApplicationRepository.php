<?php

namespace App\Repositories;



use App\Models\Event;
use App\Models\EventApplication;

class EventApplicationRepository
{

    public function createOrUpdate(array $conditions, array $data): EventApplication
    {
        return EventApplication::updateOrCreate($conditions, $data);
    }

    public function update(array $conditions, array $data): int
    {
        return EventApplication::where($conditions)->update($data);
    }

    public function getByUserId(string $userId)
    {
        return EventApplication::where('user_id', $userId)->get();
    }

    public function getAll()
    {
        return EventApplication::all();
    }
}
