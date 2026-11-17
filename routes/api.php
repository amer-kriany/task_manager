<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');







Route::middleware('auth:sanctum')->group(function(){;

Route::get('/getUser',[UserController::class,'getUser']);


Route::post('task/{id}/favorites',[TaskController::class,'addFavorites']);
Route::delete('task/{id}/favorites',[TaskController::class,'removeFromFavorites']);
Route::get('task/favorites',[TaskController::class,'getFavoriteTasks']);



Route::get('/task/all',[TaskController::class,'getAll'])->middleware('CheckUser');


Route::apiResource('/profile',ProfileController::class);
Route::apiResource('/task',TaskController::class);
Route::get('/tasks/ordered',[TaskController::class,'getTasksByOrder']);
Route::apiResource('/category',CategoryController::class);
Route::get('/getUserTasks/{userId}',[TaskController::class,'getUserTasks']);
Route::get('/getTasksUser/{userId}',[UserController::class,'getTasksUser']);
Route::prefix('tasks')->group(function(){
Route::post('/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
Route::get('/{taskId}/categories',[TaskController::class,'getTaskCategories']);
});
});