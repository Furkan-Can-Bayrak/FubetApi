<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Laravel\Auth\User;

class ProfileController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    public function show()
    {

        $user = $this->userService->find(Auth::id());

        if (!$user) {
            return response()->json(['success'=> false], 404);
        }
        return response()->json($user,200);
    }

    public function update(ProfileUpdateRequest $profileUpdateRequest)
    {
        $user = $this->userService->update(Auth::id(),$profileUpdateRequest->validated());

        if (!$user) {
            return response()->json(['success'=> false], 404);
        }
        return response()->json($user,200);
    }
}
