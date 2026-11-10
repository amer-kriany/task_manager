<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{

   public function addCategoriesToTask(Request $request , $id){
    $task=Task::findOrFail($id);
    $task->categories()->attach($request->input('category_id'));
    return response()->json("attached successfully",200);



   }
   public function getTaskCategories($taskId){
    $categories=Task::findOrFail($taskId)->categories;
   
    return response()->json($categories,200);

}




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

    public function getUserTasks($userId){
        $tasks=User::findOrFail($userId);
        return TaskResource::collection($tasks->tasks);

    }
}
