<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
        $this->userService = $userService;
    }

    protected function resolveStoreRequest(): UserStoreRequest
    {
        return app(UserStoreRequest::class);
    }

    protected function resolveUpdateRequest(): UserUpdateRequest
    {
        return app(UserUpdateRequest::class);
    }

}
