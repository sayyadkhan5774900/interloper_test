<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Carbon\Carbon;

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

    public function markAsCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->completed_at = carbon::now();
        $task->save();

        return response()->json(['success' => true,  'message' => 'Task marked completed']);
    }

    public function removeTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['success' => true, 'message' => 'Task Deleted']);
    }
}
