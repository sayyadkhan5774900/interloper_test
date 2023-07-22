<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function displayTasks()
    {
        $tasks = Task::paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function createTask(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return response()->json(['message' => 'Task Created']);
    }

    public function viewCreate()
    {
        return view('tasks.create');
    }
}
