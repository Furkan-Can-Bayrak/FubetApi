<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(protected EventService $eventService)
    {}

    public function homePage(Request $request)
    {

    }

}
