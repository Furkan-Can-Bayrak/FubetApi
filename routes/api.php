<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Front\HomeController;
use App\Http\Controllers\Api\Front\ProfileController;
use App\Http\Controllers\Api\Panel\CategoryController;
use App\Http\Controllers\Api\Panel\EventController;
use App\Http\Controllers\Api\Front\EventController as EventControllerFront;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth:api','verified.api'])->group(function (){
    Route::get('/me', [AuthController::class, 'me']);
    Route::prefix('profile')->group(function () {
        Route::get('/show', [ProfileController::class, 'show']);
        Route::post('/update', [ProfileController::class, 'update']);
    });
});



Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::get('/paginateEvents', [EventControllerFront::class, 'paginateEvents']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'panel'],function (){
    Route::apiResource('users', UserController::class);

    Route::controller(EventController::class)->prefix('events')->group(function () {
        Route::post('uploadPhoto/{id}', 'uploadPhoto');
    });
    Route::apiResource('events', EventController::class);
    Route::apiResource('categories', CategoryController::class);
});

