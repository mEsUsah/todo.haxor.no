<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskListController extends Controller
{
    public static function index()
    {
        Gate::authorize('viewAny', TaskList::class);
        $lists = TaskList::all();
        return view('sections.lists', [
            'lists' => $lists]
        );
    }

    public static function create(Request $request)
    {
        Gate::authorize('create', TaskList::class);
        $validated = $request->validate([
            'name' => ['required','string', 'max:255']
        ]);

        $list = new TaskList;
        $list->name = $validated['name'];
        $list->data = "";

        $list->save();
        return redirect('/lists');
    }
    
    public static function show($id)
    {
        $tasks = Task::where('list', $id)->get();
        $list = TaskList::where('id', $id)->first();
        Gate::authorize('view', $list);

        return view('sections.lists.show', [
            'id'    => $id,
            'tasks' => $tasks,
            'list'  => $list
        ]);
    }
}
