<?php

use App\Http\Controllers\CategoryController;
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
Route::apiResource('/category',CategoryController::class);
Route::get('/getUserTasks/{userId}',[TaskController::class,'getUserTasks']);
Route::get('/getTasksUser/{userId}',[UserController::class,'getTasksUser']);
Route::post('tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
Route::get('tasks/{taskId}/categories',[TaskController::class,'getTaskCategories']);