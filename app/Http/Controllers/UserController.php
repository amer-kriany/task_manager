<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;

class UserController extends Controller
{
   
     public function getTasksUser($userId)  {
        $task=Task::findOrFail($userId);
        return response()->json($task->user);
        
    }
}
