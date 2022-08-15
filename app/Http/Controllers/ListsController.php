<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Task;
use Illuminate\Http\Request;

class ListsController extends Controller
{
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
