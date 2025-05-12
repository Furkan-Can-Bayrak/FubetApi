<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthService
{
    public function __construct(protected AuthRepository $repo) {}

    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['E-mail veya şifre hatalı.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function register(array $data): array
    {

        $user = $this->repo->create($data);

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
