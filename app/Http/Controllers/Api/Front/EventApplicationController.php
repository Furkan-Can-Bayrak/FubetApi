<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventFileRequest;
use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Services\EventApplicationService;
use Illuminate\Http\Request;

class EventApplicationController extends Controller
{
    protected EventApplicationService $service;

    public function __construct(EventApplicationService $service)
    {
        $this->service = $service;
    }

    public function apply(Request $request)
    {
        $this->service->apply($request->only('user_id', 'event_id'));
        return response()->json(['message' => 'Başvuru başarıyla oluşturuldu.']);
    }

    public function approve(Request $request)
    {
        $this->service->approve($request->user_id, $request->event_id, $request->approved_by);
        return response()->json(['message' => 'Başvuru onaylandı.']);
    }

    public function reject(Request $request)
    {
        $this->service->reject($request->user_id, $request->event_id, $request->rejected_by, $request->reason);
        return response()->json(['message' => 'Başvuru reddedildi.']);
    }

    public function userApplications($userId)
    {
        return response()->json($this->service->getUserApplications($userId));
    }

    public function all()
    {
        return response()->json($this->service->getAllApplications());
    }
}
