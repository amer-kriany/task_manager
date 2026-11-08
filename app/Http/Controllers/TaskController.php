<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request){
        $task=Task::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "dueDate"=>$request->dueDate,
            "status"=>$request->status,
        ]);
        return response()->json($task,201);
    }
}
