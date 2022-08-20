<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use Illuminate\Http\Request;

class TasksXhrController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string', 'max:255'],
            'list'  => ['required','integer','min:0','max:99999']
        ]);

        $task = new Task;
        $task->fill($validated);
        $task->complete = 0;
        $task->save();

        broadcast(new TaskCreated($task->list, $task->id, $task->title));

        return response()->json([
            'task' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['nullable','string','max:255'],
            'list'  => ['nullable','integer','min:0','max:99999'],
            'complete' => ['nullable','integer','min:0','max:1']
        ]);

        $task = Task::find($id);
        $task->fill($validated);
        $task->save();

        broadcast(new TaskUpdated($task->list, $task->id, $task->complete));

        return response()->json([
            'task' => $task
        ]);
    }
}
