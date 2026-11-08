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
            "due_date"=>$request->due_date,
            "status"=>$request->status,
        ]);
        return response()->json($task,201);
    }
    public function index(){
        $task=Task::all();
        return response()->json($task,200);
    }

    public function update($id, Request $request){

        $task= Task::findOrFail($id);
        
        
       $task-> update([
            'title'=>$request->title,
            "description"=>$request->description,
            "due_date"=>$request->due_date,
            "status"=>$request->status,
        ]);
        return response()->json($task,200);
    }

    public function delete($id){
      $task= Task::findOrFail($id);
      $task->destroy();

        return response()->json(204);
    }
}
