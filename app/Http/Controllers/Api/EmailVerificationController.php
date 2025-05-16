<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function resend(Request $request)
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'E-posta zaten doğrulanmış.'], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Doğrulama maili tekrar gönderildi.']);
    }

    public function isMailValidate()
    {
        return response()->json(['message' => 'Mail doğrulanmış.']);
    }
}
