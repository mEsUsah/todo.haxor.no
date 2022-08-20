<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Task;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    public static function index()
    {
        $lists = Lists::all();
        return view('sections.lists', [
            'lists' => $lists]
        );
    }

    public static function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string', 'max:255']
        ]);

        $list = new Lists;
        $list->name = $validated['name'];
        $list->data = "";

        $list->save();
        return redirect('/lists');
    }
    
    public static function show($id)
    {
        $tasks = Task::where('list', $id)->get();
        $list = Lists::where('id', $id)->first();

        return view('sections.lists.show', [
            'id'    => $id,
            'tasks' => $tasks,
            'list'  => $list
        ]);
    }
}
