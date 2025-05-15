<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(protected AuthRepository $repo) {}

    public function login(array $credentials): array
    {
        if (! $token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['E-mail veya şifre hatalı.'],
            ]);
        }

        $user = auth()->user();

        return [
            'token' => $token,
            'user' => $user,
        ];
    }


    public function register(array $data): array
    {
        $user = $this->repo->create($data);

        $token = JWTAuth::fromUser($user);

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function me()
    {
        return Auth::user();
    }


    public function logout(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
