<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Panel\EventController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'panel'],function (){
    Route::apiResource('users', UserController::class);

    Route::controller(EventController::class)->prefix('events')->group(function () {
        Route::post('uploadPhoto/{id}', 'uploadPhoto');
    });
    Route::apiResource('events', EventController::class);
});

