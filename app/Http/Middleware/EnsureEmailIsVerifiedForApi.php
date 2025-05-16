<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedForApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user || ! $user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'E-posta adresiniz henüz doğrulanmamış.',
            ], 403);
        }

        return $next($request);
    }
}
