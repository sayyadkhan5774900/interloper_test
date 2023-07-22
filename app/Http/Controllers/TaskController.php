<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function tasks(Request $request)
    {
        return view('tasks');
    }

    public function getTasks(Request $request)
    {
        $tasks = Task::orderBy('id', 'DESC')->get();
        return response()->json($tasks);
    }

    public function storeTasks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'due_date' => 'required',
            'priority' => 'required',
            'description' => 'required',
            // Add more validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $tasks = new Task();
        $tasks->title = $request->title;
        $tasks->due_date = $request->due_date;
        $tasks->priority = $request->priority;
        $tasks->description = $request->description;
        $tasks->save();
        return response()->json([
            'status' => 200,
        ]);
    }

    public function editTasks(Request $request)
    {
        $tasks = Task::where('id', $request->id)->first();
        return response()->json([
            'tasks' => $tasks,
        ]);
    }

    public function updateTasks(Request $request)
    {
        $tasks = Task::where('id', $request->task_id)->first();
        $tasks->title = $request->title;
        $tasks->due_date = $request->due_date;
        $tasks->description = $request->description;
        $tasks->update();
        return response()->json([
            'status' => 200,
        ]);
    }
}
