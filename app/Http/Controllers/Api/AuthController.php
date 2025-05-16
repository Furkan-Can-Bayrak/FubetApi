<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        return response()->json([
            'message' => 'Giriş başarılı.',
            'token' => $result['token'],
            'user' => $result['user'],
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Kayıt başarılı.',
            'token' => $result['token'],
            'user' => $result['user'],
        ], 201);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json([
            'message' => 'Çıkış başarılı.',
        ]);
    }

    public function me(): JsonResponse
    {
        $user = $this->authService->me();

        return response()->json([
            'message' => 'Kullanıcı doğrulandı.',
            'user' => $user,
        ]);
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'E-posta zaten doğrulanmış.'], 400);
        }

        // Mail gönderme işlemi (Laravel Notification veya kendi job dispatch)
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Doğrulama maili tekrar gönderildi.']);
    }
}
