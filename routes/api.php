<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/profile',ProfileController::class);
Route::apiResource('/task',TaskController::class);
Route::get('/getUserTasks/{userId}',[TaskController::class,'getUserTasks']);
Route::get('/getTasksUser/{userId}',[UserController::class,'getTasksUser']);