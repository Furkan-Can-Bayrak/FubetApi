<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\Front\HomeController;
use App\Http\Controllers\Api\Front\ProfileController;
use App\Http\Controllers\Api\Panel\CategoryController;
use App\Http\Controllers\Api\Panel\EventController;
use App\Http\Controllers\Api\Front\EventController as EventControllerFront;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



Route::get('/deneme', [\App\Http\Controllers\Api\Front\EventSuggestionController::class, 'deneme']);


Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


Route::middleware(['auth:api','verified.api'])->group(function (){
    Route::get('/isMailValidated', [EmailVerificationController::class, 'isMailValidate']);
    Route::prefix('profile')->group(function () {
        Route::get('/show', [ProfileController::class, 'show']);
        Route::post('/update', [ProfileController::class, 'update']);
    });
});
Route::prefix('mail')->group(function (){
    Route::get('/verify/{id}/{hash}', function (Request $request, $id, $hash) {
        $user = User::findOrFail($id);

        // Hash doğrulaması: e-posta adresiyle hash uyuşuyor mu?
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Doğrulama linki geçersiz.'], 403);
        }

        // Doğrulama işlemi
        $user->markEmailAsVerified();

        return Redirect::to(env('BASE_FRONT_URL'));
    })->middleware(['signed'])->name('verification.verify');
    Route::post('/resend', [EmailVerificationController::class, 'resend'])->middleware('auth:api');

});
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');


Route::get('/paginateEvents', [EventControllerFront::class, 'paginateEvents']);


Route::group(['prefix' => 'panel'],function (){
    Route::apiResource('users', UserController::class);

    Route::controller(EventController::class)->prefix('events')->group(function () {
        Route::post('uploadPhoto/{id}', 'uploadPhoto');
    });
    Route::apiResource('events', EventController::class);
    Route::apiResource('categories', CategoryController::class);
});

