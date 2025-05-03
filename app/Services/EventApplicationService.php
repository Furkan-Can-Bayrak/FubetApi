<?php

namespace App\Services;


use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\EventApplicationRepository;
use App\Traits\FileUploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventApplicationService
{
    protected EventApplicationRepository $repository;

    public function __construct(EventApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apply(array $data): void
    {
        $this->repository->createOrUpdate(
            [
                'user_id' => $data['user_id'],
                'event_id' => $data['event_id'],
            ],
            [
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]
        );
    }

    public function approve(string $userId, string $eventId, string $approvedBy): void
    {
        $this->repository->update([
            'user_id' => $userId,
            'event_id' => $eventId,
        ], [
            'status' => 'approved',
            'updated_by_user_id' => $approvedBy,
            'updated_at' => Carbon::now(),
            'rejection_reason' => null,
        ]);
    }

    public function reject(string $userId, string $eventId, string $rejectedBy, string $reason): void
    {
        $this->repository->update([
            'user_id' => $userId,
            'event_id' => $eventId,
        ], [
            'status' => 'rejected',
            'updated_by_user_id' => $rejectedBy,
            'updated_at' => Carbon::now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function getUserApplications(string $userId)
    {
        return $this->repository->getByUserId($userId);
    }

    public function getAllApplications()
    {
        return $this->repository->getAll();
    }
}
