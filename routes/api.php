<?php

use App\Http\Controllers\RestAPI\AuthController;
use App\Http\Controllers\RestAPI\ProjectController;
use App\Http\Controllers\RestAPI\TaskController;
use App\Http\Controllers\RestAPI\UserController;
use App\Http\Controllers\RestAPI\UserAvatarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/projects', ProjectController::class);
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/users', UserController::class)->except('store');
Route::post('/users/{user}/photo-profile', UserAvatarController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/refresh', [AuthController::class, 'refresh']);
