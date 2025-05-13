<?php

namespace App\Services;


use App\Repositories\EventRepository;
use App\Traits\FileUploadable;
use MongoDB\BSON\ObjectId;

class EventService extends BaseService
{
    use FileUploadable;

    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        parent::__construct($eventRepository);
        $this->eventRepository = $eventRepository;
    }

    public function create(array $data)
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->createOrUpdateFile($data['photo'], 'events', $event->photo ?? '');
        }

        $data['category_id'] = new ObjectId($data['category_id']);

        return $this->eventRepository->create($data);
    }

    public function update(string $id, array $data)
    {
       return $this->eventRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        $event = $this->find($id);
        if ($event && $event->photo) {
            $this->deleteFile($event->photo);
        }
        return $this->eventRepository->delete($id);
    }

    public function uploadPhoto($id, $photo)
    {
        $event = $this->find($id);
        $data['photo'] = $this->createOrUpdateFile($photo, 'events', $event->photo ?? '');
        return $this->update($id, $data);
    }

}
