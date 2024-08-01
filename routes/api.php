<?php

use App\Http\Controllers\RestAPI\ProjectController;
use App\Http\Controllers\RestAPI\TaskController;
use App\Http\Controllers\RestAPI\UserController;
use App\Http\Controllers\RestAPI\UserAvatarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/projects', ProjectController::class);
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/users', UserController::class);
Route::post('/users/{user}/photo-profile', UserAvatarController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
