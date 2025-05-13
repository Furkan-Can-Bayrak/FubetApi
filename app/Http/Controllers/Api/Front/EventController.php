<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService)
    {
    }

    public function paginateEvents(Request $request)
    {
        $filters['category_id'] = $request->category_id;

        $perPage = $request->get('per_page', 15);

        $events = $this->eventService->paginate($perPage, $filters);

        return response()->json($events);
    }
}
