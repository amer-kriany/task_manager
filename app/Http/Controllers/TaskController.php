<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{


public function addFavorites($taskId){
   Task::findOrFail($taskId);
    Auth::user()->favoritTasks()->syncWithoutDetaching($taskId);
    return response()->json(['message'=>'task successfully added to favorits'],200);
}
public function removeFromFavorites($taskId){
   Task::findOrFail($taskId);
    Auth::user()->favoritTasks()->Detach($taskId);
    return response()->json(['message'=>'task successfully removed to favorits']);
}
public function getFavoriteTasks(){
   $favorits= Auth::user()->favoritTasks;
    return response()->json($favorits,200);
}




public function getAll(){
    $task=Task::all();
    return response()->json($task,200);
}

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
        $user_id=Auth::user()->id;
    $validated=$request->validated();
    $validated['user_id']=$user_id;
        $task=Task::create($validated);
        return response()->json($task,201);
    }
    public function index(){
        $tasks=Auth::user()->tasks;
        return response()->json($tasks,200);
    }
    public function getTasksByOrder(){

        $tasks=Auth::user()->tasks()->orderByRaw("FIELD(priority,'HIGH','MID','LOW')")->get();
        return response()->json($tasks,200);
    }
    public function show( $id){
        $task=Task::findOrFail($id);
        return(new TaskResource($task))->response()->setStatusCode(200);

    }

    public function update( UpdateTaskRequest $request,$id){
        $user_id=Auth::user()->id;
        $validated=$request->validated();

        $task= Task::findOrFail($id);
        if($task->user_id!=$user_id){
             return response()->json(['message'=>'unauthoraized'],401);

        }
        
       $task-> update($validated);
        return response()->json($task,200);
    }

    public function destroy($id){
    try{  $task= Task::findOrFail($id);
      $task->delete();

        return response()->json(null,204);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'task not found',
            'deatails'=>$e->getMessage()],404);
        }
        catch(Exception $e){
            return response()->json([
                'error'=> 'something went wrong',
                'details'=>$e->getMessage()
            ],400);
        };
    }

    public function getUserTasks($userId){
        $tasks=User::findOrFail($userId);
        return TaskResource::collection($tasks->tasks);

    }
}
