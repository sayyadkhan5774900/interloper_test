<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //----------------
    public function addTask()
    {
        $tasks = Task::latest()->paginate(5);
        return view('tasks.create-task', compact('tasks'));
    }
    // ------------
    public function storeTask(Request $request)
    {        
        // Validate the form data
         $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->save();

        return response()->json([
            'status' => 'success', 

        ]);
    }
     // -----------
     public function TaskEdit(Request $request)
     {
         $validatedData = $request->validate([
             'up_title' => 'required',
             'up_description' => 'required',
         ]);
         $task = Task::findOrFail($request->up_id);
         $task->title = $validatedData['up_title'];
         $task->description = $validatedData['up_description'];
         $task->save();
         
         return response()->json([
             'status' => 'success', 
 
         ]);
     }
    // ---------------
    public function allTask()
    {
        $tasks = Task::all();
        return view('tasks.all-task', ['tasks' => $tasks])->render();
    }
    // -----------
     public function deleteTask($id)
     {
         $task = Task::findOrFail($id);
         $task->delete();
 
         return response()->json(['status' => 'success']);
     }
     // ------------
     public function completeTask($id)
     {
         $task = Task::findOrFail($id);
         $task->completed = 1;
         $task->save();
 
         return response()->json(['status' => 'success']);
     }
}
