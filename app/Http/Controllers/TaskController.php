<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request){
    $validated=$request->validated();
       
        $task=Task::create($validated);
        
        return response()->json($task,201);
    }
    public function index(){
        $task=Task::all();
        return response()->json($task,200);
    }
    public function show( $id){
        $task=Task::findOrFail($id);
        return response()->json($task,200);

    }

    public function update( UpdateTaskRequest $request,$id){
        $validated=$request->validated();

        $task= Task::findOrFail($id);
        
        
       $task-> update($validated);
        return response()->json($task,200);
    }

    public function destroy($id){
      $task= Task::findOrFail($id);
      $task->delete();

        return response()->json(null,204);
    }
}
