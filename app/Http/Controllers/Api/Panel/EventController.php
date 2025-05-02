<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventFileRequest;
use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        parent::__construct($eventService);
        $this->eventService = $eventService;
    }

    protected function resolveStoreRequest(): EventStoreRequest
    {
        return app(EventStoreRequest::class);
    }

    protected function resolveUpdateRequest(): EventUpdateRequest
    {
        return app(EventUpdateRequest::class);
    }

    public function uploadPhoto($id,EventFileRequest $request)
    {
        $data = $request->validated();
       $updated = $this->eventService->uploadPhoto($id,$data['photo']);

        if (!$updated) {
            return response()->json(['success'=> false], 404);
        }
        return response()->json($updated,200);

    }
}
