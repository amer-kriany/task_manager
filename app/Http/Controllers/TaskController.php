<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request){
    $validated=$request->validated();
        $task=Task::create($validated);
        return (new TaskResource($task))
        ->response()
        ->setStatusCode(201);
    }
    public function index(){
        $task=Task::all();
        return TaskResource::collection($task)->response()->setStatusCode(200);
    }
    public function show( $id){
        $task=Task::findOrFail($id);
        return(new TaskResource($task))->response()->setStatusCode(200);

    }

    public function update( UpdateTaskRequest $request,$id){
        $validated=$request->validated();

        $task= Task::findOrFail($id);
        
        
       $task-> update($validated);
        return (new TaskResource($task))->response()->setStatusCode(200);
    }

    public function destroy($id){
      $task= Task::findOrFail($id);
      $task->delete();

        return response()->json(null,204);
    }
}
