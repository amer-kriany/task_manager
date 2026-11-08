<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tasks',[TaskController::class,'store']);
Route::patch('/tasks/{id}',[TaskController::class,'update']);
Route::get('/tasks',[TaskController::class,'index']);
Route::delete('/tasks/{id}',[TaskController::class,'destroy']);